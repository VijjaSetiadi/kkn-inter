@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@push('styles')
<style>
    /* ========================================
       GLOBAL ANIMATIONS & BASE STYLES
    ======================================== */
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse-custom {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    /* ========================================
       DASHBOARD WRAPPER & BACKGROUND
    ======================================== */
    .dashboard-wrapper {
        background: linear-gradient(-45deg, #f8f9fa, #e9ecef, #dee2e6);
        background-size: 400% 400%;
        animation: gradient-shift 10s ease infinite;
        min-height: 100vh;
        padding: 15px;
    }

    /* Main Container Animation */
    .main-container {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Mobile Card Styles */
    .mobile-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 16px;
    }

    .mobile-card-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        color: white;
        padding: 12px 16px;
        font-weight: 700;
        font-size: 14px;
        border-bottom: 3px solid #F9B234;
    }

    .mobile-card-body {
        padding: 16px;
    }

    /* Info Card Hover */
    .info-card-hover:hover {
        transform: translateY(-4px);
        transition: all 0.3s ease;
    }

    /* Menu Card Hover */
    .menu-card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
        border-color: #1e40af;
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    <div class="main-container max-w-6xl mx-auto">
        
        <!-- Page Header -->
        <div class="mb-4">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-xl px-4 py-5 shadow-lg border-b-4 border-yellow-500">
                <h1 class="text-white text-xl md:text-2xl font-bold mb-2 flex items-center gap-2">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard Mahasiswa
                </h1>
                <p class="text-white/90 text-sm">
                    Selamat datang, <strong>{{ $mahasiswa->nama }}</strong>!
                </p>
            </div>
        </div>

        <!-- Registration Status Alert -->
        @if(!$pendaftaranDibuka)
            <div class="alert-notification bg-red-50 border-l-4 border-red-500 rounded-lg p-3 mb-3 shadow-md">
                <div class="flex items-start gap-3">
                    <i class="fas fa-times-circle text-red-600 text-xl flex-shrink-0"></i>
                    <div class="flex-1">
                        <h3 class="text-red-900 font-bold text-sm mb-1">Pendaftaran Ditutup</h3>
                        <p class="text-red-800 text-xs">Pendaftaran sedang ditutup. Tunggu pengumuman berikutnya.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert-notification bg-green-50 border-l-4 border-green-500 rounded-lg p-3 mb-3 shadow-md">
                <div class="flex items-start gap-3">
                    <i class="fas fa-check-circle text-green-600 text-xl flex-shrink-0"></i>
                    <div class="flex-1">
                        <h3 class="text-green-900 font-bold text-sm mb-1">Pendaftaran Dibuka!</h3>
                        <p class="text-green-800 text-xs">Segera daftarkan diri untuk program KKN International.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert-notification bg-green-50 border-l-4 border-green-500 rounded-lg p-3 mb-3 shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                        <span class="text-green-800 font-semibold text-sm">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert-notification bg-red-50 border-l-4 border-red-500 rounded-lg p-3 mb-3 shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                        <span class="text-red-800 font-semibold text-sm">{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="alert-notification bg-blue-50 border-l-4 border-blue-500 rounded-lg p-3 mb-3 shadow-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                        <span class="text-blue-800 font-semibold text-sm">{{ session('info') }}</span>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
            <!-- Nama Card -->
            <div class="info-card-hover relative bg-gradient-to-br from-orange-500 to-red-500 rounded-xl p-4 shadow-lg overflow-hidden">
                <div class="absolute top-2 right-2 bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full">
                    <span class="text-white text-xs font-bold">MAHASISWA</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0 border-2 border-white/30">
                        <i class="fas fa-user text-white text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white/90 text-xs font-semibold uppercase tracking-wide mb-1">Nama Lengkap</p>
                        <h3 class="text-white text-xl md:text-2xl font-bold truncate">{{ $mahasiswa->nama }}</h3>
                    </div>
                </div>
            </div>

            <!-- NIM Card -->
            <div class="info-card-hover relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-4 shadow-lg overflow-hidden">
                <div class="absolute top-2 right-2 bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full">
                    <span class="text-white text-xs font-bold">NIM</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0 border-2 border-white/30">
                        <i class="fas fa-id-card text-white text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white/90 text-xs font-semibold uppercase tracking-wide mb-1">Nomor Induk</p>
                        <h3 class="text-white text-xl md:text-2xl font-bold truncate">{{ $mahasiswa->nim }}</h3>
                    </div>
                </div>
            </div>

            <!-- Prodi Card -->
            <div class="info-card-hover relative bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl p-4 shadow-lg overflow-hidden">
                <div class="absolute top-2 right-2 bg-white/30 backdrop-blur-sm px-3 py-1 rounded-full">
                    <span class="text-white text-xs font-bold">PRODI</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-white/25 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0 border-2 border-white/30">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white/90 text-xs font-semibold uppercase tracking-wide mb-1">Program Studi</p>
                        <h3 class="text-white text-base md:text-lg font-bold leading-tight">{{ $mahasiswa->program_studi ?? '-' }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Menu -->
        <div class="mobile-card">
            <div class="mobile-card-header flex items-center gap-2">
                <i class="fas fa-th-large"></i>
                <span>Menu Cepat</span>
            </div>
            <div class="mobile-card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Daftar KKN -->
                    <div class="menu-card-hover bg-white border-2 border-gray-200 rounded-xl overflow-hidden transition-all {{ (!$pendaftaranDibuka || $adaPendingProses) ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer' }}">
                        @if(!$pendaftaranDibuka)
                            <div class="p-4 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-lock text-white text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-gray-800 font-bold text-sm mb-1">Daftar KKN International</h3>
                                    <p class="text-gray-600 text-xs">Pendaftaran ditutup</p>
                                </div>
                            </div>
                        @elseif($adaPendingProses)
                            <div class="p-4 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-white text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-gray-800 font-bold text-sm mb-1">Sedang Diproses</h3>
                                    <p class="text-gray-600 text-xs">Tunggu hasil seleksi</p>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="p-4 flex items-center gap-3 group">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-900 to-blue-800 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-plus-circle text-white text-xl"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-gray-800 font-bold text-sm mb-1">Daftar KKN International</h3>
                                    <p class="text-gray-600 text-xs">Daftarkan diri untuk program KKN</p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-blue-900 transition-colors"></i>
                            </a>
                        @endif
                    </div>

                    <!-- Edit Profile -->
                    <div class="menu-card-hover bg-white border-2 border-gray-200 rounded-xl overflow-hidden cursor-pointer transition-all">
                        <a href="{{ route('mahasiswa.profile') }}" class="p-4 flex items-center gap-3 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-cyan-600 to-cyan-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-edit text-white text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-gray-800 font-bold text-sm mb-1">Edit Profile</h3>
                                <p class="text-gray-600 text-xs">Perbarui informasi profil</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-cyan-700 transition-colors"></i>
                        </a>
                    </div>

                    <!-- Informasi KKN -->
                    <div class="menu-card-hover bg-white border-2 border-gray-200 rounded-xl overflow-hidden cursor-pointer transition-all">
                        <a href="{{ route('pendaftaran.index') }}" class="p-4 flex items-center gap-3 group">
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-info-circle text-white text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-gray-800 font-bold text-sm mb-1">Informasi KKN</h3>
                                <p class="text-gray-600 text-xs">Lihat info lengkap KKN</p>
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-gray-700 transition-colors"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration History -->
        <div class="mobile-card">
            <div class="mobile-card-header flex items-center gap-2">
                <i class="fas fa-history"></i>
                <span>Riwayat Pendaftaran</span>
            </div>
            <div class="mobile-card-body">
                @if($pendaftaran->count() > 0)
                    <div class="space-y-3">
                        @foreach($pendaftaran as $item)
                            <div class="bg-gray-50 border-l-4 border-blue-900 rounded-lg p-4">
                                <!-- Header -->
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-900 to-blue-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-globe text-white"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-gray-800 font-bold text-sm mb-2">{{ $item->negara_tujuan }}</h3>
                                        <div class="space-y-1 text-xs text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-calendar text-gray-400 w-4"></i>
                                                <span>{{ $item->periode }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-clock text-gray-400 w-4"></i>
                                                <span>{{ $item->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 pt-3 border-t border-gray-200">
                                    <div>
                                        @if($item->status == 'pending')
                                            <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-full text-xs font-bold">
                                                <i class="fas fa-clock"></i>Pending
                                            </span>
                                        @elseif($item->status == 'diproses')
                                            <span class="inline-flex items-center gap-1.5 bg-blue-100 text-blue-800 px-3 py-1.5 rounded-full text-xs font-bold">
                                                <i class="fas fa-spinner"></i>Diproses
                                            </span>
                                        @elseif($item->status == 'diterima')
                                            <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 px-3 py-1.5 rounded-full text-xs font-bold">
                                                <i class="fas fa-check"></i>Diterima
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="inline-flex items-center gap-1.5 bg-red-100 text-red-800 px-3 py-1.5 rounded-full text-xs font-bold">
                                                <i class="fas fa-times"></i>Ditolak
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex gap-2 w-full md:w-auto">
                                        <a href="{{ route('mahasiswa.pendaftaran.show', $item->id) }}" 
                                           class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 bg-white border-2 border-blue-900 text-blue-900 hover:bg-blue-50 px-4 py-2 rounded-lg text-xs font-bold transition-all">
                                            <i class="fas fa-eye"></i>Detail
                                        </a>
                                        <a href="{{ route('mahasiswa.pendaftaran.cetak-bukti', $item->id) }}" 
                                           target="_blank"
                                           class="flex-1 md:flex-none inline-flex items-center justify-center gap-1.5 bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all">
                                            <i class="fas fa-print"></i>Cetak
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-gray-700 font-bold text-base mb-2">Belum Ada Riwayat</h3>
                        <p class="text-gray-500 text-sm mb-6">
                            @if($pendaftaranDibuka)
                                Anda belum pernah mendaftar KKN International. Daftar sekarang!
                            @else
                                Pendaftaran sedang ditutup. Cek pengumuman berikutnya.
                            @endif
                        </p>
                        @if($pendaftaranDibuka && !$adaPendingProses)
                            <a href="{{ route('mahasiswa.pendaftaran.create') }}" 
                               class="inline-flex items-center gap-2 bg-blue-900 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-bold text-sm transition-all shadow-md">
                                <i class="fas fa-plus-circle"></i>Daftar Sekarang
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds - HANYA untuk notifikasi
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-notification');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endpush