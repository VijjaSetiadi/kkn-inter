@extends('layouts.admin')

@section('title', 'Kelola Tujuan KKN')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                    <i class="fas fa-globe text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                    Kelola Tujuan KKN
                </h2>
                <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                    Manage negara tujuan KKN International
                </p>
            </div>
            <a href="{{ route('admin.destinations.create') }}" 
               class="px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-plus"></i>
                Tambah Tujuan
            </a>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900">
        @if($destinations->count() > 0)
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Negara</th>
                            <th class="px-4 py-4 text-left text-xs font-bold text-blue-900 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-4 py-4 text-center text-xs font-bold text-blue-900 uppercase tracking-wider w-24">Status</th>
                            <th class="px-4 py-4 text-center text-xs font-bold text-blue-900 uppercase tracking-wider w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($destinations as $index => $item)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                            <td class="px-4 py-4 text-sm font-semibold text-gray-700">
                                {{ $destinations->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-sm font-bold shadow-sm">
                                    <i class="fas fa-flag mr-2"></i>
                                    {{ $item->country }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <p class="text-sm text-gray-600 font-medium">
                                    {{ Str::limit($item->description, 100) }}
                                </p>
                            </td>
                            <td class="px-4 py-4 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-semibold shadow-sm uppercase tracking-wide">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-md bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold shadow-sm uppercase tracking-wide">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('admin.destinations.edit', $item->id) }}" 
                                       class="px-3 py-2 bg-gradient-to-r from-yellow-500 to-yellow-400 text-white text-xs font-semibold rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-1">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('⚠️ Yakin ingin menghapus tujuan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-semibold rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-1">
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Footer --}}
            <div class="bg-gray-50 px-6 py-4 border-t-2 border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600 font-medium">
                        Menampilkan {{ $destinations->firstItem() }} - {{ $destinations->lastItem() }} 
                        dari {{ $destinations->total() }} data
                    </div>
                    <div>
                        {{ $destinations->links() }}
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-16 px-4">
                <i class="fas fa-globe text-6xl text-gray-300 mb-4"></i>
                <h5 class="text-xl font-semibold text-gray-600 mb-2">Belum ada tujuan KKN</h5>
                <p class="text-gray-400 mb-6">Tambahkan negara tujuan KKN International</p>
                <a href="{{ route('admin.destinations.create') }}" 
                   class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 gap-2">
                    <i class="fas fa-plus"></i>
                    Tambah Tujuan
                </a>
            </div>
        @endif
    </div>
</div>
@endsection