{{-- resources/views/admin/export.blade.php --}}
@extends('layouts.admin')

@section('title', 'Export Data KKN')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-6xl">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                <i class="fas fa-file-download text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                Export Data Pendaftaran KKN
            </h2>
            <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                Download data dalam format Excel, PDF, atau CSV
            </p>
        </div>
    </div>

    <form action="{{ route('admin.export.process') }}" method="POST">
        @csrf
        
        {{-- Filter Section --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900 mb-5">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
                <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-filter text-yellow-400 text-xl drop-shadow"></i>
                    Filter Data
                </h5>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Status</label>
                        <select name="filter_status" 
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="diproses">Diproses</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Periode</label>
                        <select name="filter_period" 
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                            <option value="">Semua Periode</option>
                            @foreach($periods as $period)
                                <option value="{{ $period }}">{{ $period }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Negara Tujuan</label>
                        <select name="filter_destination" 
                                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                            <option value="">Semua Negara</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination }}">{{ $destination }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Tanggal Dari</label>
                        <input type="date" 
                               name="filter_date_from" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">Tanggal Sampai</label>
                        <input type="date" 
                               name="filter_date_to" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium">
                    </div>
                </div>
            </div>
        </div>

        {{-- Column Selection --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900 mb-5">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
                <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-columns text-yellow-400 text-xl drop-shadow"></i>
                    Pilih Kolom
                </h5>
            </div>
            
            <div class="p-6 bg-gray-50">
                {{-- Control Buttons --}}
                <div class="flex flex-wrap gap-3 mb-5">
                    <button type="button" 
                            id="selectAll"
                            class="px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-500 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 text-sm">
                        <i class="fas fa-check-square"></i>
                        Pilih Semua
                    </button>
                    <button type="button" 
                            id="deselectAll"
                            class="px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 text-sm">
                        <i class="fas fa-square"></i>
                        Tidak Pilih Semua
                    </button>
                </div>
                
                {{-- Checkbox Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="no"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">No</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="nim"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">NIM</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="nama"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Nama</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="email"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Email</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="no_telepon"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">No. Telepon</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="program_studi"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Program Studi</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="fakultas"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Fakultas</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="semester"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Semester</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="ipk"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">IPK</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="periode"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Periode</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="negara_tujuan"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Negara Tujuan</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="motivasi"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Motivasi</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="status"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Status</span>
                    </label>
                    
                    <label class="flex items-center gap-3 p-3 border-2 border-gray-200 rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition-all duration-200">
                        <input type="checkbox" 
                               name="columns[]" 
                               value="tanggal_daftar"
                               class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Tanggal Daftar</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Format Selection --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900 mb-5">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
                <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-file-alt text-yellow-400 text-xl drop-shadow"></i>
                    Format Export
                </h5>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Excel Option --}}
                    <div class="relative">
                        <input type="radio" 
                               name="export_format" 
                               id="format_excel" 
                               value="excel" 
                               class="peer sr-only" 
                               checked>
                        <label for="format_excel" 
                               class="flex flex-col items-center justify-center p-6 bg-white border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-green-50 hover:border-green-500 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-200">
                            <i class="fas fa-file-excel text-5xl text-green-500 mb-3"></i>
                            <span class="text-base font-bold text-gray-700">Excel (.xlsx)</span>
                        </label>
                    </div>
                    
                    {{-- PDF Option --}}
                    <div class="relative">
                        <input type="radio" 
                               name="export_format" 
                               id="format_pdf" 
                               value="pdf" 
                               class="peer sr-only">
                        <label for="format_pdf" 
                               class="flex flex-col items-center justify-center p-6 bg-white border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 hover:border-red-500 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-200">
                            <i class="fas fa-file-pdf text-5xl text-red-500 mb-3"></i>
                            <span class="text-base font-bold text-gray-700">PDF</span>
                        </label>
                    </div>
                    
                    {{-- CSV Option --}}
                    <div class="relative">
                        <input type="radio" 
                               name="export_format" 
                               id="format_csv" 
                               value="csv" 
                               class="peer sr-only">
                        <label for="format_csv" 
                               class="flex flex-col items-center justify-center p-6 bg-white border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all duration-200">
                            <i class="fas fa-file-csv text-5xl text-blue-500 mb-3"></i>
                            <span class="text-base font-bold text-gray-700">CSV</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <button type="submit" 
                class="w-full px-6 py-4 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-bold text-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-3">
            <i class="fas fa-download text-xl"></i>
            Export Data
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pilih Semua
    document.getElementById('selectAll').addEventListener('click', function() {
        document.querySelectorAll('input[name="columns[]"]').forEach(checkbox => {
            checkbox.checked = true;
        });
    });

    // Tidak Pilih Semua
    document.getElementById('deselectAll').addEventListener('click', function() {
        document.querySelectorAll('input[name="columns[]"]').forEach(checkbox => {
            checkbox.checked = false;
        });
    });

    // Validasi minimal 1 kolom dipilih
    document.querySelector('form').addEventListener('submit', function(e) {
        const checked = document.querySelectorAll('input[name="columns[]"]:checked');
        if (checked.length === 0) {
            e.preventDefault();
            alert('⚠️ Pilih minimal 1 kolom untuk di-export!');
        }
    });
});

console.log('✅ Admin Export Page - Tailwind CSS Version Loaded Successfully');
</script>
@endpush