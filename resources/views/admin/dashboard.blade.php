{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-6 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                <i class="fas fa-chart-line text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                Dashboard Admin
            </h2>
            <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                Monitor statistik pendaftaran KKN International secara real-time
            </p>
        </div>
    </div>

    {{-- Main Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        {{-- Total Pendaftar --}}
        <div class="group relative bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-blue-100 text-xs font-semibold uppercase tracking-wider mb-2">Total Pendaftar</p>
                        <h3 class="text-5xl font-black text-white mb-1">{{ $totalPendaftar }}</h3>
                        <p class="text-xs text-blue-200">Semua periode</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-users text-white text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pending --}}
        <div class="group relative bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-orange-100 text-xs font-semibold uppercase tracking-wider mb-2">Pending</p>
                        <h3 class="text-5xl font-black text-white mb-1">{{ $pending }}</h3>
                        <p class="text-xs text-orange-200">Menunggu verifikasi</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diproses --}}
        <div class="group relative bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-cyan-100 text-xs font-semibold uppercase tracking-wider mb-2">Diproses</p>
                        <h3 class="text-5xl font-black text-white mb-1">{{ $diproses }}</h3>
                        <p class="text-xs text-cyan-200">Sedang diseleksi</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-sync-alt text-white text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Diterima --}}
        <div class="group relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 cursor-pointer">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="relative p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-green-100 text-xs font-semibold uppercase tracking-wider mb-2">Diterima</p>
                        <h3 class="text-5xl font-black text-white mb-1">{{ $diterima }}</h3>
                        <p class="text-xs text-green-200">Lolos seleksi</p>
                    </div>
                    <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                        <i class="fas fa-check-circle text-white text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Statistik per Negara --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-blue-900">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-globe-asia text-yellow-400 text-xl"></i>
                    Statistik Pendaftar per Negara Tujuan
                </h3>
            </div>
            <div class="p-6">
                @if($statistikNegara->count() > 0)
                    <div class="space-y-4">
                        @foreach($statistikNegara as $negara)
                        <div class="group hover:bg-blue-50 p-3 rounded-lg transition-all duration-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-flag text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h6 class="font-bold text-gray-800">{{ $negara->negara_tujuan }}</h6>
                                        <p class="text-xs text-gray-500">{{ $negara->total }} pendaftar</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl font-black text-blue-900">{{ $negara->total }}</span>
                                    <p class="text-xs text-gray-500">
                                        {{ $totalPendaftar > 0 ? number_format(($negara->total / $totalPendaftar) * 100, 1) : 0 }}%
                                    </p>
                                </div>
                            </div>
                            {{-- Progress Bar --}}
                            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-2.5 rounded-full transition-all duration-500 group-hover:from-blue-600 group-hover:to-cyan-600" 
                                     style="width: {{ $totalPendaftar > 0 ? ($negara->total / $totalPendaftar) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-globe text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada data pendaftaran</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Statistik per Periode --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-purple-600">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-calendar-alt text-yellow-400 text-xl"></i>
                    Per Periode
                </h3>
            </div>
            <div class="p-6">
                @if($statistikPeriode->count() > 0)
                    <div class="space-y-3">
                        @foreach($statistikPeriode as $periode)
                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg border border-purple-100 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <div>
                                    <h6 class="font-bold text-gray-800 text-sm">{{ $periode->periode }}</h6>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xl font-black text-purple-900">{{ $periode->total }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-calendar text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 text-sm">Belum ada data</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Status Breakdown --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-indigo-600">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-chart-pie text-yellow-400 text-xl"></i>
                    Status Pendaftaran
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    {{-- Pending --}}
                    <div class="group hover:bg-orange-50 p-4 rounded-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full"></div>
                                <span class="font-semibold text-gray-700">Pending</span>
                            </div>
                            <span class="text-2xl font-black text-orange-600">{{ $pending }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-2 rounded-full" 
                                 style="width: {{ $totalPendaftar > 0 ? ($pending / $totalPendaftar) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $totalPendaftar > 0 ? number_format(($pending / $totalPendaftar) * 100, 1) : 0 }}% dari total
                        </p>
                    </div>

                    {{-- Diproses --}}
                    <div class="group hover:bg-cyan-50 p-4 rounded-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full"></div>
                                <span class="font-semibold text-gray-700">Diproses</span>
                            </div>
                            <span class="text-2xl font-black text-cyan-600">{{ $diproses }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 h-2 rounded-full" 
                                 style="width: {{ $totalPendaftar > 0 ? ($diproses / $totalPendaftar) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $totalPendaftar > 0 ? number_format(($diproses / $totalPendaftar) * 100, 1) : 0 }}% dari total
                        </p>
                    </div>

                    {{-- Diterima --}}
                    <div class="group hover:bg-green-50 p-4 rounded-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full"></div>
                                <span class="font-semibold text-gray-700">Diterima</span>
                            </div>
                            <span class="text-2xl font-black text-green-600">{{ $diterima }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2 rounded-full" 
                                 style="width: {{ $totalPendaftar > 0 ? ($diterima / $totalPendaftar) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $totalPendaftar > 0 ? number_format(($diterima / $totalPendaftar) * 100, 1) : 0 }}% dari total
                        </p>
                    </div>

                    {{-- Ditolak --}}
                    <div class="group hover:bg-red-50 p-4 rounded-lg transition-all duration-200">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-gradient-to-br from-red-500 to-red-600 rounded-full"></div>
                                <span class="font-semibold text-gray-700">Ditolak</span>
                            </div>
                            <span class="text-2xl font-black text-red-600">{{ $ditolak }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full" 
                                 style="width: {{ $totalPendaftar > 0 ? ($ditolak / $totalPendaftar) * 100 : 0 }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $totalPendaftar > 0 ? number_format(($ditolak / $totalPendaftar) * 100, 1) : 0 }}% dari total
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-emerald-600">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-bolt text-yellow-400 text-xl"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.pendaftaran.index') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg border-2 border-blue-200 hover:border-blue-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-blue-900 text-sm">Lihat Data Pendaftaran</h6>
                            <p class="text-xs text-gray-600">Kelola semua pendaftar</p>
                        </div>
                        <i class="fas fa-chevron-right text-blue-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.export') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border-2 border-green-200 hover:border-green-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-download text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-green-900 text-sm">Export Data</h6>
                            <p class="text-xs text-gray-600">Download laporan Excel</p>
                        </div>
                        <i class="fas fa-chevron-right text-green-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.settings') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg border-2 border-purple-200 hover:border-purple-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-cog text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-purple-900 text-sm">Pengaturan</h6>
                            <p class="text-xs text-gray-600">Konfigurasi sistem</p>
                        </div>
                        <i class="fas fa-chevron-right text-purple-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.destinations') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-orange-50 to-yellow-50 rounded-lg border-2 border-orange-200 hover:border-orange-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-yellow-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-globe text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-orange-900 text-sm">Kelola Destinasi</h6>
                            <p class="text-xs text-gray-600">Atur negara tujuan</p>
                        </div>
                        <i class="fas fa-chevron-right text-orange-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.periods') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-indigo-50 to-blue-50 rounded-lg border-2 border-indigo-200 hover:border-indigo-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calendar-alt text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-indigo-900 text-sm">Kelola Periode</h6>
                            <p class="text-xs text-gray-600">Atur periode KKN</p>
                        </div>
                        <i class="fas fa-chevron-right text-indigo-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('admin.news.index') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-pink-50 to-rose-50 rounded-lg border-2 border-pink-200 hover:border-pink-500 hover:shadow-lg transition-all duration-300 group">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-pink-900 text-sm">Kelola Berita</h6>
                            <p class="text-xs text-gray-600">Tambah & edit berita</p>
                        </div>
                        <i class="fas fa-chevron-right text-pink-500 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Pendaftaran Terbaru --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 border-blue-900">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                <i class="fas fa-clock text-yellow-400 text-xl"></i>
                Pendaftaran Terbaru
            </h3>
        </div>
        <div class="p-6">
            @if($pendaftaranTerbaru->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">NIM</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">Periode</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">Negara</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-blue-900 uppercase">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-blue-900 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pendaftaranTerbaru as $item)
                            @if($item->mahasiswa)
                            <tr class="hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-yellow-50/30 transition-all duration-200">
                                <td class="px-4 py-3 text-xs text-gray-600 whitespace-nowrap">
                                    {{ $item->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-xs font-bold text-blue-900">
                                    {{ $item->mahasiswa->nim ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-xs font-medium text-gray-700">
                                    {{ Str::limit($item->mahasiswa->name ?? 'N/A', 25) }}
                                </td>
                                <td class="px-4 py-3 text-xs text-gray-600 whitespace-nowrap">
                                    {{ $item->periode }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                        {{ $item->negara_tujuan }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->status == 'pending')
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                            ⏳ Pending
                                        </span>
                                    @elseif($item->status == 'diproses')
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                            🔄 Diproses
                                        </span>
                                    @elseif($item->status == 'diterima')
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                            ✅ Diterima
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold shadow-sm whitespace-nowrap">
                                            ❌ Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.pendaftaran.show', $item->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-semibold rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.pendaftaran.index') }}" 
                       class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Lihat Semua Pendaftaran
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-6xl text-gray-200 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada pendaftaran</h3>
                    <p class="text-gray-500">Pendaftaran baru akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Stats card click animation
    document.querySelectorAll('.group.cursor-pointer').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    });
    
    console.log('✅ Dashboard - Enhanced Statistics View');
});
</script>
@endpush