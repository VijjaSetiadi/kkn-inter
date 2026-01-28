<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranKkn;
use App\Models\Dokumen;
use App\Models\Setting;
use App\Models\Destination;
use App\Models\Period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendaftarBaruNotification;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('pendaftaran.informasi');
    }

    public function create()
    {
        if (!Setting::isRegistrationOpen()) {
            return redirect()
                ->route('mahasiswa.dashboard')
                ->with('error', '⛔ Pendaftaran KKN International sedang ditutup.');
        }

        $mahasiswa = Auth::user();

        if (!$mahasiswa->profile_completed_at) {
            return redirect()->route('profile.complete')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $pendaftaranAktif = PendaftaranKkn::where('mahasiswa_id', $mahasiswa->id)
            ->whereIn('status', ['pending', 'diproses'])
            ->first();

        if ($pendaftaranAktif) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('info', 'Anda masih memiliki pendaftaran yang sedang diproses.');
        }

        $destinations = Destination::where('is_active', 1)
            ->orderBy('country', 'asc')
            ->get();
        
        if ($destinations->isEmpty()) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('warning', 'Belum ada tujuan KKN yang tersedia. Silakan hubungi admin.');
        }

        $periods = Period::where('is_active', 1)
            ->orderBy('year', 'desc')
            ->orderBy('semester', 'asc')
            ->get();
        
        if ($periods->isEmpty()) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('warning', 'Belum ada periode KKN yang tersedia. Silakan hubungi admin.');
        }

        return view('pendaftaran.form', compact('mahasiswa', 'destinations', 'periods'));
    }

    public function store(Request $request)
    {
        if (!Setting::isRegistrationOpen()) {
            return redirect()
                ->route('mahasiswa.dashboard')
                ->with('error', '⛔ Pendaftaran sedang ditutup.');
        }

        $mahasiswa = Auth::user();

        if (!$mahasiswa->profile_completed_at) {
            return redirect()->route('profile.complete')
                ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        $validator = Validator::make($request->all(), [
            'periode' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = Period::where('name', $value)
                        ->where('is_active', 1)
                        ->exists();
                    
                    if (!$exists) {
                        $fail('Periode yang dipilih tidak valid atau sudah tidak aktif.');
                    }
                }
            ],
            'negara_tujuan' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $exists = Destination::where('country', $value)
                        ->where('is_active', 1)
                        ->exists();
                    
                    if (!$exists) {
                        $fail('Negara tujuan yang dipilih tidak valid atau sudah tidak aktif.');
                    }
                }
            ],
            'motivasi' => 'required|string|min:100',
            'dokumen.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'jenis_dokumen.*' => 'required|string'
        ], [
            'periode.required' => 'Periode KKN wajib dipilih',
            'negara_tujuan.required' => 'Negara tujuan wajib dipilih',
            'motivasi.required' => 'Motivasi wajib diisi',
            'motivasi.min' => 'Motivasi minimal 100 karakter',
            'dokumen.*.required' => 'Dokumen wajib diupload',
            'dokumen.*.mimes' => 'Format dokumen harus PDF, JPG, JPEG, atau PNG',
            'dokumen.*.max' => 'Ukuran dokumen maksimal 5MB',
            'jenis_dokumen.*.required' => 'Jenis dokumen wajib dipilih'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        
        try {
            $pendaftaran = PendaftaranKkn::create([
                'mahasiswa_id' => $mahasiswa->id,
                'periode' => $request->periode,
                'negara_tujuan' => $request->negara_tujuan,
                'motivasi' => $request->motivasi,
                'status' => 'pending'
            ]);

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $index => $file) {
                    $jenisDokumen = $request->jenis_dokumen[$index];
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $mahasiswa->nim . '_' . $jenisDokumen . '_' . time() . '_' . $index . '.' . $extension;
                    $filePath = $file->storeAs('dokumen_kkn', $fileName, 'public');

                    Dokumen::create([
                        'pendaftaran_id' => $pendaftaran->id,
                        'jenis_dokumen' => $jenisDokumen,
                        'nama_file' => $fileName,
                        'path_file' => $filePath
                    ]);
                }
            }

            DB::commit();
            
            // ✅ KIRIM EMAIL NOTIFIKASI KE ADMIN (SINKRON - LANGSUNG KIRIM)
            try {
                // Load relasi untuk email
                $pendaftaran->load(['mahasiswa', 'dokumen']);
                
                // Email admin dari config
                $adminEmail = config('mail.admin_email', 'vijjasetiadi98@gmail.com');
                
                // ✅ Log SEBELUM kirim email (SUPER DETAIL)
                Log::info('🔔 ========== FORM SUBMIT - MULAI KIRIM EMAIL KE ADMIN ==========');
                Log::info('Admin Email Target: ' . $adminEmail);
                Log::info('Pendaftaran ID: ' . $pendaftaran->id);
                Log::info('Mahasiswa NIM: ' . $mahasiswa->nim);
                Log::info('Mahasiswa Nama: ' . $mahasiswa->name);
                Log::info('Mahasiswa Email: ' . $mahasiswa->email);
                Log::info('Periode: ' . $request->periode);
                Log::info('Negara Tujuan: ' . $request->negara_tujuan);
                Log::info('Jumlah Dokumen: ' . $pendaftaran->dokumen->count());
                Log::info('Mail Config:', [
                    'mailer' => config('mail.default'),
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'username' => config('mail.mailers.smtp.username'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                    'from_address' => config('mail.from.address'),
                ]);
                
                // ✅ KIRIM EMAIL SINKRON (LANGSUNG, BUKAN QUEUE)
                Log::info('📧 Mengirim email SINKRON ke: ' . $adminEmail);
                Mail::to($adminEmail)->send(new PendaftarBaruNotification($pendaftaran));
                Log::info('✅ Mail::to()->send() SELESAI dieksekusi!');
                
                // ✅ Log SETELAH kirim
                Log::info('✅ ========== EMAIL BERHASIL DIKIRIM KE ADMIN! ==========');
                Log::info('Timestamp: ' . now()->toDateTimeString());
                
            } catch (\Exception $emailError) {
                // ✅ Log ERROR dengan detail LENGKAP
                Log::error('❌ ========== FORM SUBMIT - GAGAL KIRIM EMAIL! ==========');
                Log::error('Error Message: ' . $emailError->getMessage());
                Log::error('Error Code: ' . $emailError->getCode());
                Log::error('Error File: ' . $emailError->getFile());
                Log::error('Error Line: ' . $emailError->getLine());
                Log::error('Error Trace: ' . $emailError->getTraceAsString());
                Log::error('Admin Email: ' . ($adminEmail ?? 'unknown'));
                Log::error('Pendaftaran ID: ' . ($pendaftaran->id ?? 'unknown'));
                Log::error('========================================');
                // Tidak throw error, biar pendaftaran tetap berhasil meski email gagal
            }
            
            return redirect()
                ->route('mahasiswa.pendaftaran.success')
                ->with([
                    'success' => 'Pendaftaran berhasil disimpan!',
                    'nomor_pendaftaran' => $pendaftaran->id,
                    'nim' => $mahasiswa->nim
                ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error pendaftaran KKN: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success()
    {
        if (!session()->has('nomor_pendaftaran')) {
            return redirect()->route('mahasiswa.dashboard');
        }

        return view('pendaftaran.success');
    }

    public function show($id)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
                ->findOrFail($id);
        } else {
            $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
                ->where('id', $id)
                ->where('mahasiswa_id', $user->id)
                ->firstOrFail();
        }

        $mahasiswa = $pendaftaran->mahasiswa;

        return view('pendaftaran.detail', compact('pendaftaran', 'mahasiswa'));
    }

    public function downloadDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // OK
        } elseif ($user->isMahasiswa()) {
            if ($dokumen->pendaftaran->mahasiswa_id !== $user->id) {
                abort(403, 'Anda tidak memiliki akses ke dokumen ini.');
            }
        } else {
            abort(403);
        }
        
        $filePath = storage_path('app/public/' . $dokumen->path_file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download($filePath, $dokumen->nama_file);
    }

    public function reuploadDokumen(Request $request, $id)
    {
        try {
            $dokumen = Dokumen::findOrFail($id);
            
            if ($dokumen->status_verifikasi !== 'ditolak') {
                return redirect()->back()->with('error', 'Hanya dokumen yang ditolak yang dapat diupload ulang');
            }
            
            $pendaftaran = $dokumen->pendaftaran;
            if ($pendaftaran->mahasiswa_id !== auth()->id()) {
                return redirect()->back()->with('error', 'Akses ditolak');
            }
            
            $request->validate([
                'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'reupload_reason' => 'required|string|max:500'
            ], [
                'file.required' => 'File harus diupload',
                'file.mimes' => 'File harus berformat PDF, JPG, JPEG, atau PNG',
                'file.max' => 'Ukuran file maksimal 2MB',
                'reupload_reason.required' => 'Alasan upload ulang harus diisi'
            ]);
            
            DB::beginTransaction();
            
            try {
                $dokumen->old_path_file = $dokumen->path_file;
                $dokumen->old_nama_file = $dokumen->nama_file;
                
                $file = $request->file('file');
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('dokumen', $namaFile, 'public');
                
                $dokumen->nama_file = $namaFile;
                $dokumen->path_file = $path;
                $dokumen->status_verifikasi = 'pending';
                $dokumen->catatan_verifikasi = null;
                $dokumen->verified_at = null;
                $dokumen->reupload_count = $dokumen->reupload_count + 1;
                $dokumen->last_reuploaded_at = now();
                $dokumen->reupload_reason = $request->reupload_reason;
                $dokumen->save();
                
                DB::commit();
                
                Log::info('Dokumen reuploaded', [
                    'dokumen_id' => $dokumen->id,
                    'mahasiswa_id' => auth()->id(),
                    'reupload_count' => $dokumen->reupload_count,
                    'reason' => $request->reupload_reason
                ]);
                
                return redirect()->back()->with('success', 
                    'Dokumen berhasil diupload ulang! Status kembali ke "Pending" dan menunggu verifikasi admin.');
                    
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            Log::error('Reupload error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Cetak bukti pendaftaran dengan QR Code
     */
    public function cetakBukti($id)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])->findOrFail($id);
        } else {
            $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
                ->where('id', $id)
                ->where('mahasiswa_id', $user->id)
                ->firstOrFail();
        }
        
        // Generate barcode number jika belum ada
        if (empty($pendaftaran->barcode_number)) {
            $pendaftaran->barcode_number = PendaftaranKkn::generateBarcodeNumber();
            $pendaftaran->save();
        }
        
        // Generate QR Code dengan library Chillerlan
        $verifyUrl = route('verify.registration', ['code' => $pendaftaran->barcode_number]);
        
        $options = new QROptions([
            'version'      => QRCode::VERSION_AUTO,
            'outputType'   => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel'     => QRCode::ECC_L,
            'scale'        => 8,
            'imageBase64'  => false,
            'imageTransparent' => false,
        ]);
        
        $qrCodeInstance = new QRCode($options);
        $qrCodeImage = $qrCodeInstance->render($verifyUrl);
        
        // Encode ke base64 secara manual
        $qrcode = 'data:image/png;base64,' . base64_encode($qrCodeImage);
        
        return view('pendaftaran.cetak-bukti', compact('pendaftaran', 'qrcode'));
    }

    /**
     * Verifikasi barcode (untuk admin)
     */
    public function verifyBarcode($code)
    {
        $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
            ->where('barcode_number', $code)
            ->first();
        
        if (!$pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Barcode tidak valid atau pendaftaran tidak ditemukan'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pendaftaran->id,
                'barcode_number' => $pendaftaran->barcode_number,
                'status' => $pendaftaran->status,
                'status_label' => ucfirst($pendaftaran->status),
                'mahasiswa' => [
                    'nim' => $pendaftaran->mahasiswa->nim,
                    'nama' => $pendaftaran->mahasiswa->name,
                    'email' => $pendaftaran->mahasiswa->email,
                    'fakultas' => $pendaftaran->mahasiswa->fakultas ?? '-',
                    'prodi' => $pendaftaran->mahasiswa->program_studi ?? '-',
                ],
                'periode' => $pendaftaran->periode,
                'negara_tujuan' => $pendaftaran->negara_tujuan,
                'tanggal_daftar' => $pendaftaran->created_at->format('d F Y, H:i'),
                'catatan_admin' => $pendaftaran->catatan_admin,
                'total_dokumen' => $pendaftaran->dokumen->count(),
                'dokumen_diterima' => $pendaftaran->dokumen->where('status_verifikasi', 'diterima')->count(),
            ]
        ]);
    }

    /**
     * Verifikasi barcode publik (tidak perlu login)
     */
    public function publicVerifyBarcode($code)
    {
        $pendaftaran = PendaftaranKkn::with(['mahasiswa', 'dokumen'])
            ->where('barcode_number', $code)
            ->first();
        
        if (!$pendaftaran) {
            return view('verify-registration', [
                'found' => false,
                'message' => 'Barcode tidak valid atau pendaftaran tidak ditemukan'
            ]);
        }
        
        return view('verify-registration', [
            'found' => true,
            'pendaftaran' => $pendaftaran
        ]);
    }
}
