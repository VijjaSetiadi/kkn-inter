@extends('layouts.admin')

@section('title', 'Tambah Tujuan KKN')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                    <i class="fas fa-plus-circle text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                    Tambah Tujuan KKN
                </h2>
            </div>
            <a href="{{ route('admin.destinations') }}" 
               class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden border-t-4 border-blue-900">
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
                <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                    <i class="fas fa-edit text-yellow-400 text-xl drop-shadow"></i>
                    Form Tambah Tujuan
                </h5>
            </div>
            
            <div class="p-6 bg-gray-50">
                <form action="{{ route('admin.destinations.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Negara <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="country" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium @error('country') border-red-500 @enderror" 
                               value="{{ old('country') }}"
                               placeholder="Contoh: Malaysia"
                               required>
                        @error('country')
                            <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="description" 
                                  class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium resize-none @error('description') border-red-500 @enderror" 
                                  rows="4"
                                  placeholder="Deskripsi tentang negara tujuan...">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-red-500 font-medium mt-1 block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center gap-4">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       id="isActive"
                                       class="sr-only peer"
                                       checked>
                                <div class="w-14 h-7 bg-red-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500 shadow-md"></div>
                            </label>
                            <div>
                                <label class="text-sm font-bold text-blue-900 cursor-pointer" for="isActive">
                                    Status Aktif
                                </label>
                                <small class="block text-gray-600 font-medium">
                                    Tujuan ini akan muncul di form pendaftaran
                                </small>
                            </div>
                        </div>
                    </div>

                    <hr class="border-t-2 border-gray-200 my-6">

                    <div class="flex gap-3 justify-end flex-wrap">
                        <a href="{{ route('admin.destinations') }}" 
                           class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection