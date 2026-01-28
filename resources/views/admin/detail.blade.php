{{-- resources/views/admin/pendaftaran/show.blade.php --}}
@extends('layouts.admin-no-sidebar')

@section('title', 'Detail Pendaftaran')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-full mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6 overflow-x-hidden">
    
    {{-- Breadcrumb --}}
    <nav class="mb-4" aria-label="breadcrumb">
        <ol class="flex flex-wrap items-center gap-2 text-sm">
            <li><a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors"><i class="fas fa-home mr-1"></i> Dashboard</a></li>
            <li class="text-gray-400"><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-600 font-medium truncate">Detail Pendaftaran</li>
        </ol>
    </nav>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-4 mb-4 rounded-lg shadow-sm animate-fade-in">
        <div class="flex items-start">
            <i class="fas fa-check-circle text-green-500 text-xl mt-0.5 mr-3"></i>
            <div class="flex-1 min-w-0"><p class="text-green-800 font-medium break-words">{{ session('success') }}</p></div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700 ml-3 flex-shrink-0"><i class="fas fa-times"></i></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 p-4 mb-4 rounded-lg shadow-sm animate-fade-in">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-500 text-xl mt-0.5 mr-3"></i>
            <div class="flex-1 min-w-0"><p class="text-red-800 font-medium break-words">{{ session('error') }}</p></div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700 ml-3 flex-shrink-0"><i class="fas fa-times"></i></button>
        </div>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="min-w-0 flex-1">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-1 flex items-center gap-2">
                <i class="fas fa-file-alt text-blue-600 text-lg sm:text-xl flex-shrink-0"></i>
                <span class="truncate">Detail #{{ $pendaftaran->id }}</span>
            </h2>
            <p class="text-gray-600 text-xs sm:text-sm">Informasi lengkap pendaftaran KKN International</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('admin.pendaftaran.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg transition-all duration-300 text-sm">
                <i class="fas fa-arrow-left text-xs"></i><span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="space-y-3 sm:space-y-4">
        
        {{-- Status Card --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-4 py-3 border-b-2 border-yellow-400">
                <h5 class="text-base font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-info-circle text-yellow-400 text-sm"></i>Status Pendaftaran
                </h5>
            </div>
            <div class="p-4 sm:p-5">
                <div class="text-center mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Status Saat Ini:</h3>
                    <div class="mb-2">{!! $pendaftaran->status_badge !!}</div>
                    <p class="text-gray-600 text-xs break-words">
                        <i class="fas fa-calendar-alt mr-1 text-blue-500"></i>
                        Tanggal: <strong class="text-blue-900">{{ $pendaftaran->created_at->format('d F Y, H:i') }}</strong>
                    </p>
                </div>

                @if($pendaftaran->catatan_admin)
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 p-3 rounded mb-4">
                    <h6 class="font-bold text-blue-900 mb-1 flex items-center gap-2 text-sm">
                        <i class="fas fa-sticky-note text-blue-500 text-xs"></i>Catatan Admin:
                    </h6>
                    <p class="text-gray-700 text-sm break-words whitespace-pre-wrap">{{ $pendaftaran->catatan_admin }}</p>
                </div>
                @endif

                <form action="{{ route('admin.pendaftaran.update-status', $pendaftaran->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-blue-900 mb-1.5">Update Status <span class="text-red-500">*</span></label>
                            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 bg-white text-sm">
                                <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                <option value="diproses" {{ $pendaftaran->status == 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                <option value="diterima" {{ $pendaftaran->status == 'diterima' ? 'selected' : '' }}>✅ Diterima</option>
                                <option value="ditolak" {{ $pendaftaran->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-blue-900 mb-1.5">Catatan <span class="text-gray-500 text-xs">(Opsional)</span></label>
                            <input type="text" name="catatan_admin" value="{{ $pendaftaran->catatan_admin }}" placeholder="Tambahkan catatan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all duration-200 bg-white text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 inline-flex items-center gap-2 text-sm">
                                <i class="fas fa-save text-xs"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Action Bar --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            
            {{-- Quick Actions --}}
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-3 py-2">
                    <h6 class="font-bold text-gray-900 flex items-center gap-1.5 text-xs">
                        <i class="fas fa-bolt" style="font-size:10px"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="p-3 grid grid-cols-3 gap-2">
                    <button type="button" onclick="updateStatus('diterima')" class="px-2 py-2 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 inline-flex flex-col items-center justify-center gap-1 text-xs">
                        <i class="fas fa-check" style="font-size:14px"></i><span class="text-xs">Terima</span>
                    </button>
                    <button type="button" onclick="updateStatus('ditolak')" class="px-2 py-2 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 inline-flex flex-col items-center justify-center gap-1 text-xs">
                        <i class="fas fa-times" style="font-size:14px"></i><span class="text-xs">Tolak</span>
                    </button>
                    <button type="button" onclick="updateStatus('diproses')" class="px-2 py-2 bg-gradient-to-r from-cyan-600 to-blue-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 inline-flex flex-col items-center justify-center gap-1 text-xs">
                        <i class="fas fa-spinner" style="font-size:14px"></i><span class="text-xs">Proses</span>
                    </button>
                    <form action="{{ route('admin.pendaftaran.destroy', $pendaftaran->id) }}" method="POST" id="deleteForm" class="col-span-3">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete()" class="w-full px-3 py-2 bg-white border-2 border-red-500 text-red-600 rounded-lg font-semibold hover:bg-red-50 transition-all duration-300 inline-flex items-center justify-center gap-1.5 text-xs">
                            <i class="fas fa-trash" style="font-size:10px"></i>Hapus Pendaftaran
                        </button>
                    </form>
                </div>
            </div>

            {{-- Cetak Bukti --}}
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg shadow border border-green-200 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-3 py-2">
                    <h6 class="font-bold text-white flex items-center gap-1.5 text-xs">
                        <i class="fas fa-barcode" style="font-size:10px"></i>Bukti Pendaftaran
                    </h6>
                </div>
                <div class="p-3 text-center">
                    <a href="{{ route('admin.pendaftaran.cetak-bukti', $pendaftaran->id) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 text-xs mb-2">
                        <i class="fas fa-print" style="font-size:10px"></i>Cetak Bukti
                    </a>
                    @if($pendaftaran->barcode_number)
                    <p class="text-xs text-gray-600 break-all">
                        <code class="bg-white px-2 py-0.5 rounded font-mono text-green-700" style="font-size:10px">{{ $pendaftaran->barcode_number }}</code>
                    </p>
                    <a href="{{ url('/verify-registration/' . $pendaftaran->barcode_number) }}" target="_blank" class="text-green-700 hover:text-green-900 font-medium inline-flex items-center gap-1 mt-1" style="font-size:10px">
                        <i class="fas fa-external-link-alt"></i>Verifikasi
                    </a>
                    @endif
                </div>
            </div>

            {{-- Timeline Status --}}
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-3 py-2">
                    <h6 class="font-bold text-white flex items-center gap-1.5 text-xs">
                        <i class="fas fa-history" style="font-size:10px"></i>Riwayat Status
                    </h6>
                </div>
                <div class="p-3">
                    <div class="relative space-y-3">
                        <div class="absolute left-2 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                        
                        <div class="relative flex items-start gap-2">
                            <div class="relative z-10 w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 {{ $pendaftaran->status == 'pending' ? 'bg-yellow-500 ring-2 ring-yellow-100' : 'bg-white border-2 border-gray-300' }}">
                                <i class="fas fa-clock {{ $pendaftaran->status == 'pending' ? 'text-white' : 'text-gray-400' }}" style="font-size:6px"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h6 class="font-bold text-gray-800 mb-0 truncate" style="font-size:11px">Pending</h6>
                                <p class="text-gray-500 truncate" style="font-size:9px">Menunggu Verifikasi</p>
                            </div>
                        </div>
                        
                        <div class="relative flex items-start gap-2">
                            <div class="relative z-10 w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 {{ $pendaftaran->status == 'diproses' ? 'bg-cyan-500 ring-2 ring-cyan-100' : 'bg-white border-2 border-gray-300' }}">
                                <i class="fas fa-spinner {{ $pendaftaran->status == 'diproses' ? 'text-white' : 'text-gray-400' }}" style="font-size:6px"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h6 class="font-bold text-gray-800 mb-0 truncate" style="font-size:11px">Diproses</h6>
                                <p class="text-gray-500 truncate" style="font-size:9px">Sedang Diseleksi</p>
                            </div>
                        </div>
                        
                        <div class="relative flex items-start gap-2">
                            <div class="relative z-10 w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 {{ in_array($pendaftaran->status, ['diterima', 'ditolak']) ? 'bg-blue-500 ring-2 ring-blue-100' : 'bg-white border-2 border-gray-300' }}">
                                <i class="fas fa-flag-checkered {{ in_array($pendaftaran->status, ['diterima', 'ditolak']) ? 'text-white' : 'text-gray-400' }}" style="font-size:6px"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h6 class="font-bold text-gray-800 mb-0 truncate" style="font-size:11px">Hasil</h6>
                                <p style="font-size:9px" class="truncate">
                                    @if($pendaftaran->status == 'diterima')<span class="text-green-600 font-bold">✅ Diterima</span>
                                    @elseif($pendaftaran->status == 'ditolak')<span class="text-red-600 font-bold">❌ Ditolak</span>
                                    @else<span class="text-gray-500">Menunggu</span>@endif
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($pendaftaran->updated_at != $pendaftaran->created_at)
                    <div class="mt-2 pt-2 border-t border-gray-200">
                        <p class="text-gray-500 truncate" style="font-size:9px">
                            <i class="fas fa-clock mr-1"></i>{{ $pendaftaran->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Data Mahasiswa --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-4 py-3 border-b-2 border-yellow-400">
                <h5 class="text-base font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-user-graduate text-yellow-400 text-sm"></i>Data Mahasiswa
                </h5>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">NIM</p>
                        <p class="font-bold text-blue-900 break-words">{{ $pendaftaran->mahasiswa->nim ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Nama Lengkap</p>
                        <p class="font-semibold text-gray-800 text-sm break-words">{{ $pendaftaran->mahasiswa->name ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Email</p>
                        <p class="font-medium text-gray-700 text-xs break-all">{{ $pendaftaran->mahasiswa->email ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">No. Telepon/WA</p>
                        <p class="font-medium text-gray-700 text-sm break-words">{{ $pendaftaran->mahasiswa->no_telepon ?? $pendaftaran->mahasiswa->phone ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Fakultas</p>
                        @if($pendaftaran->mahasiswa->fakultas)
                            <span class="inline-block px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-xs font-semibold break-words">{{ $pendaftaran->mahasiswa->fakultas }}</span>
                        @else<p class="text-gray-400 text-sm">-</p>@endif
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Program Studi</p>
                        <p class="font-medium text-gray-700 text-sm break-words">{{ $pendaftaran->mahasiswa->program_studi ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Angkatan</p>
                        @if($pendaftaran->mahasiswa->angkatan)<p class="font-bold text-blue-600">{{ $pendaftaran->mahasiswa->angkatan }}</p>
                        @else<p class="text-gray-400 text-sm">-</p>@endif
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Semester</p>
                        @if($pendaftaran->mahasiswa->semester)<p class="font-bold text-cyan-600">{{ $pendaftaran->mahasiswa->semester }}</p>
                        @else<p class="text-gray-400 text-sm">-</p>@endif
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">IPK</p>
                        @if($pendaftaran->mahasiswa->ipk)<p class="font-bold text-green-600 text-lg">{{ number_format($pendaftaran->mahasiswa->ipk, 2) }}</p>
                        @else<p class="text-gray-400 text-sm">-</p>@endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Data KKN International --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-4 py-3 border-b-2 border-yellow-400">
                <h5 class="text-base font-semibold text-white flex items-center gap-2">
                    <i class="fas fa-globe text-yellow-400 text-sm"></i>Data KKN International
                </h5>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-4">
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Periode</p>
                        <p class="font-bold text-gray-800 break-words">{{ $pendaftaran->periode }}</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded border border-gray-200 min-w-0">
                        <p class="text-xs text-gray-500 mb-0.5">Negara Tujuan</p>
                        <span class="inline-block px-2 py-1 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded text-xs font-semibold break-words">{{ $pendaftaran->negara_tujuan }}</span>
                    </div>
                </div>
                
                <div class="min-w-0">
                    <label class="block text-xs font-semibold text-blue-900 mb-2">
                        <i class="fas fa-heart mr-1 text-red-500"></i> Motivasi:
                    </label>
                    <div class="bg-gradient-to-br from-gray-50 to-blue-50 p-4 rounded border border-blue-100 overflow-hidden">
                        <p class="text-gray-700 leading-relaxed text-sm break-words whitespace-pre-wrap">{{ $pendaftaran->motivasi }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-4 py-3 border-b-2 border-yellow-400">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h5 class="text-base font-semibold text-white flex items-center gap-2">
                        <i class="fas fa-file-upload text-yellow-400 text-sm"></i>Dokumen Pendukung
                    </h5>
                    @php
                        $totalDokumen = $pendaftaran->dokumen->count();
                        $diterima = $pendaftaran->dokumen->where('status_verifikasi', 'diterima')->count();
                        $ditolak = $pendaftaran->dokumen->where('status_verifikasi', 'ditolak')->count();
                        $pending = $pendaftaran->dokumen->where('status_verifikasi', 'pending')->count();
                    @endphp
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-500 text-white rounded text-xs font-semibold">
                            <i class="fas fa-check" style="font-size:8px"></i> {{ $diterima }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-500 text-white rounded text-xs font-semibold">
                            <i class="fas fa-times" style="font-size:8px"></i> {{ $ditolak }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-400 text-gray-900 rounded text-xs font-semibold">
                            <i class="fas fa-clock" style="font-size:8px"></i> {{ $pending }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($pendaftaran->dokumen->count() > 0)
                @php $reuploadedDocs = $pendaftaran->dokumen->where('reupload_count', '>', 0)->count(); @endphp
                
                @if($reuploadedDocs > 0)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 m-4">
                    <h6 class="font-bold text-yellow-900 mb-1 flex items-center gap-2">
                        <i class="fas fa-history"></i> Dokumen Di-upload Ulang
                    </h6>
                    <p class="text-yellow-800 text-sm break-words">Ada <strong>{{ $reuploadedDocs }} dokumen</strong> yang telah diupload ulang.</p>
                </div>
                @endif
                
                {{-- Bulk Action Toolbar --}}
                <div id="bulkActionToolbar" class="hidden bg-yellow-50 border-b border-yellow-200 p-3 mx-3 mt-3 rounded">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                        <div class="flex-1 min-w-0">
                            <span class="font-semibold text-gray-700 text-sm"><span id="selectedCount">0</span> dokumen terpilih</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="bulkUpdateStatus('diterima')" class="px-3 py-1.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors text-xs inline-flex items-center gap-1.5">
                                <i class="fas fa-check" style="font-size:10px"></i> Terima
                            </button>
                            <button type="button" onclick="bulkUpdateStatus('ditolak')" class="px-3 py-1.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors text-xs inline-flex items-center gap-1.5">
                                <i class="fas fa-times" style="font-size:10px"></i> Tolak
                            </button>
                            <button type="button" onclick="clearSelection()" class="px-3 py-1.5 bg-gray-600 text-white rounded-lg font-semibold hover:bg-gray-700 transition-colors text-xs inline-flex items-center gap-1.5">
                                <i class="fas fa-times-circle" style="font-size:10px"></i> Batal
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Desktop Table View --}}
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-yellow-400">
                            <tr>
                                <th class="px-3 py-2 text-left w-10"><input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="w-4 h-4 text-blue-600 rounded"></th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-blue-900 uppercase w-12">No</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-blue-900 uppercase">Jenis</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-blue-900 uppercase">File & Catatan</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-blue-900 uppercase w-20">Size</th>
                                <th class="px-3 py-2 text-left text-xs font-bold text-blue-900 uppercase w-24">Status</th>
                                <th class="px-3 py-2 text-center text-xs font-bold text-blue-900 uppercase w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pendaftaran->dokumen as $index => $dok)
                            @php
                                $jenisLabel = ['ktp'=>'KTP','khs'=>'KHS Terakhir','transkrip'=>'Transkrip Nilai','sertifikat_bahasa'=>'Sertifikat Bahasa','passport'=>'Passport','surat_rekomendasi'=>'Surat Rekomendasi','surat_izin_ortu'=>'Surat Izin Ortu','bukti_pembayaran'=>'Bukti Pembayaran','lainnya'=>'Lainnya'];
                                $label = $jenisLabel[$dok->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $dok->jenis_dokumen));
                                $extension = strtolower(pathinfo($dok->nama_file, PATHINFO_EXTENSION));
                                $isPdf = $extension === 'pdf';
                                $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                                $canPreview = $isPdf || $isImage;
                            @endphp
                            <tr id="doc-row-{{ $dok->id }}" class="hover:bg-blue-50 transition-colors border-b border-gray-100 {{ $dok->reupload_count > 0 ? 'bg-yellow-50' : '' }}">
                                <td class="px-3 py-2"><input type="checkbox" class="doc-checkbox w-4 h-4 text-blue-600 rounded" value="{{ $dok->id }}" onchange="updateBulkToolbar()"></td>
                                <td class="px-3 py-2 text-xs font-medium text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-3 py-2">
                                    <span class="inline-block px-2 py-0.5 bg-gray-200 text-gray-800 rounded text-xs font-semibold whitespace-nowrap">
                                        <i class="fas fa-file-alt mr-1" style="font-size:9px"></i> {{ $label }}
                                    </span>
                                    @if($dok->reupload_count > 0)<br>
                                    <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-xs font-semibold mt-1">
                                        <i class="fas fa-history" style="font-size:9px"></i> x{{ $dok->reupload_count }}
                                    </span>@endif
                                </td>
                                <td class="px-3 py-2 min-w-0">
                                    <p class="text-xs text-gray-600 break-all font-medium">{{ $dok->nama_file }}</p>
                                    @if($dok->catatan_verifikasi)
                                    <div class="bg-red-50 border border-red-200 rounded p-2 mt-1">
                                        <p class="text-xs text-red-900 font-bold mb-0.5"><i class="fas fa-exclamation-circle" style="font-size:9px"></i> Alasan Ditolak:</p>
                                        <p class="text-xs text-red-800 break-words">{{ $dok->catatan_verifikasi }}</p>
                                    </div>@endif
                                    @if($dok->reupload_reason)
                                    <div class="bg-blue-50 border border-blue-200 rounded p-2 mt-1">
                                        <p class="text-xs text-blue-900 font-bold mb-0.5"><i class="fas fa-comment" style="font-size:9px"></i> Alasan Reupload:</p>
                                        <p class="text-xs text-blue-800 break-words">{{ $dok->reupload_reason }}</p>
                                    </div>@endif
                                    @if($dok->last_reuploaded_at)
                                    <small class="text-green-700 text-xs flex items-center mt-1">
                                        <i class="fas fa-clock mr-1"></i> Diupload ulang: {{ $dok->last_reuploaded_at->format('d M Y H:i') }}
                                    </small>@endif
                                </td>
                                <td class="px-3 py-2 text-xs text-gray-600">
                                    @if(file_exists(storage_path('app/public/' . $dok->path_file))){{ number_format(filesize(storage_path('app/public/' . $dok->path_file)) / 1024, 0) }}KB
                                    @else<span class="text-red-500">-</span>@endif
                                </td>
                                <td class="px-3 py-2"><span id="status-badge-{{ $dok->id }}">{!! $dok->status_badge !!}</span></td>
                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                        @if($canPreview)
                                        <button type="button" onclick="previewDocument('{{ asset('storage/' . $dok->path_file) }}', '{{ $label }}', '{{ $isPdf ? 'pdf' : 'image' }}')" class="px-2 py-1.5 bg-cyan-500 text-white rounded hover:bg-cyan-600 transition-colors text-xs font-semibold whitespace-nowrap" title="Lihat">
                                            <i class="fas fa-eye" style="font-size:9px"></i>
                                        </button>@endif
                                        <a href="{{ route('admin.dokumen.download', $dok->id) }}" class="px-2 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors text-xs font-semibold whitespace-nowrap" title="Download">
                                            <i class="fas fa-download" style="font-size:9px"></i>
                                        </a>
                                        @if($dok->status_verifikasi != 'diterima')
                                        <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'diterima')" class="px-2 py-1.5 bg-green-500 text-white rounded hover:bg-green-600 transition-colors btn-accept-{{ $dok->id }} text-xs font-semibold whitespace-nowrap" title="Terima">
                                            <i class="fas fa-check" style="font-size:9px"></i>
                                        </button>@endif
                                        @if($dok->status_verifikasi != 'ditolak')
                                        <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'ditolak')" class="px-2 py-1.5 bg-red-500 text-white rounded hover:bg-red-600 transition-colors btn-reject-{{ $dok->id }} text-xs font-semibold whitespace-nowrap" title="Tolak">
                                            <i class="fas fa-times" style="font-size:9px"></i>
                                        </button>@endif
                                        @if($dok->status_verifikasi != 'pending')
                                        <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'pending')" class="px-2 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors btn-reset-{{ $dok->id }} text-xs font-semibold whitespace-nowrap" title="Reset">
                                            <i class="fas fa-undo" style="font-size:9px"></i>
                                        </button>@endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View --}}
                <div class="lg:hidden p-3 space-y-3">
                    @foreach($pendaftaran->dokumen as $index => $dok)
                    @php
                        $jenisLabel = ['ktp'=>'KTP','khs'=>'KHS Terakhir','transkrip'=>'Transkrip Nilai','sertifikat_bahasa'=>'Sertifikat Bahasa','passport'=>'Passport','surat_rekomendasi'=>'Surat Rekomendasi','surat_izin_ortu'=>'Surat Izin Ortu','bukti_pembayaran'=>'Bukti Pembayaran','lainnya'=>'Lainnya'];
                        $label = $jenisLabel[$dok->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $dok->jenis_dokumen));
                        $extension = strtolower(pathinfo($dok->nama_file, PATHINFO_EXTENSION));
                        $isPdf = $extension === 'pdf';
                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                        $canPreview = $isPdf || $isImage;
                    @endphp
                    <div class="bg-white border-2 border-gray-200 rounded-lg p-4 {{ $dok->reupload_count > 0 ? 'bg-yellow-50 border-yellow-300' : '' }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="doc-checkbox w-4 h-4 text-blue-600 rounded" value="{{ $dok->id }}" onchange="updateBulkToolbar()">
                                <span class="font-bold text-gray-700">#{{ $index + 1 }}</span>
                            </div>
                            <span id="status-badge-mobile-{{ $dok->id }}">{!! $dok->status_badge !!}</span>
                        </div>
                        
                        <div class="space-y-2 mb-3">
                            <div>
                                <span class="inline-block px-2 py-1 bg-gray-200 text-gray-800 rounded text-xs font-semibold">
                                    <i class="fas fa-file-alt mr-1"></i> {{ $label }}
                                </span>
                                @if($dok->reupload_count > 0)
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold ml-1">
                                    <i class="fas fa-history"></i> Re-upload {{ $dok->reupload_count }}x
                                </span>@endif
                            </div>
                            <p class="text-xs text-gray-600 break-all"><i class="fas fa-file mr-1"></i> {{ $dok->nama_file }}</p>
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-hdd mr-1"></i>
                                @if(file_exists(storage_path('app/public/' . $dok->path_file))){{ number_format(filesize(storage_path('app/public/' . $dok->path_file)) / 1024, 2) }} KB
                                @else<span class="text-red-500">File hilang</span>@endif
                            </p>
                            @if($dok->catatan_verifikasi)
                            <div class="bg-red-50 border border-red-300 rounded-lg p-2">
                                <p class="text-xs text-red-900 font-bold mb-1"><i class="fas fa-exclamation-circle"></i> Alasan Ditolak</p>
                                <p class="text-xs text-red-800 break-words">{{ $dok->catatan_verifikasi }}</p>
                            </div>@endif
                            @if($dok->reupload_reason)
                            <div class="bg-blue-50 border border-blue-300 rounded-lg p-2">
                                <p class="text-xs text-blue-900 font-bold mb-1"><i class="fas fa-comment"></i> Alasan Reupload</p>
                                <p class="text-xs text-blue-800 break-words">{{ $dok->reupload_reason }}</p>
                            </div>@endif
                            @if($dok->last_reuploaded_at)
                            <p class="text-xs text-green-700 break-words"><i class="fas fa-clock"></i> Diupload ulang: {{ $dok->last_reuploaded_at->format('d M Y H:i') }}</p>
                            @endif
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            @if($canPreview)
                            <button type="button" onclick="previewDocument('{{ asset('storage/' . $dok->path_file) }}', '{{ $label }}', '{{ $isPdf ? 'pdf' : 'image' }}')" class="flex-1 px-3 py-2 bg-cyan-500 text-white rounded-lg font-semibold hover:bg-cyan-600 transition-colors text-sm inline-flex items-center justify-center gap-2">
                                <i class="fas fa-eye"></i> Lihat
                            </button>@endif
                            <a href="{{ route('admin.dokumen.download', $dok->id) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-colors text-sm inline-flex items-center justify-center gap-2">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @if($dok->status_verifikasi != 'diterima')
                            <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'diterima')" class="flex-1 px-3 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 transition-colors text-sm inline-flex items-center justify-center gap-2 btn-accept-{{ $dok->id }}">
                                <i class="fas fa-check"></i> Terima
                            </button>@endif
                            @if($dok->status_verifikasi != 'ditolak')
                            <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'ditolak')" class="flex-1 px-3 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-colors text-sm inline-flex items-center justify-center gap-2 btn-reject-{{ $dok->id }}">
                                <i class="fas fa-times"></i> Tolak
                            </button>@endif
                            @if($dok->status_verifikasi != 'pending')
                            <button type="button" onclick="updateDokumenStatus({{ $dok->id }}, 'pending')" class="flex-1 px-3 py-2 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600 transition-colors text-sm inline-flex items-center justify-center gap-2 btn-reset-{{ $dok->id }}">
                                <i class="fas fa-undo"></i> Reset
                            </button>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 font-medium">Tidak ada dokumen</p>
                </div>
            @endif
        </div>
    </div>
</div>
</div>

{{-- Modal Preview --}}
<div id="previewModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-6xl w-full overflow-hidden">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 flex items-center justify-between">
            <h5 id="previewModalLabel" class="text-lg font-semibold text-white flex items-center gap-2">
                <i class="fas fa-file-alt"></i>Preview Dokumen
            </h5>
            <button type="button" onclick="closePreviewModal()" class="text-white hover:text-yellow-400 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="previewContent" class="bg-gray-100 p-4" style="min-height:500px;max-height:80vh;overflow-y:auto">
            <div class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-gray-300 border-t-blue-600"></div>
                <p class="mt-4 text-gray-600">Memuat dokumen...</p>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-4 flex justify-end">
            <button type="button" onclick="closePreviewModal()" class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-times"></i>Tutup
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const csrfToken=document.querySelector('meta[name="csrf-token"]')?.content||'{{ csrf_token() }}';
function previewDocument(url,title,type){const modal=document.getElementById('previewModal'),modalTitle=document.getElementById('previewModalLabel'),previewContent=document.getElementById('previewContent');modalTitle.innerHTML=`<i class="fas fa-file-alt mr-2"></i> Preview: ${title}`;previewContent.innerHTML='<div class="text-center py-12"><div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-gray-300 border-t-blue-600"></div><p class="mt-4 text-gray-600">Memuat dokumen...</p></div>';modal.classList.remove('hidden');setTimeout(()=>{if(type==='pdf')previewContent.innerHTML=`<iframe src="${url}" class="w-full rounded-lg border-2 border-gray-300" style="height:600px"></iframe>`;else if(type==='image')previewContent.innerHTML=`<div class="bg-white p-4 rounded-lg"><img src="${url}" class="max-w-full h-auto mx-auto rounded-lg shadow-lg" alt="${title}"></div>`},300)}
function closePreviewModal(){document.getElementById('previewModal').classList.add('hidden')}
function updateDokumenStatus(dokumenId,status){const confirmMessages={'diterima':'Apakah Anda yakin ingin menerima dokumen ini?','ditolak':'Apakah Anda yakin ingin menolak dokumen ini?','pending':'Apakah Anda yakin ingin mereset status dokumen ini?'};if(!confirm(confirmMessages[status]))return;let catatan=null;if(status==='ditolak')catatan=prompt('Catatan penolakan (opsional):');toggleDocumentButtons(dokumenId,true);fetch(`/admin/dokumen/${dokumenId}/update-status`,{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken,'Accept':'application/json'},body:JSON.stringify({status:status,catatan:catatan})}).then(response=>response.json()).then(data=>{if(data.success){const badge=document.getElementById(`status-badge-${dokumenId}`);if(badge)badge.innerHTML=data.data.badge;const mobileBadge=document.getElementById(`status-badge-mobile-${dokumenId}`);if(mobileBadge)mobileBadge.innerHTML=data.data.badge;showToast('success',data.message);setTimeout(()=>location.reload(),1500)}else{showToast('error',data.message)}toggleDocumentButtons(dokumenId,false)}).catch(error=>{console.error('Error:',error);showToast('error','Terjadi kesalahan saat memperbarui status');toggleDocumentButtons(dokumenId,false)})}
function bulkUpdateStatus(status){const checkboxes=document.querySelectorAll('.doc-checkbox:checked'),dokumenIds=Array.from(checkboxes).map(cb=>cb.value);if(dokumenIds.length===0){showToast('warning','Pilih minimal satu dokumen');return}const confirmMessages={'diterima':`Terima ${dokumenIds.length} dokumen terpilih?`,'ditolak':`Tolak ${dokumenIds.length} dokumen terpilih?`,'pending':`Reset ${dokumenIds.length} dokumen terpilih?`};if(!confirm(confirmMessages[status]))return;fetch('/admin/dokumen/update-status-batch',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken,'Accept':'application/json'},body:JSON.stringify({dokumen_ids:dokumenIds,status:status})}).then(response=>response.json()).then(data=>{if(data.success){showToast('success',data.message);setTimeout(()=>location.reload(),1000)}else{showToast('error',data.message)}}).catch(error=>{console.error('Error:',error);showToast('error','Terjadi kesalahan saat memperbarui status')})}
function toggleSelectAll(){const selectAll=document.getElementById('selectAll'),checkboxes=document.querySelectorAll('.doc-checkbox');checkboxes.forEach(cb=>{cb.checked=selectAll.checked});updateBulkToolbar()}
function updateBulkToolbar(){const checkboxes=document.querySelectorAll('.doc-checkbox:checked'),toolbar=document.getElementById('bulkActionToolbar'),count=document.getElementById('selectedCount');if(checkboxes.length>0){toolbar.classList.remove('hidden');count.textContent=checkboxes.length}else{toolbar.classList.add('hidden');const selectAll=document.getElementById('selectAll');if(selectAll)selectAll.checked=false}}
function clearSelection(){const selectAll=document.getElementById('selectAll');if(selectAll)selectAll.checked=false;document.querySelectorAll('.doc-checkbox').forEach(cb=>{cb.checked=false});updateBulkToolbar()}
function updateStatus(status){const form=document.querySelector('form[action*="update-status"]'),statusSelect=form.querySelector('select[name="status"]');statusSelect.value=status;let catatan='';switch(status){case'diterima':catatan='Selamat! Pendaftaran Anda diterima. Silakan cek email untuk informasi selanjutnya.';break;case'ditolak':catatan='Mohon maaf, pendaftaran Anda belum dapat diterima pada periode ini.';break;case'diproses':catatan='Pendaftaran Anda sedang dalam proses seleksi. Mohon tunggu pengumuman.';break}form.querySelector('input[name="catatan_admin"]').value=catatan;if(confirm(`Apakah Anda yakin ingin mengubah status menjadi "${status.toUpperCase()}"?`))form.submit()}
function confirmDelete(){if(confirm('⚠️ PERINGATAN!\n\nMenghapus pendaftaran ini akan menghapus semua data dan dokumen terkait.\n\nApakah Anda yakin?'))document.getElementById('deleteForm').submit()}
function toggleDocumentButtons(dokumenId,disabled){const buttons=[`.btn-accept-${dokumenId}`,`.btn-reject-${dokumenId}`,`.btn-reset-${dokumenId}`];buttons.forEach(selector=>{const btns=document.querySelectorAll(selector);btns.forEach(btn=>{if(btn){btn.disabled=disabled;if(disabled){const originalHTML=btn.innerHTML;btn.innerHTML='<i class="fas fa-spinner fa-spin"></i>';btn.dataset.originalHTML=originalHTML}else if(btn.dataset.originalHTML)btn.innerHTML=btn.dataset.originalHTML}})})}
function showToast(type,message){const colors={'success':'from-green-500 to-emerald-500','error':'from-red-500 to-rose-500','warning':'from-yellow-500 to-amber-500'},icons={'success':'check-circle','error':'exclamation-circle','warning':'exclamation-triangle'},toast=document.createElement('div');toast.className=`fixed top-20 right-4 z-50 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-lg shadow-2xl min-w-[300px] max-w-md transform transition-all duration-300 translate-x-full`;toast.innerHTML=`<div class="flex items-start gap-3"><i class="fas fa-${icons[type]} text-xl mt-0.5"></i><div class="flex-1 min-w-0"><p class="font-semibold break-words">${message}</p></div><button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200 ml-2 flex-shrink-0"><i class="fas fa-times"></i></button></div>`;document.body.appendChild(toast);setTimeout(()=>{toast.classList.remove('translate-x-full')},100);setTimeout(()=>{toast.classList.add('translate-x-full');setTimeout(()=>toast.remove(),300)},5000)}
document.addEventListener('DOMContentLoaded',function(){setTimeout(()=>{document.querySelectorAll('[class*="alert"]').forEach(alert=>{alert.style.transition='opacity 0.5s ease';alert.style.opacity='0';setTimeout(()=>alert.remove(),500)})},5000);document.getElementById('previewModal')?.addEventListener('click',function(e){if(e.target===this)closePreviewModal()})});
console.log('✅ Detail Pendaftaran Admin - Optimized Loaded');
</script>
@endpush