@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

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

    /* Timeline Badge Active */
    .timeline-badge-active {
        animation: pulse-custom 2s infinite;
    }

    /* Text Break Word for Long Text */
    .text-break {
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
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

    /* Document Item for Mobile */
    .doc-item-mobile {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .doc-item-mobile:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .doc-item-mobile.rejected {
        border-color: #ef4444;
        background: #fef2f2;
    }

    /* Hide table on mobile, show on desktop */
    @media (max-width: 768px) {
        .desktop-table {
            display: none !important;
        }
        .mobile-view {
            display: block !important;
        }
    }

    @media (min-width: 769px) {
        .desktop-table {
            display: block !important;
        }
        .mobile-view {
            display: none !important;
        }
        
        /* Desktop Table Styles */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        table thead th {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            padding: 1rem;
            text-align: left;
            border-bottom: 3px solid #F9B234;
        }

        table tbody tr {
            background: white;
            transition: all 0.2s ease;
        }

        table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        table tbody tr:hover {
            background: #eff6ff;
            box-shadow: 0 2px 8px rgba(30, 58, 138, 0.1);
        }

        table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    <div class="main-container max-w-5xl mx-auto">
        <!-- Page Header -->
        <div class="mb-4 flex items-center justify-between flex-wrap gap-3">
            <h2 class="text-blue-900 text-lg md:text-2xl font-bold bg-white/90 backdrop-blur-sm rounded-lg px-4 py-3 border-l-4 border-yellow-500 shadow-md">
                <i class="fas fa-file-alt mr-2"></i> Detail Pendaftaran #{{ $pendaftaran->id }}
            </h2>
            <a href="{{ route('mahasiswa.dashboard') }}" 
               class="inline-flex items-center bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert-notification bg-green-50 border-l-4 border-green-500 rounded-lg p-3 mb-3 shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-lg mr-2"></i>
                    <span class="text-green-800 font-medium text-sm">{{ session('success') }}</span>
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
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-lg mr-2"></i>
                    <span class="text-red-800 font-medium text-sm">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- Informasi Pendaftaran (PALING ATAS) -->
        <div class="mobile-card">
            <div class="mobile-card-header">
                <i class="fas fa-info-circle mr-2"></i> Informasi Pendaftaran
            </div>
            <div class="mobile-card-body">
                <!-- Status Section -->
                <div class="text-center py-4 border-b border-gray-200 mb-4">
                    <div class="text-4xl mb-3">
                        @if($pendaftaran->status == 'pending')
                            <i class="fas fa-clock text-yellow-500"></i>
                        @elseif($pendaftaran->status == 'diproses')
                            <i class="fas fa-spinner fa-spin text-blue-500"></i>
                        @elseif($pendaftaran->status == 'diterima')
                            <i class="fas fa-check-circle text-green-500"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500"></i>
                        @endif
                    </div>
                    <h5 class="text-gray-700 font-semibold mb-2 text-sm">Status Pendaftaran:</h5>
                    <div class="mb-2">{!! $pendaftaran->status_badge !!}</div>
                    @if($pendaftaran->status == 'pending')
                        <p class="text-gray-600 text-xs">Menunggu verifikasi</p>
                    @elseif($pendaftaran->status == 'diproses')
                        <p class="text-gray-600 text-xs">Sedang dalam proses seleksi</p>
                    @elseif($pendaftaran->status == 'diterima')
                        <p class="text-green-600 font-medium text-xs">
                            <i class="fas fa-check-circle"></i> Selamat! Anda diterima
                        </p>
                    @elseif($pendaftaran->status == 'ditolak')
                        <p class="text-red-600 font-medium text-xs">
                            <i class="fas fa-times-circle"></i> Pendaftaran ditolak
                        </p>
                    @endif
                </div>

                <!-- Data KKN -->
                <div class="space-y-3 mb-4">
                    <div class="bg-blue-50 rounded-lg p-3 border-l-4 border-blue-600">
                        <div class="text-xs text-gray-600 mb-1">
                            <i class="fas fa-hashtag mr-1"></i> No. Pendaftaran
                        </div>
                        <div class="font-bold text-gray-800">#{{ $pendaftaran->id }}</div>
                    </div>
                    
                    <div class="bg-purple-50 rounded-lg p-3 border-l-4 border-purple-600">
                        <div class="text-xs text-gray-600 mb-1">
                            <i class="fas fa-calendar-alt mr-1"></i> Periode
                        </div>
                        <div class="font-bold text-gray-800 text-sm">{{ $pendaftaran->periode }}</div>
                    </div>
                    
                    <div class="bg-green-50 rounded-lg p-3 border-l-4 border-green-600">
                        <div class="text-xs text-gray-600 mb-1">
                            <i class="fas fa-globe-asia mr-1"></i> Negara Tujuan
                        </div>
                        <div class="font-bold text-gray-800 text-sm">{{ $pendaftaran->negara_tujuan }}</div>
                    </div>
                    
                    <div class="bg-yellow-50 rounded-lg p-3 border-l-4 border-yellow-600">
                        <div class="text-xs text-gray-600 mb-1">
                            <i class="fas fa-clock mr-1"></i> Tanggal Daftar
                        </div>
                        <div class="font-bold text-gray-800 text-sm">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y, H:i') }}</div>
                    </div>
                </div>

                <!-- Motivasi -->
                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        <strong class="text-gray-800 font-semibold text-sm">Motivasi</strong>
                    </div>
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-3">
                        <p class="text-yellow-900 text-justify leading-relaxed text-xs text-break">{{ $pendaftaran->motivasi }}</p>
                    </div>
                </div>

                <!-- Catatan Admin -->
                @if($pendaftaran->catatan_admin)
                <div class="bg-orange-50 border-l-4 border-orange-500 rounded-lg p-3 mb-4">
                    <h6 class="text-orange-900 font-bold text-xs mb-2 flex items-center">
                        <i class="fas fa-sticky-note mr-2"></i> Catatan Admin
                    </h6>
                    <p class="text-orange-800 text-xs text-break">{{ $pendaftaran->catatan_admin }}</p>
                </div>
                @endif

                <!-- Info Status -->
                @if($pendaftaran->status == 'pending')
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-3">
                    <p class="text-blue-800 text-xs flex items-start">
                        <i class="fas fa-info-circle mr-2 mt-0.5"></i>
                        <span>Mohon tunggu 3-5 hari kerja untuk proses verifikasi.</span>
                    </p>
                </div>
                @elseif($pendaftaran->status == 'diterima')
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-3">
                    <p class="text-green-800 text-xs">
                        <i class="fas fa-check-circle mr-1"></i>
                        Silakan cek email untuk instruksi lebih lanjut.
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Status Verifikasi & Timeline -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <!-- Status Verifikasi Dokumen -->
            <div class="md:col-span-2">
                <div class="mobile-card">
                    <div class="mobile-card-header">
                        <i class="fas fa-clipboard-check mr-2"></i> Status Verifikasi Dokumen
                    </div>
                    <div class="mobile-card-body">
                        @php
                            $totalDokumen = $pendaftaran->dokumen->count();
                            $diterima = $pendaftaran->dokumen->where('status_verifikasi', 'diterima')->count();
                            $ditolak = $pendaftaran->dokumen->where('status_verifikasi', 'ditolak')->count();
                            $pending = $pendaftaran->dokumen->where('status_verifikasi', 'pending')->count();
                        @endphp
                        
                        <div class="grid grid-cols-3 gap-3 mb-4">
                            <div class="bg-green-50 border-2 border-green-500 rounded-xl p-4 text-center">
                                <i class="fas fa-check-circle text-green-600 text-2xl mb-2"></i>
                                <p class="text-2xl font-bold text-green-700">{{ $diterima }}</p>
                                <p class="text-xs text-gray-700 font-semibold">Diterima</p>
                            </div>
                            <div class="bg-red-50 border-2 border-red-500 rounded-xl p-4 text-center">
                                <i class="fas fa-times-circle text-red-600 text-2xl mb-2"></i>
                                <p class="text-2xl font-bold text-red-700">{{ $ditolak }}</p>
                                <p class="text-xs text-gray-700 font-semibold">Ditolak</p>
                            </div>
                            <div class="bg-yellow-50 border-2 border-yellow-500 rounded-xl p-4 text-center">
                                <i class="fas fa-clock text-yellow-600 text-2xl mb-2"></i>
                                <p class="text-2xl font-bold text-yellow-700">{{ $pending }}</p>
                                <p class="text-xs text-gray-700 font-semibold">Pending</p>
                            </div>
                        </div>
                        
                        @if($ditolak > 0)
                        <div class="bg-red-50 border-l-4 border-red-600 rounded-lg p-3">
                            <p class="text-red-900 text-xs font-bold mb-1 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                {{ $ditolak }} Dokumen Ditolak!
                            </p>
                            <p class="text-red-800 text-xs">
                                Silakan upload ulang menggunakan tombol "Upload Ulang".
                            </p>
                        </div>
                        @elseif($diterima == $totalDokumen && $totalDokumen > 0)
                        <div class="bg-green-50 border-l-4 border-green-600 rounded-lg p-3">
                            <p class="text-green-900 text-xs font-bold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Semua dokumen terverifikasi!
                            </p>
                        </div>
                        @else
                        <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-3">
                            <p class="text-blue-900 text-xs font-bold flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                Verifikasi sedang berlangsung
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Timeline Status -->
            <div class="md:col-span-1">
                <div class="mobile-card">
                    <div class="mobile-card-header">
                        <i class="fas fa-history mr-2"></i> Riwayat Status
                    </div>
                    <div class="mobile-card-body">
                        <div class="relative pl-6">
                            <div class="absolute left-2 top-0 bottom-0 w-0.5 bg-gray-300"></div>

                            <div class="relative mb-6">
                                <div class="absolute -left-5 w-6 h-6 rounded-full flex items-center justify-center {{ $pendaftaran->status == 'pending' ? 'bg-blue-600 border-4 border-blue-300 timeline-badge-active' : 'bg-white border-4 border-gray-400' }}">
                                    <i class="fas fa-clock text-xs {{ $pendaftaran->status == 'pending' ? 'text-white' : 'text-gray-500' }}"></i>
                                </div>
                                <div>
                                    <strong class="text-sm text-gray-900 block mb-1">Pending</strong>
                                    <p class="text-xs text-gray-600">Menunggu Verifikasi</p>
                                    @if($pendaftaran->status == 'pending')
                                        <span class="text-blue-700 font-bold text-xs bg-blue-100 px-2 py-1 rounded-full inline-block mt-1">
                                            Status saat ini
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="relative mb-6">
                                <div class="absolute -left-5 w-6 h-6 rounded-full flex items-center justify-center {{ $pendaftaran->status == 'diproses' ? 'bg-blue-600 border-4 border-blue-300 timeline-badge-active' : 'bg-white border-4 border-gray-400' }}">
                                    <i class="fas fa-spinner text-xs {{ $pendaftaran->status == 'diproses' ? 'text-white' : 'text-gray-500' }}"></i>
                                </div>
                                <div>
                                    <strong class="text-sm text-gray-900 block mb-1">Diproses</strong>
                                    <p class="text-xs text-gray-600">Sedang Diseleksi</p>
                                    @if($pendaftaran->status == 'diproses')
                                        <span class="text-blue-700 font-bold text-xs bg-blue-100 px-2 py-1 rounded-full inline-block mt-1">
                                            Status saat ini
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="relative">
                                <div class="absolute -left-5 w-6 h-6 rounded-full flex items-center justify-center {{ in_array($pendaftaran->status, ['diterima', 'ditolak']) ? 'bg-blue-600 border-4 border-blue-300' : 'bg-white border-4 border-gray-400' }}">
                                    <i class="fas fa-flag-checkered text-xs {{ in_array($pendaftaran->status, ['diterima', 'ditolak']) ? 'text-white' : 'text-gray-500' }}"></i>
                                </div>
                                <div>
                                    <strong class="text-sm text-gray-900 block mb-1">Hasil</strong>
                                    @if($pendaftaran->status == 'diterima')
                                        <span class="text-green-700 font-bold text-xs bg-green-100 px-3 py-1 rounded-full inline-block">
                                            <i class="fas fa-check-circle mr-1"></i>Diterima
                                        </span>
                                    @elseif($pendaftaran->status == 'ditolak')
                                        <span class="text-red-700 font-bold text-xs bg-red-100 px-3 py-1 rounded-full inline-block">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @else
                                        <p class="text-xs text-gray-600">Menunggu Keputusan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Pendukung -->
        <div class="mobile-card">
            <div class="mobile-card-header flex items-center justify-between">
                <span><i class="fas fa-file-upload mr-2"></i> Dokumen Pendukung</span>
                <div class="flex gap-1">
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full font-bold">{{ $diterima }}</span>
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full font-bold">{{ $ditolak }}</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full font-bold">{{ $pending }}</span>
                </div>
            </div>

            <div class="p-0">
                @if($ditolak > 0)
                <div class="bg-red-50 border-l-4 border-red-500 m-4 rounded-lg p-3">
                    <p class="text-red-900 font-bold text-xs mb-1 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Perhatian!
                    </p>
                    <p class="text-red-800 text-xs">
                        Anda memiliki <strong>{{ $ditolak }} dokumen ditolak</strong>. Silakan upload ulang.
                    </p>
                </div>
                @endif

                <!-- Mobile View -->
                <div class="mobile-view p-4">
                    @forelse($pendaftaran->dokumen as $index => $dok)
                    @php
                        $jenisLabel = [
                            'ktp' => 'KTP',
                            'khs' => 'KHS Terakhir',
                            'transkrip' => 'Transkrip Nilai',
                            'sertifikat_bahasa' => 'Sertifikat Bahasa',
                            'passport' => 'Passport',
                            'surat_rekomendasi' => 'Surat Rekomendasi',
                            'surat_izin_ortu' => 'Surat Izin Ortu',
                            'pas_foto' => 'Pas Foto 3x4',
                            'lainnya' => 'Lainnya'
                        ];
                        $label = $jenisLabel[$dok->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $dok->jenis_dokumen));
                    @endphp
                    <div class="doc-item-mobile {{ $dok->status_verifikasi == 'ditolak' ? 'rejected' : '' }}">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-7 h-7 bg-blue-600 text-white rounded-full text-xs font-bold">
                                    {{ $index + 1 }}
                                </span>
                                <div>
                                    <div class="font-bold text-gray-800 text-sm">{{ $label }}</div>
                                    @if($dok->reupload_count > 0)
                                    <span class="inline-block bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full font-bold mt-1">
                                        Upload ke-{{ $dok->reupload_count + 1 }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if($dok->status_verifikasi == 'diterima')
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-bold whitespace-nowrap">
                                    <i class="fas fa-check"></i> Diterima
                                </span>
                            @elseif($dok->status_verifikasi == 'ditolak')
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold whitespace-nowrap">
                                    <i class="fas fa-times"></i> Ditolak
                                </span>
                            @else
                                <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold whitespace-nowrap">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @endif
                        </div>

                        <!-- File Info -->
                        <div class="bg-gray-50 rounded-lg p-2 mb-3">
                            <div class="text-xs text-gray-600 mb-1">
                                <i class="fas fa-file mr-1"></i> Nama File
                            </div>
                            <div class="text-sm text-gray-800 font-medium text-break">{{ $dok->nama_file }}</div>
                        </div>

                        <!-- Catatan -->
                        @if($dok->status_verifikasi == 'ditolak' && $dok->catatan_verifikasi)
                        <div class="bg-red-100 border border-red-300 rounded-lg p-2 mb-3">
                            <div class="text-red-900 text-xs font-bold mb-1">
                                <i class="fas fa-exclamation-circle mr-1"></i> Alasan ditolak
                            </div>
                            <div class="text-red-800 text-xs text-break">{{ $dok->catatan_verifikasi }}</div>
                        </div>
                        @endif

                        @if($dok->reupload_reason)
                        <div class="bg-blue-100 border border-blue-300 rounded-lg p-2 mb-3">
                            <div class="text-blue-900 text-xs font-bold mb-1">
                                <i class="fas fa-info-circle mr-1"></i> Alasan reupload
                            </div>
                            <div class="text-blue-800 text-xs text-break">{{ $dok->reupload_reason }}</div>
                        </div>
                        @endif

                        <!-- Timestamp -->
                        @if($dok->last_reuploaded_at || $dok->verified_at)
                        <div class="text-xs text-gray-500 mb-3 space-y-1">
                            @if($dok->last_reuploaded_at)
                            <div><i class="fas fa-clock mr-1"></i> Diupload: {{ $dok->last_reuploaded_at->format('d M Y H:i') }}</div>
                            @endif
                            @if($dok->verified_at)
                            <div><i class="fas fa-calendar-check mr-1"></i> Diverifikasi {{ $dok->verified_at->diffForHumans() }}</div>
                            @endif
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('mahasiswa.pendaftaran.download-dokumen', $dok->id) }}" 
                               class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-2 rounded-lg font-bold">
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                            
                            @if($dok->status_verifikasi == 'ditolak')
                            <button type="button" 
                                    onclick="showReuploadModal({{ $dok->id }}, '{{ addslashes($label) }}')"
                                    class="flex-1 inline-flex items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white text-xs px-3 py-2 rounded-lg font-bold">
                                <i class="fas fa-upload mr-1"></i> Upload Ulang
                            </button>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-folder-open text-4xl text-gray-300 mb-2"></i>
                        <p class="text-sm text-gray-500">Tidak ada dokumen</p>
                    </div>
                    @endforelse
                </div>

                <!-- Desktop Table View -->
                <div class="desktop-table">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;">No</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Nama File</th>
                                    <th class="text-center" style="width: 120px;">Status</th>
                                    <th>Catatan</th>
                                    <th class="text-center" style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaran->dokumen as $index => $dok)
                                @php
                                    $jenisLabel = [
                                        'ktp' => 'KTP',
                                        'khs' => 'KHS Terakhir',
                                        'transkrip' => 'Transkrip Nilai',
                                        'sertifikat_bahasa' => 'Sertifikat Bahasa',
                                        'passport' => 'Passport',
                                        'surat_rekomendasi' => 'Surat Rekomendasi',
                                        'surat_izin_ortu' => 'Surat Izin Ortu',
                                        'pas_foto' => 'Pas Foto 3x4',
                                        'lainnya' => 'Lainnya'
                                    ];
                                    $label = $jenisLabel[$dok->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $dok->jenis_dokumen));
                                @endphp
                                <tr class="{{ $dok->status_verifikasi == 'ditolak' ? 'bg-red-50' : '' }}">
                                    <td class="text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full text-xs font-bold">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-file-alt text-blue-600"></i>
                                            <div>
                                                <div class="font-bold text-gray-800">{{ $label }}</div>
                                                @if($dok->reupload_count > 0)
                                                <span class="inline-block bg-blue-600 text-white text-xs px-2 py-0.5 rounded-full font-bold mt-1">
                                                    <i class="fas fa-history mr-1"></i> Upload ke-{{ $dok->reupload_count + 1 }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="text-sm text-gray-700 text-break">{{ $dok->nama_file }}</div>
                                        @if($dok->last_reuploaded_at)
                                        <small class="text-green-700 text-xs flex items-center mt-1">
                                            <i class="fas fa-clock mr-1"></i> Diupload ulang: {{ $dok->last_reuploaded_at->format('d M Y H:i') }}
                                        </small>
                                        @endif
                                        @if($dok->verified_at)
                                        <small class="text-gray-500 text-xs flex items-center mt-1">
                                            <i class="fas fa-calendar-check mr-1"></i> Diverifikasi {{ $dok->verified_at->diffForHumans() }}
                                        </small>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($dok->status_verifikasi == 'diterima')
                                            <span class="inline-flex items-center bg-green-500 text-white text-xs px-3 py-1.5 rounded-full font-bold">
                                                <i class="fas fa-check-circle mr-1"></i> Diterima
                                            </span>
                                        @elseif($dok->status_verifikasi == 'ditolak')
                                            <span class="inline-flex items-center bg-red-500 text-white text-xs px-3 py-1.5 rounded-full font-bold">
                                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center bg-yellow-500 text-white text-xs px-3 py-1.5 rounded-full font-bold">
                                                <i class="fas fa-clock mr-1"></i> Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($dok->status_verifikasi == 'ditolak' && $dok->catatan_verifikasi)
                                        <div class="bg-red-100 border border-red-300 rounded-lg p-2">
                                            <div class="text-red-900 text-xs font-bold mb-1 flex items-center">
                                                <i class="fas fa-exclamation-circle mr-1"></i> Alasan ditolak
                                            </div>
                                            <div class="text-red-800 text-xs text-break">{{ $dok->catatan_verifikasi }}</div>
                                        </div>
                                        @elseif($dok->reupload_reason)
                                        <div class="bg-blue-100 border border-blue-300 rounded-lg p-2">
                                            <div class="text-blue-900 text-xs font-bold mb-1 flex items-center">
                                                <i class="fas fa-info-circle mr-1"></i> Alasan reupload
                                            </div>
                                            <div class="text-blue-800 text-xs text-break">{{ $dok->reupload_reason }}</div>
                                        </div>
                                        @else
                                        <span class="text-gray-400 text-xs italic">Tidak ada catatan</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('mahasiswa.pendaftaran.download-dokumen', $dok->id) }}" 
                                               class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-2 rounded-lg font-bold transition-all"
                                               title="Download Dokumen">
                                                <i class="fas fa-download mr-1"></i> Download
                                            </a>
                                            
                                            @if($dok->status_verifikasi == 'ditolak')
                                            <button type="button" 
                                                    onclick="showReuploadModal({{ $dok->id }}, '{{ addslashes($label) }}')"
                                                    class="inline-flex items-center justify-center bg-yellow-600 hover:bg-yellow-700 text-white text-xs px-3 py-2 rounded-lg font-bold transition-all"
                                                    title="Upload Ulang">
                                                <i class="fas fa-upload mr-1"></i> Upload Ulang
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12">
                                        <i class="fas fa-folder-open text-5xl text-gray-300 mb-3"></i>
                                        <p class="text-sm font-semibold text-gray-500">Tidak ada dokumen yang diupload</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ route('mahasiswa.dashboard') }}" 
               class="inline-flex items-center justify-center bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-lg font-bold text-sm transition-all shadow-lg w-full md:w-auto">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Modal Reupload Dokumen -->
<div id="reuploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <form id="reuploadForm" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-4 py-3 flex items-center justify-between rounded-t-xl">
                <h5 class="text-white font-bold text-sm flex items-center">
                    <i class="fas fa-upload mr-2"></i> Upload Ulang Dokumen
                </h5>
                <button type="button" onclick="closeReuploadModal()" class="text-white hover:text-gray-200 text-2xl leading-none font-bold">
                    &times;
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4">
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded p-3 mb-4">
                    <small class="text-blue-800 text-xs flex items-start">
                        <i class="fas fa-info-circle mr-2 mt-0.5 flex-shrink-0"></i>
                        <span><strong>Perhatian:</strong> File lama akan digantikan dengan file baru dan status akan kembali ke "Pending" menunggu verifikasi admin.</span>
                    </small>
                </div>
                
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Jenis Dokumen:</label>
                    <p id="dokumenJenis" class="text-gray-800 text-sm font-bold bg-gray-100 px-3 py-2 rounded-lg"></p>
                </div>
                
                <div class="mb-4">
                    <label for="reupload_file" class="block text-xs font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-upload mr-1"></i> Pilih File Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="file" 
                           class="block w-full text-xs text-gray-700 border-2 border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all" 
                           id="reupload_file" 
                           name="file" 
                           accept=".pdf,.jpg,.jpeg,.png" 
                           required>
                    <small class="block text-gray-500 text-xs mt-2">
                        <i class="fas fa-info-circle mr-1"></i> Format: PDF, JPG, PNG (Max: 2MB)
                    </small>
                </div>
                
                <div class="mb-4">
                    <label for="reupload_reason" class="block text-xs font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment mr-1"></i> Alasan Upload Ulang <span class="text-red-500">*</span>
                    </label>
                    <textarea class="block w-full text-xs text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-3 transition-all" 
                              id="reupload_reason" 
                              name="reupload_reason" 
                              rows="4" 
                              placeholder="Jelaskan alasan Anda mengupload ulang dokumen ini..."
                              required></textarea>
                    <small class="block text-gray-500 text-xs mt-2">
                        <i class="fas fa-lightbulb mr-1"></i> Contoh: "Memperbaiki kualitas foto" atau "Mengganti dengan dokumen yang benar"
                    </small>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-2 rounded-b-xl">
                <button type="button" 
                        onclick="closeReuploadModal()"
                        class="px-4 py-2.5 bg-gray-600 hover:bg-gray-700 text-white rounded-lg font-semibold text-xs transition-all shadow-md">
                    <i class="fas fa-times mr-1"></i> Batal
                </button>
                <button type="submit" 
                        class="px-4 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold text-xs transition-all shadow-md">
                    <i class="fas fa-upload mr-1"></i> Upload Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Show Reupload Modal
function showReuploadModal(dokumenId, jenisNama) {
    const modal = document.getElementById('reuploadModal');
    const form = document.getElementById('reuploadForm');
    
    // Set form action
    form.action = `/mahasiswa/dokumen/${dokumenId}/reupload`;
    
    // Set jenis dokumen
    document.getElementById('dokumenJenis').textContent = jenisNama;
    
    // Reset form
    form.reset();
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Close Reupload Modal
function closeReuploadModal() {
    const modal = document.getElementById('reuploadModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('reuploadModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeReuploadModal();
    }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeReuploadModal();
    }
});

// Preview file size and type
document.getElementById('reupload_file')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const sizeMB = (file.size / 1024 / 1024).toFixed(2);
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
        
        if (!allowedTypes.includes(file.type)) {
            alert('Tipe file tidak valid! Hanya menerima PDF, JPG, atau PNG.');
            this.value = '';
            return;
        }
        
        if (sizeMB > 2) {
            alert('Ukuran file terlalu besar! Maksimal 2MB. File Anda: ' + sizeMB + 'MB');
            this.value = '';
        }
    }
});

// ✅ FIXED: Auto-hide alerts after 5 seconds - HANYA untuk notifikasi di bagian atas
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        // Target HANYA elemen dengan class 'alert-notification'
        const alerts = document.querySelectorAll('.alert-notification');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});

// Form validation before submit
document.getElementById('reuploadForm')?.addEventListener('submit', function(e) {
    const file = document.getElementById('reupload_file').files[0];
    const reason = document.getElementById('reupload_reason').value.trim();
    
    if (!file) {
        e.preventDefault();
        alert('Silakan pilih file yang akan diupload!');
        return false;
    }
    
    if (!reason || reason.length < 10) {
        e.preventDefault();
        alert('Alasan upload ulang harus diisi minimal 10 karakter!');
        document.getElementById('reupload_reason').focus();
        return false;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mengupload...';
});
</script>
@endpush