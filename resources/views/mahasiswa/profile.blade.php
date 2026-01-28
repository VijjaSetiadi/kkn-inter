@extends('layouts.app')

@section('title', 'Profile Mahasiswa')

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

    /* Profile Image Hover Effect */
    .profile-image-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-image-wrapper:hover .overlay {
        opacity: 1;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }

    /* Input Focus Animation */
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    <div class="main-container max-w-6xl mx-auto">
        <!-- Page Header -->
        <div class="mb-4 flex items-center justify-between flex-wrap gap-3">
            <h2 class="text-blue-900 text-lg md:text-2xl font-bold bg-white/90 backdrop-blur-sm rounded-lg px-4 py-3 border-l-4 border-yellow-500 shadow-md">
                <i class="fas fa-user mr-2"></i> Profile Mahasiswa
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

        @if($errors->any())
        <div class="alert-notification bg-red-50 border-l-4 border-red-500 rounded-lg p-3 mb-3 shadow-md">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle text-red-600 text-lg mr-2"></i>
                        <span class="text-red-800 font-bold text-sm">Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside text-red-700 text-xs space-y-1 ml-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-800 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- Card Foto Profile & Info -->
        <div class="mobile-card">
            <div class="mobile-card-header">
                <i class="fas fa-id-card mr-2"></i> Informasi Profile
            </div>
            <div class="mobile-card-body">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Foto Profile -->
                    <div class="flex-shrink-0">
                        <div class="profile-image-wrapper">
                            @if(Auth::user()->foto_profil)
                                <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}" 
                                     alt="Foto Profil" 
                                     id="preview-foto"
                                     class="rounded-full shadow-lg" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #1e40af;">
                            @else
                                <img src="" 
                                     alt="Foto Profil" 
                                     id="preview-foto"
                                     class="rounded-full shadow-lg hidden" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #1e40af;">
                                <div id="default-avatar" 
                                     class="inline-flex items-center justify-center rounded-full shadow-lg text-white"
                                     style="width: 150px; height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-user text-6xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Info Profile -->
                    <div class="flex-1 text-center md:text-left">
                        <h5 class="text-gray-800 font-bold text-2xl mb-2">{{ Auth::user()->name }}</h5>
                        <div class="space-y-2 mb-4">
                            <p class="text-gray-600 text-sm flex items-center justify-center md:justify-start">
                                <i class="fas fa-id-badge w-5 mr-2 text-blue-600"></i>
                                <span class="font-semibold">{{ Auth::user()->nim }}</span>
                            </p>
                            <p class="text-gray-600 text-sm flex items-center justify-center md:justify-start">
                                <i class="fas fa-envelope w-5 mr-2 text-blue-600"></i>
                                {{ Auth::user()->email }}
                            </p>
                            <p class="text-gray-600 text-sm flex items-center justify-center md:justify-start">
                                <i class="fas fa-graduation-cap w-5 mr-2 text-blue-600"></i>
                                {{ Auth::user()->program_studi ?? '-' }}
                            </p>
                            <p class="text-gray-600 text-sm flex items-center justify-center md:justify-start">
                                <i class="fas fa-university w-5 mr-2 text-blue-600"></i>
                                {{ Auth::user()->fakultas ?? '-' }}
                            </p>
                        </div>
                        
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="bg-blue-50 rounded-lg p-3 text-center">
                                <h6 class="text-blue-600 font-bold text-lg mb-1">{{ Auth::user()->semester ?? '-' }}</h6>
                                <small class="text-gray-600 text-xs">Semester</small>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3 text-center">
                                <h6 class="text-green-600 font-bold text-lg mb-1">{{ Auth::user()->ipk ? number_format(Auth::user()->ipk, 2) : '-' }}</h6>
                                <small class="text-gray-600 text-xs">IPK</small>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-3 text-center">
                                <h6 class="text-purple-600 font-bold text-lg mb-1">{{ Auth::user()->angkatan ?? '-' }}</h6>
                                <small class="text-gray-600 text-xs">Angkatan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit Profile -->
        <div>
            <div class="mobile-card">
                <div class="mobile-card-header">
                    <i class="fas fa-user-edit mr-2"></i> Edit Profile
                </div>
                <div class="mobile-card-body">
                    <form action="{{ route('mahasiswa.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Upload Foto -->
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-gray-700 mb-2">
                                <i class="fas fa-camera mr-1"></i> Update Foto Profil
                            </label>
                            <input type="file" 
                                   name="foto_profil" 
                                   id="foto_profil"
                                   class="block w-full text-xs text-gray-700 border-2 border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('foto_profil') border-red-500 @enderror" 
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="block text-gray-500 text-xs mt-1">
                                <i class="fas fa-info-circle mr-1"></i> Format: JPG, PNG. Maksimal 2MB
                            </small>
                            @error('foto_profil')
                                <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Data Pribadi -->
                        <h6 class="text-blue-900 font-bold text-sm mb-3 flex items-center">
                            <i class="fas fa-user mr-2"></i> Data Pribadi
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('name') border-red-500 @enderror" 
                                       value="{{ old('name', Auth::user()->name) }}" 
                                       required>
                                @error('name')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    NIM <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       class="block w-full text-sm text-gray-400 border-2 border-gray-200 rounded-lg p-2.5 bg-gray-100 cursor-not-allowed" 
                                       value="{{ Auth::user()->nim }}" 
                                       readonly disabled>
                                <small class="text-gray-500 text-xs">NIM tidak dapat diubah</small>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       class="block w-full text-sm text-gray-400 border-2 border-gray-200 rounded-lg p-2.5 bg-gray-100 cursor-not-allowed" 
                                       value="{{ Auth::user()->email }}" 
                                       readonly disabled>
                                <small class="text-gray-500 text-xs">Email tidak dapat diubah</small>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    No. Telepon/WA <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="no_telepon" 
                                       class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('no_telepon') border-red-500 @enderror" 
                                       value="{{ old('no_telepon', Auth::user()->no_telepon ?? Auth::user()->phone) }}" 
                                       required>
                                @error('no_telepon')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Data Akademik -->
                        <h6 class="text-blue-900 font-bold text-sm mb-3 flex items-center">
                            <i class="fas fa-graduation-cap mr-2"></i> Data Akademik
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Fakultas <span class="text-red-500">*</span>
                                </label>
                                <select id="fakultas" 
                                        name="fakultas" 
                                        class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('fakultas') border-red-500 @enderror" 
                                        required>
                                    <option value="">-- Pilih Fakultas --</option>
                                    <option value="Ekonomi dan Bisnis" {{ old('fakultas', Auth::user()->fakultas) == 'Ekonomi dan Bisnis' ? 'selected' : '' }}>Ekonomi dan Bisnis</option>
                                    <option value="Teknik" {{ old('fakultas', Auth::user()->fakultas) == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                                    <option value="Teknologi Informasi dan Komunikasi" {{ old('fakultas', Auth::user()->fakultas) == 'Teknologi Informasi dan Komunikasi' ? 'selected' : '' }}>Teknologi Informasi dan Komunikasi</option>
                                    <option value="Psikologi" {{ old('fakultas', Auth::user()->fakultas) == 'Psikologi' ? 'selected' : '' }}>Psikologi</option>
                                    <option value="Teknologi Pertanian" {{ old('fakultas', Auth::user()->fakultas) == 'Teknologi Pertanian' ? 'selected' : '' }}>Teknologi Pertanian</option>
                                    <option value="Hukum" {{ old('fakultas', Auth::user()->fakultas) == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                                </select>
                                @error('fakultas')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Program Studi <span class="text-red-500">*</span>
                                </label>
                                <select id="program_studi" 
                                        name="program_studi" 
                                        class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('program_studi') border-red-500 @enderror" 
                                        required>
                                    <option value="">-- Pilih Fakultas Terlebih Dahulu --</option>
                                </select>
                                @error('program_studi')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Semester <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="semester" 
                                       class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('semester') border-red-500 @enderror" 
                                       value="{{ old('semester', Auth::user()->semester) }}" 
                                       min="1" 
                                       max="14" 
                                       required>
                                @error('semester')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    IPK <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="ipk" 
                                       class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('ipk') border-red-500 @enderror" 
                                       value="{{ old('ipk', Auth::user()->ipk) }}" 
                                       step="0.01" 
                                       min="0" 
                                       max="4" 
                                       required>
                                @error('ipk')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">
                                    Angkatan <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="angkatan" 
                                       class="block w-full text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-2.5 transition-all @error('angkatan') border-red-500 @enderror" 
                                       value="{{ old('angkatan', Auth::user()->angkatan) }}" 
                                       min="2000" 
                                       max="{{ date('Y') + 1 }}" 
                                       required>
                                @error('angkatan')
                                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <!-- Button Actions -->
                        <div class="flex flex-col md:flex-row justify-between items-center gap-3">
                            <a href="{{ route('mahasiswa.dashboard') }}" 
                               class="w-full md:w-auto inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                                <a href="{{ route('mahasiswa.profile.password') }}" 
                                   class="w-full md:w-auto inline-flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                                    <i class="fas fa-key mr-2"></i> Ganti Password
                                </a>
                                <button type="submit" 
                                        class="w-full md:w-auto inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data Program Studi berdasarkan Fakultas - SAMA DENGAN COMPLETE.BLADE.PHP
    const prodiData = {
        "Ekonomi dan Bisnis": [
            "S1 Akuntansi",
            "S1 Manajemen",
            "D3 Manajemen Perusahaan"
        ],
        "Teknik": [
            "S1 Teknik Sipil",
            "S1 Teknik Elektro",
            "S1 Perencanaan Wilayah dan Kota (PWK)"
        ],
        "Teknologi Informasi dan Komunikasi": [
            "S1 Teknik Informatika",
            "S1 Sistem Informasi",
            "S1 Ilmu Komunikasi",
            "S1 Pariwisata"
        ],
        "Psikologi": [
            "S1 Psikologi"
        ],
        "Teknologi Pertanian": [
            "S1 Teknologi Hasil Pertanian"
        ],
        "Hukum": [
            "S1 Ilmu Hukum"
        ]
    };

    const fakultasSelect = document.getElementById('fakultas');
    const prodiSelect = document.getElementById('program_studi');
    
    // Simpan nilai prodi yang sudah ada (untuk edit)
    const oldProdi = "{{ old('program_studi', Auth::user()->program_studi ?? '') }}";

    // Function untuk update dropdown prodi
    function updateProdiOptions(fakultasValue, selectedProdi = '') {
        prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
        
        if (fakultasValue && prodiData[fakultasValue]) {
            prodiData[fakultasValue].forEach(prodi => {
                const option = document.createElement('option');
                option.value = prodi;
                option.textContent = prodi;
                if (prodi === selectedProdi) {
                    option.selected = true;
                }
                prodiSelect.appendChild(option);
            });
            prodiSelect.disabled = false;
        } else {
            prodiSelect.innerHTML = '<option value="">-- Pilih Fakultas Terlebih Dahulu --</option>';
            prodiSelect.disabled = true;
        }
    }

    // Event listener untuk perubahan fakultas
    fakultasSelect.addEventListener('change', function() {
        updateProdiOptions(this.value);
    });

    // Inisialisasi saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        const currentFakultas = fakultasSelect.value;
        
        if (currentFakultas) {
            updateProdiOptions(currentFakultas, oldProdi);
        }
    });

    // Preview foto sebelum upload
    document.getElementById('foto_profil')?.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            const previewImg = document.getElementById('preview-foto');
            const defaultAvatar = document.getElementById('default-avatar');
            
            reader.onload = function(event) {
                // Tampilkan preview image
                previewImg.src = event.target.result;
                previewImg.classList.remove('hidden');
                
                // Sembunyikan default avatar jika ada
                if (defaultAvatar) {
                    defaultAvatar.classList.add('hidden');
                }
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-notification');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endpush