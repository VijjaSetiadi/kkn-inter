@extends('layouts.app')

@section('title', 'Form Pendaftaran KKN International')

@section('content')
<!-- Animated Background Wrapper -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 relative overflow-hidden py-8 px-4">
    <!-- Animated Particles -->
    @for($i = 1; $i <= 8; $i++)
    <span class="absolute w-1.5 h-1.5 bg-gradient-to-br from-blue-900 to-yellow-400 rounded-full opacity-0 animate-float-particle" 
          style="left: {{ $i * 12 }}%; animation-delay: {{ $i * 2 }}s; animation-duration: {{ 18 + $i * 2 }}s;"></span>
    @endfor

    <!-- Floating World Map Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <i class="fas fa-globe text-[350px] text-blue-900 opacity-5 animate-spin-slow"></i>
    </div>

    <!-- Floating Icons -->
    <div class="absolute inset-0 pointer-events-none">
        <i class="fas fa-globe absolute top-[10%] left-[10%] text-4xl text-blue-900 opacity-15 animate-float"></i>
        <i class="fas fa-plane absolute top-[15%] right-[15%] text-3xl text-blue-900 opacity-15 animate-float" style="animation-delay: 1s;"></i>
        <i class="fas fa-university absolute bottom-[20%] left-[8%] text-4xl text-blue-900 opacity-15 animate-float" style="animation-delay: 2s;"></i>
        <i class="fas fa-passport absolute bottom-[15%] right-[12%] text-3xl text-blue-900 opacity-15 animate-float" style="animation-delay: 3s;"></i>
    </div>

    <!-- Main Container -->
    <div class="max-w-6xl mx-auto relative z-10 animate-fade-in-up">
        <!-- Page Header -->
        <div class="mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-900 drop-shadow-lg mb-3">
                <i class="fas fa-file-alt mr-2"></i>Form Pendaftaran KKN International
            </h2>
            <nav class="bg-white/90 backdrop-blur-md rounded-lg px-4 py-2 shadow-md">
                <ol class="flex items-center space-x-2 text-sm text-gray-700">
                    <li><a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-blue-900 font-semibold transition">Dashboard</a></li>
                    <li><i class="fas fa-chevron-right text-xs opacity-50"></i></li>
                    <li class="text-gray-600">Form Pendaftaran</li>
                </ol>
            </nav>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 hover:shadow-3xl transition-all duration-300">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-5 border-b-4 border-yellow-400">
                <h4 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-file-alt mr-3"></i>Form Pendaftaran KKN International
                </h4>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <!-- Student Data Card -->
                <div class="bg-white border-2 border-blue-900 rounded-xl shadow-lg mb-8 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
                        <h5 class="text-lg font-bold text-white flex items-center">
                            <i class="fas fa-user-circle mr-2"></i>Data Mahasiswa
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- NIM -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-id-card text-5xl text-blue-900"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">NIM</p>
                                <h6 class="text-base font-bold text-gray-800">{{ $mahasiswa->nim ?? '-' }}</h6>
                            </div>

                            <!-- Nama -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-user text-5xl text-green-600"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Nama Lengkap</p>
                                <h6 class="text-base font-bold text-gray-800">{{ $mahasiswa->nama ?? $mahasiswa->name ?? '-' }}</h6>
                            </div>

                            <!-- Email -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-envelope text-5xl text-yellow-500"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Email</p>
                                <h6 class="text-sm font-bold text-gray-800 break-all">{{ $mahasiswa->email ?? '-' }}</h6>
                            </div>

                            <!-- Program Studi -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-graduation-cap text-5xl text-cyan-600"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Program Studi</p>
                                <h6 class="text-base font-bold text-gray-800">{{ $mahasiswa->program_studi ?? '-' }}</h6>
                            </div>

                            <!-- Semester -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-calendar-alt text-5xl text-red-600"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">Semester</p>
                                <h6 class="text-base font-bold text-gray-800">{{ $mahasiswa->semester ?? '-' }}</h6>
                            </div>

                            <!-- IPK -->
                            <div class="bg-gray-50 rounded-xl p-5 text-center shadow-sm hover:shadow-md transition-all duration-300 border border-gray-200">
                                <div class="mb-3">
                                    <i class="fas fa-star text-5xl text-gray-600"></i>
                                </div>
                                <p class="text-xs text-gray-500 uppercase font-semibold mb-1">IPK</p>
                                <h6 class="text-base font-bold text-gray-800">{{ $mahasiswa->ipk ?? '-' }}</h6>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                <strong>Penting:</strong> Jika ada data yang perlu diubah, silakan update di 
                                <a href="{{ route('mahasiswa.profile') }}" class="font-bold underline hover:text-yellow-900">halaman profile</a>.
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
                    @csrf
                    
                    <!-- KKN International Data Section -->
                    <h5 class="text-xl font-bold text-blue-900 mb-6 flex items-center">
                        <i class="fas fa-globe mr-2"></i>Data KKN International
                    </h5>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Periode KKN -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Periode KKN <span class="text-red-600">*</span>
                            </label>
                            
                            @if($periods->count() > 0)
                                <select name="periode" 
                                        id="periodeKkn"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('periode') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Periode</option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->name }}" 
                                                data-start="{{ $period->start_date ? $period->start_date->format('d M Y') : '-' }}"
                                                data-end="{{ $period->end_date ? $period->end_date->format('d M Y') : '-' }}"
                                                {{ old('periode') == $period->name ? 'selected' : '' }}>
                                            {{ $period->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('periode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>Pilih periode KKN International
                                </p>
                            @else
                                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4">
                                    <p class="text-sm text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Belum ada periode KKN yang tersedia. Silakan hubungi admin.
                                    </p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Negara Tujuan -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Negara Tujuan <span class="text-red-600">*</span>
                            </label>
                            
                            @if($destinations->count() > 0)
                                <select name="negara_tujuan" 
                                        id="negaraTujuan"
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('negara_tujuan') border-red-500 @enderror" 
                                        required>
                                    <option value="">Pilih Negara Tujuan</option>
                                    @foreach($destinations->unique('country') as $destination)
                                        <option value="{{ $destination->country }}" 
                                                data-description="{{ $destination->description }}"
                                                {{ old('negara_tujuan') == $destination->country ? 'selected' : '' }}>
                                            {{ $destination->country }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('negara_tujuan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    <i class="fas fa-globe-asia mr-1"></i>Pilih negara tujuan KKN International
                                </p>
                            @else
                                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4">
                                    <p class="text-sm text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Belum ada tujuan KKN yang tersedia. Silakan hubungi admin.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Period Info -->
                    <div id="periodInfoContainer" class="hidden mb-6">
                        <div class="bg-green-50 border-l-4 border-green-500 rounded-r-lg p-4">
                            <h6 class="font-bold text-green-800 mb-2 flex items-center">
                                <i class="fas fa-calendar-check mr-2"></i>Periode yang Dipilih
                            </h6>
                            <p class="text-sm text-green-700">
                                <strong>Tanggal:</strong> <span id="periodDateRange"></span>
                            </p>
                        </div>
                    </div>

                    <!-- Country Description -->
                    <div id="countryDescriptionContainer" class="hidden mb-6">
                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-4">
                            <h6 class="font-bold text-blue-800 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>Informasi Negara Tujuan
                            </h6>
                            <p class="text-sm text-blue-700" id="countryDescriptionText"></p>
                        </div>
                    </div>

                    <!-- Motivasi -->
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Motivasi Mengikuti KKN International <span class="text-red-600">*</span>
                        </label>
                        <textarea name="motivasi" 
                                  id="motivasiTextarea"
                                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('motivasi') border-red-500 @enderror" 
                                  rows="6" 
                                  required 
                                  placeholder="Tuliskan motivasi Anda minimal 100 karakter. Jelaskan mengapa Anda tertarik mengikuti KKN International, apa yang ingin Anda capai, dan bagaimana program ini akan membantu pengembangan diri Anda.">{{ old('motivasi') }}</textarea>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-sm text-gray-500">Minimal 100 karakter</p>
                            <p class="text-sm text-gray-500" id="charCount">0 / 100 karakter</p>
                        </div>
                        @error('motivasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-8 border-gray-300">

                    <!-- Upload Documents Section -->
                    <h5 class="text-xl font-bold text-blue-900 mb-6 flex items-center">
                        <i class="fas fa-file-upload mr-2"></i>Upload Dokumen Persyaratan
                    </h5>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-4 mb-6">
                        <p class="text-sm text-blue-800">
                            <i class="fas fa-info-circle mr-2"></i><strong>Informasi:</strong> 
                            Semua dokumen di bawah ini <strong>wajib</strong> diupload. Format: PDF, JPG, PNG. Maksimal 5MB per file.
                        </p>
                    </div>
                    
                    <div id="dokumenContainer" class="space-y-6">
                        <!-- Row 1: KTP & KHS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    1. KTP <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="ktp">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.0') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Kartu Tanda Penduduk (KTP)</p>
                                @error('dokumen.0')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    2. KHS Terakhir <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="khs">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.1') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Kartu Hasil Studi Terakhir</p>
                                @error('dokumen.1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row 2: Transkrip & Sertifikat Bahasa -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    3. Transkrip Nilai <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="transkrip">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.2') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Transkrip Nilai Lengkap</p>
                                @error('dokumen.2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    4. Sertifikat Bahasa <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="sertifikat_bahasa">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.3') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">TOEFL/IELTS (Min. Score 450)</p>
                                @error('dokumen.3')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row 3: Passport & Surat Rekomendasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    5. Passport <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="passport">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.4') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Passport yang masih berlaku</p>
                                @error('dokumen.4')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    6. Surat Rekomendasi Dosen <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="surat_rekomendasi">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.5') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Surat dari Dosen Pembimbing Akademik</p>
                                @error('dokumen.5')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row 4: Surat Izin Ortu & Pas Foto -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    7. Surat Izin Orang Tua <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="surat_izin_ortu">
                                <input type="file" 
                                       name="dokumen[]" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.6') border-red-500 @enderror" 
                                       required 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Surat Persetujuan Orang Tua/Wali</p>
                                @error('dokumen.6')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    8. Bukti Pembayaran <span class="text-red-600">*</span>
                                </label>
                                <input type="hidden" name="jenis_dokumen[]" value="bukti_pembayaran">
                                <input type="file" 
                                    name="dokumen[]" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-900 focus:border-blue-900 transition @error('dokumen.7') border-red-500 @enderror" 
                                    required 
                                    accept=".pdf,.jpg,.jpeg,.png">
                                <p class="mt-2 text-sm text-gray-500">Bukti Transfer/Pembayaran Biaya KKN</p>
                                @error('dokumen.7')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg p-4 mt-6">
                        <p class="text-sm font-bold text-yellow-800 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Perhatian:
                        </p>
                        <ul class="list-disc list-inside text-sm text-yellow-800 space-y-1">
                            <li>Pastikan semua dokumen sudah lengkap dan jelas terbaca</li>
                            <li>Format file: PDF, JPG, atau PNG</li>
                            <li>Ukuran maksimal per file: 5MB</li>
                            <li>Dokumen yang tidak lengkap akan ditolak</li>
                        </ul>
                    </div>

                    <hr class="my-8 border-gray-300">

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <button type="submit" class="px-8 py-4 bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold rounded-lg hover:from-blue-800 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pendaftaran
                        </button>
                        <a href="{{ route('mahasiswa.dashboard') }}" class="px-8 py-4 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes float-particle {
        0% { transform: translateY(100vh) translateX(0) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100vh) translateX(100px) rotate(360deg); opacity: 0; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        25% { transform: translateY(-10px) rotate(5deg) scale(1.03); }
        50% { transform: translateY(-5px) rotate(0deg) scale(1); }
        75% { transform: translateY(-12px) rotate(-5deg) scale(1.03); }
    }
    
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-float-particle {
        animation: float-particle 20s linear infinite;
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-spin-slow {
        animation: spin 60s linear infinite;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character Counter for Motivasi
        const motivasiTextarea = document.getElementById('motivasiTextarea');
        const charCount = document.getElementById('charCount');
        
        if (motivasiTextarea && charCount) {
            motivasiTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length + ' / 100 karakter';
                
                if (length >= 100) {
                    charCount.classList.remove('text-red-600');
                    charCount.classList.add('text-green-600');
                } else {
                    charCount.classList.remove('text-green-600');
                    charCount.classList.add('text-red-600');
                }
            });
            
            motivasiTextarea.dispatchEvent(new Event('input'));
        }

        // Show Period Info
        const periodeSelect = document.getElementById('periodeKkn');
        const periodInfo = document.getElementById('periodInfoContainer');
        const periodDateRange = document.getElementById('periodDateRange');
        
        if (periodeSelect && periodInfo && periodDateRange) {
            periodeSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const startDate = selectedOption.getAttribute('data-start');
                const endDate = selectedOption.getAttribute('data-end');
                
                if (startDate && endDate && startDate !== '-' && endDate !== '-') {
                    periodDateRange.textContent = startDate + ' s/d ' + endDate;
                    periodInfo.classList.remove('hidden');
                } else {
                    periodInfo.classList.add('hidden');
                }
            });
            
            if (periodeSelect.value) {
                periodeSelect.dispatchEvent(new Event('change'));
            }
        }

        // Show Country Description
        const negaraSelect = document.getElementById('negaraTujuan');
        const descriptionContainer = document.getElementById('countryDescriptionContainer');
        const descriptionText = document.getElementById('countryDescriptionText');
        
        if (negaraSelect && descriptionContainer && descriptionText) {
            negaraSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const description = selectedOption.getAttribute('data-description');
                
                if (description && description !== 'null' && description.trim() !== '') {
                    descriptionText.textContent = description;
                    descriptionContainer.classList.remove('hidden');
                } else {
                    descriptionContainer.classList.add('hidden');
                }
            });
            
            if (negaraSelect.value) {
                negaraSelect.dispatchEvent(new Event('change'));
            }
        }
    });

    // Form Validation
    document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
        // Validate Motivasi
        const motivasi = document.querySelector('textarea[name="motivasi"]').value;
        if (motivasi.length < 100) {
            e.preventDefault();
            alert('❌ Motivasi harus minimal 100 karakter!\n\nSaat ini: ' + motivasi.length + ' karakter');
            document.getElementById('motivasiTextarea').focus();
            return false;
        }
        
        // Validate Periode
        const periode = document.getElementById('periodeKkn');
        if (periode && !periode.value) {
            e.preventDefault();
            alert('❌ Silakan pilih periode KKN!');
            periode.focus();
            return false;
        }
        
        // Validate Negara
        const negara = document.getElementById('negaraTujuan');
        if (negara && !negara.value) {
            e.preventDefault();
            alert('❌ Silakan pilih negara tujuan!');
            negara.focus();
            return false;
        }

        // Validate All Documents
        const dokumenInputs = document.querySelectorAll('input[type="file"][name="dokumen[]"]');
        let allUploaded = true;
        let missingDocs = [];

        dokumenInputs.forEach((input, index) => {
            if (!input.files || input.files.length === 0) {
                allUploaded = false;
                const label = input.closest('div').querySelector('label').textContent.replace('*', '').trim();
                missingDocs.push(label);
            }
        });

        if (!allUploaded) {
            e.preventDefault();
            alert('❌ Dokumen berikut belum diupload:\n\n' + missingDocs.join('\n') + '\n\nSilakan upload semua dokumen yang diperlukan!');
            return false;
        }

        // Validate File Size
        let oversizeFiles = [];
        dokumenInputs.forEach((input, index) => {
            if (input.files && input.files.length > 0) {
                const file = input.files[0];
                const maxSize = 5 * 1024 * 1024;
                
                if (file.size > maxSize) {
                    const label = input.closest('div').querySelector('label').textContent.replace('*', '').trim();
                    oversizeFiles.push(label + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)');
                }
            }
        });

        if (oversizeFiles.length > 0) {
            e.preventDefault();
            alert('❌ Dokumen berikut melebihi ukuran maksimal 5MB:\n\n' + oversizeFiles.join('\n') + '\n\nSilakan compress atau gunakan file yang lebih kecil!');
            return false;
        }

        // Confirmation
        const confirmed = confirm('✅ Apakah Anda yakin semua data dan dokumen sudah benar?\n\nSetelah dikirim, Anda tidak dapat mengubah data pendaftaran.');
        if (!confirmed) {
            e.preventDefault();
            return false;
        }

        // Show loading
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
    });
</script>
@endpush
@endsection