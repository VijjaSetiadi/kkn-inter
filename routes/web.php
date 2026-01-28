<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboardController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Auth\MahasiswaRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// HALAMAN UTAMA (PUBLIC)
// ============================================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Informasi Pendaftaran (Public)
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

// ============================================
// VERIFIKASI BARCODE (PUBLIC - TIDAK PERLU LOGIN)
// ============================================
// ✅ PERBAIKAN: Gunakan PendaftaranController bukan AdminDashboardController
Route::get('/verify-registration/{code}', [PendaftaranController::class, 'publicVerifyBarcode'])
    ->name('verify.registration');

// API untuk verifikasi barcode (untuk scanner)
Route::get('/api/verify-barcode/{code}', [PendaftaranController::class, 'verifyBarcode'])
    ->name('api.verify-barcode');

// ============================================
// INFORMASI BEASISWA (PUBLIC)
// ============================================
Route::get('/information', [InformationController::class, 'index'])->name('information');

// ============================================
// NEWS/BERITA (PUBLIC)
// ============================================
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// ============================================
// REGISTER MAHASISWA (3 STEP PROCESS)
// ============================================
Route::middleware('guest')->group(function () {
    // STEP 1: Registration
    Route::get('/register-mahasiswa', [MahasiswaRegisterController::class, 'create'])
        ->name('register.mahasiswa');
    Route::post('/register-mahasiswa', [MahasiswaRegisterController::class, 'store']);
    
    // STEP 2: Email Verification
    Route::get('/verification', [MahasiswaRegisterController::class, 'showVerificationForm'])
        ->name('verification.show');
    Route::post('/verification/verify', [MahasiswaRegisterController::class, 'verify'])
        ->name('verification.verify');
    Route::post('/verification/resend', [MahasiswaRegisterController::class, 'resendCode'])
        ->name('verification.resend');
});

// ============================================
// AUTH ROUTES (AFTER LOGIN)
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // STEP 3: COMPLETE PROFILE
    Route::get('/complete-profile', [MahasiswaProfileController::class, 'completeProfile'])
        ->name('profile.complete');
    Route::post('/complete-profile', [MahasiswaProfileController::class, 'storeCompleteProfile'])
        ->name('profile.complete.store');
    
    // Dashboard Redirect - Berdasarkan Role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        \Log::info('Dashboard redirect', [
            'user_id' => $user->id,
            'role' => $user->role,
            'profile_completed' => $user->profile_completed_at
        ]);
        
        // Admin
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Mahasiswa
        if ($user->isMahasiswa()) {
            // Check if profile completed
            if (!$user->profile_completed_at) {
                return redirect()->route('profile.complete')
                    ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
            }
            
            return redirect()->route('mahasiswa.dashboard');
        }
        
        // Default fallback
        return redirect()->route('home')
            ->with('error', 'Role tidak dikenali.');
            
    })->name('dashboard');
});

// ============================================
// ROUTE MAHASISWA (AUTH + VERIFIED + PROFILE_COMPLETED + ROLE)
// ============================================
Route::middleware(['auth', 'verified', 'profile.completed', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])
            ->name('dashboard');
        
        // Profile
        Route::get('/profile', [MahasiswaProfileController::class, 'index'])
            ->name('profile');
        Route::post('/profile/update', [MahasiswaProfileController::class, 'update'])
            ->name('profile.update');
        
        // Ganti Password
        Route::get('/profile/password', [MahasiswaProfileController::class, 'editPassword'])
            ->name('profile.password');
        Route::put('/profile/password', [MahasiswaProfileController::class, 'updatePassword'])
            ->name('profile.password.update');
        
        // Pendaftaran KKN
        Route::get('/pendaftaran/form', [PendaftaranController::class, 'create'])
            ->name('pendaftaran.create');
        Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
            ->name('pendaftaran.store');
        Route::get('/pendaftaran/success', [PendaftaranController::class, 'success'])
            ->name('pendaftaran.success');
        Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])
            ->name('pendaftaran.show');
        Route::get('/dokumen/{id}/download', [PendaftaranController::class, 'downloadDokumen'])
            ->name('pendaftaran.download-dokumen');
        Route::post('/dokumen/{id}/reupload', [PendaftaranController::class, 'reuploadDokumen'])
            ->name('pendaftaran.reupload-dokumen');
        
        // ============================================
        // ✅ CETAK BUKTI PENDAFTARAN (MAHASISWA)
        // ============================================
        Route::get('/pendaftaran/{id}/cetak-bukti', [PendaftaranController::class, 'cetakBukti'])
            ->name('pendaftaran.cetak-bukti');
    });

// ============================================
// ROUTE ADMIN
// ============================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
        
        // ============================================
        // ✅ DATA PENDAFTARAN (MENU BARU TERPISAH)
        // ============================================
        Route::get('/pendaftaran', [AdminDashboardController::class, 'pendaftaranIndex'])
            ->name('pendaftaran.index');
        
        // Settings
        Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])
            ->name('settings.update');
        
        // Destinations
        Route::get('/destinations', [DestinationController::class, 'index'])
            ->name('destinations');
        Route::get('/destinations/create', [DestinationController::class, 'create'])
            ->name('destinations.create');
        Route::post('/destinations', [DestinationController::class, 'store'])
            ->name('destinations.store');
        Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])
            ->name('destinations.edit');
        Route::put('/destinations/{id}', [DestinationController::class, 'update'])
            ->name('destinations.update');
        Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])
            ->name('destinations.destroy');
        
        // Periods
        Route::get('/periods', [PeriodController::class, 'index'])
            ->name('periods');
        Route::get('/periods/create', [PeriodController::class, 'create'])
            ->name('periods.create');
        Route::post('/periods', [PeriodController::class, 'store'])
            ->name('periods.store');
        Route::get('/periods/{id}/edit', [PeriodController::class, 'edit'])
            ->name('periods.edit');
        Route::put('/periods/{id}', [PeriodController::class, 'update'])
            ->name('periods.update');
        Route::delete('/periods/{id}', [PeriodController::class, 'destroy'])
            ->name('periods.destroy');
        
        // ============================================
        // EXPORT DATA (PENTING: TARUH SEBELUM PENDAFTARAN)
        // ============================================
        Route::get('/export', [ExportController::class, 'index'])
            ->name('export');
        Route::post('/export/process', [ExportController::class, 'process'])
            ->name('export.process');
        
        // ============================================
        // INFORMATION MANAGEMENT
        // ============================================
        Route::get('/information', [InformationController::class, 'edit'])
            ->name('information');
        Route::post('/information', [InformationController::class, 'update'])
            ->name('information.update');
        Route::delete('/information/image', [InformationController::class, 'removeImage'])
            ->name('information.remove-image');
        
        // ============================================
        // NEWS MANAGEMENT
        // ============================================
        Route::get('/news', [AdminNewsController::class, 'index'])
            ->name('news.index');
        Route::post('/news', [AdminNewsController::class, 'store'])
            ->name('news.store');
        Route::put('/news/{news}', [AdminNewsController::class, 'update'])
            ->name('news.update');
        Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])
            ->name('news.destroy');
        
        // ============================================
        // PENDAFTARAN MANAGEMENT
        // ============================================
        Route::get('/pendaftaran/{id}', [AdminDashboardController::class, 'show'])
            ->name('pendaftaran.show');
        Route::post('/pendaftaran/{id}/update-status', [AdminDashboardController::class, 'updateStatus'])
            ->name('pendaftaran.update-status');
        Route::delete('/pendaftaran/{id}', [AdminDashboardController::class, 'destroy'])
            ->name('pendaftaran.destroy');
        
        // ============================================
        // ✅ CETAK BUKTI PENDAFTARAN (ADMIN)
        // ============================================
        Route::get('/pendaftaran/{id}/cetak-bukti', [PendaftaranController::class, 'cetakBukti'])
            ->name('pendaftaran.cetak-bukti');
        
        // Document Download
        Route::get('/dokumen/{id}/download', [PendaftaranController::class, 'downloadDokumen'])
            ->name('dokumen.download');
        Route::get('/dokumen/preview/{id}', [AdminDashboardController::class, 'previewDokumen'])
            ->name('dokumen.preview');
        
        // ============================================
        // DOKUMEN VERIFIKASI
        // ============================================
        // Update status dokumen (single)
        Route::post('/dokumen/{id}/update-status', [DokumenController::class, 'updateStatus'])
            ->name('dokumen.update-status');
        
        // Update status batch (multiple documents)
        Route::post('/dokumen/update-status-batch', [DokumenController::class, 'updateStatusBatch'])
            ->name('dokumen.update-status-batch');
    });

    // ✅ ROUTE TEST EMAIL ADMIN
        Route::get('/test-admin-email', function () {
            try {
                // Ambil pendaftaran terakhir
                $pendaftaran = \App\Models\PendaftaranKkn::with(['mahasiswa', 'dokumen'])->latest()->first();
                
                if (!$pendaftaran) {
                    return '❌ Tidak ada data pendaftaran untuk testing! Silakan daftar KKN dulu.';
                }
                
                $adminEmail = config('mail.admin_email', 'vijjasetiadi98@gmail.com');
                
                echo "<div style='font-family: Arial; padding: 20px;'>";
                echo "<h2>📧 Testing Email ke Admin</h2>";
                echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
                echo "<tr><td><strong>Target Email:</strong></td><td>" . $adminEmail . "</td></tr>";
                echo "<tr><td><strong>Pendaftaran ID:</strong></td><td>#" . $pendaftaran->id . "</td></tr>";
                echo "<tr><td><strong>Mahasiswa NIM:</strong></td><td>" . $pendaftaran->mahasiswa->nim . "</td></tr>";
                echo "<tr><td><strong>Mahasiswa Nama:</strong></td><td>" . $pendaftaran->mahasiswa->name . "</td></tr>";
                echo "<tr><td><strong>Periode:</strong></td><td>" . $pendaftaran->periode . "</td></tr>";
                echo "<tr><td><strong>Negara:</strong></td><td>" . $pendaftaran->negara_tujuan . "</td></tr>";
                echo "<tr><td><strong>Jumlah Dokumen:</strong></td><td>" . $pendaftaran->dokumen->count() . " file</td></tr>";
                echo "</table>";
                echo "<hr>";
                echo "<p>⏳ Mengirim email...</p>";
                
                // Log sebelum kirim
                \Log::info('🧪 TEST EMAIL - Mengirim ke: ' . $adminEmail);
                
                // Kirim email
                \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\PendaftarBaruNotification($pendaftaran));
                
                // Log setelah kirim
                \Log::info('✅ TEST EMAIL - Berhasil dikirim!');
                
                echo "<h3 style='color: green;'>✅ Email berhasil dikirim!</h3>";
                echo "<ul>";
                echo "<li>Cek inbox: <strong>" . $adminEmail . "</strong></li>";
                echo "<li>Cek folder <strong>Spam</strong> atau <strong>Promotions</strong></li>";
                echo "<li>Cek log: <code>storage/logs/laravel.log</code></li>";
                echo "</ul>";
                echo "<p><a href='/test-admin-email'>🔄 Test Lagi</a> | <a href='/'>🏠 Home</a></p>";
                echo "</div>";
                
            } catch (\Exception $e) {
                echo "<div style='font-family: Arial; padding: 20px;'>";
                echo "<h3 style='color: red;'>❌ Error Terjadi!</h3>";
                echo "<p><strong>Error Message:</strong></p>";
                echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
                echo "<p><strong>Stack Trace:</strong></p>";
                echo "<pre style='background: #f5f5f5; padding: 15px; border-radius: 5px; overflow: auto; max-height: 300px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
                echo "<p><a href='/test-admin-email'>🔄 Test Lagi</a> | <a href='/'>🏠 Home</a></p>";
                echo "</div>";
                
                // Log error
                \Log::error('❌ TEST EMAIL - Gagal!', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        })->name('test.admin.email');
// ============================================
// AUTH ROUTES (LOGIN, LOGOUT, ETC)
// ============================================
require __DIR__.'/auth.php';