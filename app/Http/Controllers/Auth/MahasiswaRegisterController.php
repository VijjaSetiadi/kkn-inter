<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class MahasiswaRegisterController extends Controller
{
    /**
     * ============================================
     * STEP 1: SHOW REGISTRATION FORM
     * ============================================
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * ============================================
     * STEP 1: PROCESS REGISTRATION
     * ============================================
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        DB::beginTransaction();
        
        try {
            // Generate kode verifikasi 6 digit
            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $verificationExpiry = now()->addMinutes(15); // Berlaku 15 menit

            // Buat user baru dengan status belum verifikasi
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
                'email_verified_at' => null,
                'verification_code' => $verificationCode,
                'verification_code_expires_at' => $verificationExpiry,
            ]);

            // TEMPORARY: Log kode verifikasi (backup jika email gagal)
            \Log::info('=== KODE VERIFIKASI ===');
            \Log::info('Email: ' . $user->email);
            \Log::info('Kode: ' . $verificationCode);
            \Log::info('Expired: ' . $verificationExpiry);
            \Log::info('======================');

            // Kirim email verifikasi ke email pendaftar
            try {
                Mail::to($user->email)->send(new VerificationCodeMail($verificationCode, $verificationExpiry));
                \Log::info('✅ Email verification sent successfully to: ' . $user->email);
            } catch (\Exception $mailError) {
                \Log::error('❌ Failed to send verification email: ' . $mailError->getMessage());
                // Jangan rollback, biarkan user tetap bisa verifikasi manual dari log
            }

            // Simpan data di session untuk halaman verifikasi
            session([
                'verification_email' => $user->email,
                'verification_user_id' => $user->id
            ]);

            DB::commit();

            // REDIRECT KE HALAMAN VERIFIKASI
            return redirect()->route('verification.show')
                ->with('success', 'Registrasi berhasil! Kode verifikasi telah dikirim ke email Anda.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Registration Error: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * STEP 2: SHOW VERIFICATION FORM
     * ============================================
     */
    public function showVerificationForm()
    {
        // Cek apakah ada email di session
        if (!session()->has('verification_email')) {
            return redirect()->route('register.mahasiswa')
                ->with('error', 'Silakan daftar terlebih dahulu');
        }

        return view('auth.verify-email');
    }

    /**
     * ============================================
     * STEP 2: VERIFY EMAIL CODE
     * ============================================
     */
    public function verify(Request $request)
    {
        // Validasi input
        $request->validate([
            'verification_code' => 'required|digits:6',
        ], [
            'verification_code.required' => 'Kode verifikasi wajib diisi',
            'verification_code.digits' => 'Kode verifikasi harus 6 digit angka',
        ]);

        // Ambil email dari session
        $email = session('verification_email');
        
        if (!$email) {
            return redirect()->route('register.mahasiswa')
                ->with('error', 'Session expired. Silakan registrasi ulang.');
        }

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        // Cek apakah sudah terverifikasi
        if ($user->email_verified_at) {
            Auth::login($user);
            return redirect()->route('profile.complete')
                ->with('info', 'Email sudah diverifikasi sebelumnya. Silakan lengkapi profil Anda.');
        }

        // Cek apakah kode sudah kadaluarsa
        if ($user->verification_code_expires_at && $user->verification_code_expires_at < now()) {
            return back()->with('error', 'Kode verifikasi sudah kadaluarsa. Silakan minta kode baru.');
        }

        // Cek apakah kode benar
        if ($user->verification_code !== $request->verification_code) {
            return back()
                ->withInput()
                ->with('error', 'Kode verifikasi salah. Silakan cek kembali email Anda.');
        }

        DB::beginTransaction();
        
        try {
            // Update status verifikasi
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->verification_code_expires_at = null;
            $user->save();

            DB::commit();

            // Login otomatis setelah verifikasi
            Auth::login($user);

            // Hapus session verifikasi
            session()->forget(['verification_email', 'verification_user_id']);

            // REDIRECT KE HALAMAN LENGKAPI PROFIL
            return redirect()->route('profile.complete')
                ->with('success', 'Email berhasil diverifikasi! Silakan lengkapi profil Anda.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Verification Error: ' . $e->getMessage());
            
            return back()->with('error', 'Terjadi kesalahan saat verifikasi: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * STEP 2: RESEND VERIFICATION CODE
     * ============================================
     */
    public function resendCode(Request $request)
    {
        $email = session('verification_email');
        
        if (!$email) {
            return redirect()->route('register.mahasiswa')
                ->with('error', 'Session expired. Silakan registrasi ulang.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        // Cek apakah sudah terverifikasi
        if ($user->email_verified_at) {
            Auth::login($user);
            return redirect()->route('profile.complete')
                ->with('info', 'Email sudah diverifikasi. Silakan lengkapi profil Anda.');
        }

        DB::beginTransaction();
        
        try {
            // Generate kode baru
            $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $verificationExpiry = now()->addMinutes(15);

            $user->verification_code = $verificationCode;
            $user->verification_code_expires_at = $verificationExpiry;
            $user->save();

            DB::commit();

            // TEMPORARY: Log kode verifikasi baru
            \Log::info('=== KODE VERIFIKASI BARU ===');
            \Log::info('Email: ' . $user->email);
            \Log::info('Kode: ' . $verificationCode);
            \Log::info('Expired: ' . $verificationExpiry);
            \Log::info('============================');

            // Kirim email ke email pendaftar
            try {
                Mail::to($user->email)->send(new VerificationCodeMail($verificationCode, $verificationExpiry));
                \Log::info('✅ Resend email verification sent successfully to: ' . $user->email);
            } catch (\Exception $mailError) {
                \Log::error('❌ Failed to resend verification email: ' . $mailError->getMessage());
                return back()->with('error', 'Gagal mengirim email: ' . $mailError->getMessage());
            }

            return back()->with('success', 'Kode verifikasi baru telah dikirim ke email Anda!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Resend Code Error: ' . $e->getMessage());
            
            return back()->with('error', 'Gagal mengirim kode baru: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * STEP 3: SHOW COMPLETE PROFILE FORM
     * ============================================
     */
    public function showCompleteProfileForm()
    {
        // Cek apakah user sudah login dan email terverifikasi
        if (!auth()->check()) {
            return redirect()->route('register.mahasiswa')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $user = auth()->user();

        // Cek apakah email sudah terverifikasi
        if (!$user->email_verified_at) {
            return redirect()->route('verification.show')
                ->with('error', 'Silakan verifikasi email terlebih dahulu');
        }

        // Cek apakah profil sudah lengkap
        if ($user->profile_completed_at) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('info', 'Profil Anda sudah lengkap');
        }

        return view('auth.complete-profile');
    }

    /**
     * ============================================
     * STEP 3: STORE COMPLETE PROFILE
     * ============================================
     */
    public function storeCompleteProfile(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users,nim',
            'phone' => 'required|string|max:20',
            'program_studi' => 'required|string|max:100',
            'fakultas' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'phone.required' => 'Nomor HP wajib diisi',
            'program_studi.required' => 'Program studi wajib diisi',
            'fakultas.required' => 'Fakultas wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
        ]);

        DB::beginTransaction();
        
        try {
            $user = auth()->user();

            // Update data user
            $user->update([
                'name' => $validated['name'],
                'nim' => $validated['nim'],
                'phone' => $validated['phone'],
                'program_studi' => $validated['program_studi'],
                'fakultas' => $validated['fakultas'],
                'angkatan' => $validated['angkatan'],
                'alamat' => $validated['alamat'],
                'tempat_lahir' => $validated['tempat_lahir'],
                'tanggal_lahir' => $validated['tanggal_lahir'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'profile_completed_at' => now(),
            ]);

            DB::commit();

            // REDIRECT KE DASHBOARD MAHASISWA
            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'Profil berhasil dilengkapi! Selamat datang di dashboard KKN International.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('Complete Profile Error: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}