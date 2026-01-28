<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profile
     */
    public function index()
    {
        $user = Auth::user();
        return view('mahasiswa.profile', compact('user'));
    }

    /**
     * Tampilkan halaman complete profile
     * ✅ FIXED: Hapus redirect agar tidak terjadi loop
     */
    public function completeProfile()
    {
        $user = Auth::user();

        // ✅ PERBAIKAN: Langsung tampilkan form tanpa redirect
        // User bisa mengakses halaman ini kapan saja untuk update data
        return view('mahasiswa.complete-profile', compact('user'));
    }

    /**
     * Simpan data complete profile
     * ✅ FIXED: Nama kolom foto_profil (konsisten dengan Model)
     */
    public function storeCompleteProfile(Request $request)
    {
        $user = Auth::user();

        // Log untuk debugging
        Log::info('Complete Profile - Start', [
            'user_id' => $user->id,
            'user_nim' => $user->nim,
            'request_nim' => $request->nim,
        ]);

        // Setup validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|regex:/^08[0-9]{8,11}$/',
            'fakultas' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4|regex:/^\d+(\.\d{1,2})?$/',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'  // ✅ FIXED
        ];

        // ✅ Jika NIM kosong, tambahkan validasi untuk NIM
        if (!$user->nim) {
            $rules['nim'] = 'required|string|max:50|unique:users,nim';
        }

        // Custom error messages
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'nim.unique' => 'NIM sudah terdaftar oleh pengguna lain',
            'no_telepon.required' => 'No. Telepon/WA wajib diisi',
            'no_telepon.regex' => 'Format No. Telepon tidak valid (contoh: 081234567890)',
            'fakultas.required' => 'Fakultas wajib dipilih',
            'program_studi.required' => 'Program Studi wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'angkatan.min' => 'Angkatan minimal tahun 2000',
            'semester.required' => 'Semester wajib diisi',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 14',
            'ipk.required' => 'IPK wajib diisi',
            'ipk.min' => 'IPK minimal 0.00',
            'ipk.max' => 'IPK maksimal 4.00',
            'ipk.regex' => 'Format IPK tidak valid (contoh: 3.75)',
            'foto_profil.image' => 'File harus berupa gambar',  // ✅ FIXED
            'foto_profil.mimes' => 'Format foto harus JPG, JPEG, atau PNG',  // ✅ FIXED
            'foto_profil.max' => 'Ukuran foto maksimal 2MB'  // ✅ FIXED
        ];

        // Validasi input
        $validated = $request->validate($rules, $messages);

        // ✅ PERBAIKAN: Gunakan Database Transaction
        DB::beginTransaction();

        try {
            // Handle foto profil upload
            $fotoPath = $user->foto_profil;  // ✅ FIXED
            
            if ($request->hasFile('foto_profil')) {  // ✅ FIXED
                // Hapus foto lama jika ada
                if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {  // ✅ FIXED
                    Storage::disk('public')->delete($user->foto_profil);  // ✅ FIXED
                }

                // Upload foto baru dengan nama yang lebih aman
                $file = $request->file('foto_profil');  // ✅ FIXED
                $nimForFilename = $request->nim ?? $user->nim ?? 'temp_' . time();
                $filename = 'profile_' . str_replace('.', '_', $nimForFilename) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $fotoPath = $file->storeAs('profiles', $filename, 'public');

                Log::info('Foto profil uploaded', [
                    'filename' => $filename,
                    'path' => $fotoPath,
                ]);
            }

            // Prepare update data
            $updateData = [
                'name' => $request->name,
                'no_telepon' => $request->no_telepon,
                'phone' => $request->no_telepon, // Backup ke kolom phone
                'fakultas' => $request->fakultas,
                'program_studi' => $request->program_studi,
                'angkatan' => $request->angkatan,
                'semester' => $request->semester,
                'ipk' => $request->ipk,
                'foto_profil' => $fotoPath,  // ✅ FIXED
                'profile_completed_at' => now(), // ✅ FIX: Tambahkan timestamp completion!
            ];

            // ✅ Update NIM jika belum ada
            if (!$user->nim && $request->filled('nim')) {
                $updateData['nim'] = $request->nim;
            }

            // Update user data
            $user->update($updateData);

            // Commit transaction
            DB::commit();

            Log::info('Complete Profile - Success', [
                'user_id' => $user->id,
                'nim' => $user->nim,
                'profile_completed_at' => $user->profile_completed_at,
                'foto_profil' => $user->foto_profil,  // ✅ FIXED
            ]);

            // ✅ PERBAIKAN: Langsung redirect tanpa pengecekan lagi
            return redirect()
                ->route('mahasiswa.dashboard')
                ->with('success', 'Profile berhasil dilengkapi! Selamat datang di sistem KKN International.');

        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();

            // Hapus foto yang sudah diupload jika ada error
            if (isset($fotoPath) && $fotoPath !== $user->foto_profil && Storage::disk('public')->exists($fotoPath)) {  // ✅ FIXED
                Storage::disk('public')->delete($fotoPath);
            }

            Log::error('Complete Profile - Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.']);
        }
    }

    /**
     * Update profile mahasiswa
     * ✅ FIXED: Nama kolom foto_profil (konsisten dengan Model)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Debug: Cek apakah ada file yang diupload
        Log::info('Update Profile Debug', [
            'has_file' => $request->hasFile('foto_profil'),  // ✅ FIXED
            'all_files' => $request->allFiles(),
            'user_id' => $user->id,
            'current_foto' => $user->foto_profil  // ✅ FIXED
        ]);

        $rules = [
            'name' => 'required|string|max:255',
            'no_telepon' => 'required|string|regex:/^08[0-9]{8,11}$/',
            'fakultas' => 'required|string|max:100',
            'program_studi' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4|regex:/^\d+(\.\d{1,2})?$/',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'  // ✅ FIXED
        ];

        $messages = [
            'name.required' => 'Nama lengkap wajib diisi',
            'no_telepon.required' => 'No. Telepon/WA wajib diisi',
            'no_telepon.regex' => 'Format No. Telepon tidak valid (contoh: 081234567890)',
            'fakultas.required' => 'Fakultas wajib dipilih',
            'program_studi.required' => 'Program Studi wajib diisi',
            'angkatan.required' => 'Angkatan wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'ipk.required' => 'IPK wajib diisi',
            'ipk.regex' => 'Format IPK tidak valid (contoh: 3.75)',
            'foto_profil.image' => 'File harus berupa gambar',  // ✅ FIXED
            'foto_profil.mimes' => 'Format foto harus JPG, JPEG, atau PNG',  // ✅ FIXED
            'foto_profil.max' => 'Ukuran foto maksimal 2MB'  // ✅ FIXED
        ];

        $validated = $request->validate($rules, $messages);

        DB::beginTransaction();

        try {
            // Prepare data yang akan diupdate
            $updateData = [
                'name' => $request->name,
                'no_telepon' => $request->no_telepon,
                'phone' => $request->no_telepon,
                'fakultas' => $request->fakultas,
                'program_studi' => $request->program_studi,
                'angkatan' => $request->angkatan,
                'semester' => $request->semester,
                'ipk' => $request->ipk,
            ];

            // Handle foto profil upload
            if ($request->hasFile('foto_profil')) {  // ✅ FIXED
                Log::info('File detected, processing upload');
                
                // Hapus foto lama jika ada
                if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {  // ✅ FIXED
                    Storage::disk('public')->delete($user->foto_profil);  // ✅ FIXED
                    Log::info('Old photo deleted: ' . $user->foto_profil);  // ✅ FIXED
                }

                // Upload foto baru
                $file = $request->file('foto_profil');  // ✅ FIXED
                $filename = 'profile_' . str_replace('.', '_', $user->nim) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $fotoPath = $file->storeAs('profiles', $filename, 'public');
                
                Log::info('New photo uploaded', [
                    'filename' => $filename,
                    'path' => $fotoPath,
                    'full_path' => storage_path('app/public/' . $fotoPath)
                ]);
                
                $updateData['foto_profil'] = $fotoPath;  // ✅ FIXED
            } else {
                Log::info('No file uploaded, keeping old photo');
            }

            // Update user data
            $user->update($updateData);

            Log::info('User updated successfully', [
                'user_id' => $user->id,
                'foto_profil' => $user->foto_profil  // ✅ FIXED
            ]);

            DB::commit();

            return redirect()
                ->route('mahasiswa.profile')
                ->with('success', 'Profile berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Update Profile - Error', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan halaman ganti password
     */
    public function editPassword()
    {
        return view('mahasiswa.profile-password');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        Log::info('Password updated', ['user_id' => $user->id]);

        return redirect()
            ->route('mahasiswa.profile')
            ->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Cek apakah profile sudah lengkap
     * Method ini bisa digunakan oleh middleware atau controller lain
     */
    public function isProfileComplete($user = null)
    {
        $user = $user ?? Auth::user();
        
        return !empty($user->nim) 
            && !empty($user->name) 
            && !empty($user->no_telepon) 
            && !empty($user->fakultas) 
            && !empty($user->program_studi) 
            && !empty($user->angkatan) 
            && !empty($user->semester) 
            && !empty($user->ipk);
    }
}