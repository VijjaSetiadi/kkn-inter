@extends('layouts.app')

@section('title', 'Lengkapi Profile')

@section('content')
<div class="relative min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 py-12 px-4">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Rotating Globe -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[500px] text-blue-900/5 animate-spin-slow">
            <i class="fas fa-globe"></i>
        </div>
        
        <!-- Floating Icons -->
        <div class="absolute top-[10%] left-[10%] text-6xl text-blue-900/20 animate-float-1">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="absolute top-[15%] right-[15%] text-5xl text-blue-900/20 animate-float-2">
            <i class="fas fa-university"></i>
        </div>
        <div class="absolute bottom-[20%] left-[8%] text-6xl text-blue-900/20 animate-float-3">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="absolute bottom-[15%] right-[12%] text-5xl text-blue-900/20 animate-float-4">
            <i class="fas fa-book"></i>
        </div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 max-w-4xl mx-auto animate-fade-in-up">
        <!-- Progress Steps -->
        <div class="bg-white rounded-lg shadow-lg p-5 mb-5">
            <div class="flex items-center justify-between">
                <!-- Step 1 - Completed -->
                <div class="flex items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="ml-2 hidden sm:block">
                        <div class="text-xs font-bold text-green-600">Buat Akun</div>
                        <div class="text-[10px] text-gray-500">Selesai ✓</div>
                    </div>
                </div>

                <div class="h-0.5 flex-1 bg-green-500 mx-2"></div>

                <!-- Step 2 - Completed -->
                <div class="flex items-center flex-1 justify-center">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="ml-2 hidden sm:block">
                        <div class="text-xs font-bold text-green-600">Verifikasi</div>
                        <div class="text-[10px] text-gray-500">Selesai ✓</div>
                    </div>
                </div>

                <div class="h-0.5 flex-1 bg-blue-900 mx-2"></div>

                <!-- Step 3 - Active -->
                <div class="flex items-center flex-1 justify-end">
                    <div class="w-10 h-10 rounded-full bg-blue-900 text-white flex items-center justify-center font-bold shadow-lg">
                        3
                    </div>
                    <div class="ml-2 hidden sm:block">
                        <div class="text-xs font-bold text-blue-900">Profil</div>
                        <div class="text-[10px] text-gray-500">Sedang Aktif</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Validation Errors -->
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-5 shadow-lg">
            <div class="flex items-start gap-3">
                <i class="fas fa-exclamation-triangle text-red-600 text-lg mt-0.5"></i>
                <div class="flex-1">
                    <div class="font-bold text-sm text-red-900 mb-2">Terjadi Kesalahan!</div>
                    <ul class="list-disc list-inside text-xs text-red-800 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-lg shadow-2xl overflow-hidden mb-5 animate-float">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 border-b-4 border-yellow-500 py-6 px-6 text-center">
                <h5 class="text-lg font-bold text-white m-0">
                    <i class="fas fa-user-edit mr-2"></i>Lengkapi Data Profile
                </h5>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">
                <form action="{{ route('profile.complete.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Data Pribadi Section -->
                    <div class="mb-8">
                        <div class="flex items-center mb-5 pb-3 border-b-2 border-gray-200">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-user text-blue-900 text-xl"></i>
                            </div>
                            <div>
                                <h6 class="text-base font-bold text-blue-900 m-0">Data Pribadi</h6>
                                <small class="text-xs text-gray-600">Informasi identitas diri</small>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="name" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('name') border-red-500 @enderror" 
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- NIM -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    NIM <span class="text-red-600">*</span>
                                </label>
                                @if($user->nim)
                                    <input type="text" 
                                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                                           value="{{ $user->nim }}" readonly>
                                    <input type="hidden" name="nim" value="{{ $user->nim }}">
                                    <small class="block mt-1 text-xs text-gray-600">
                                        <i class="fas fa-lock mr-1"></i> NIM tidak dapat diubah
                                    </small>
                                @else
                                    <input type="text" name="nim" 
                                           class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('nim') border-red-500 @enderror" 
                                           value="{{ old('nim') }}" 
                                           placeholder="Contoh: G.211.22.0091" 
                                           required>
                                    <small class="block mt-1 text-xs text-yellow-600">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> NIM belum terisi
                                    </small>
                                    @error('nim')
                                        <div class="mt-2 text-xs text-red-600 font-medium">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email
                                </label>
                                <div class="flex">
                                    <input type="email" 
                                           class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-l-lg bg-gray-100 cursor-not-allowed" 
                                           value="{{ $user->email }}" readonly>
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    @if($user->email_verified_at)
                                        <span class="px-4 py-3 bg-green-500 text-white text-xs font-semibold rounded-r-lg border-2 border-green-500 flex items-center">
                                            <i class="fas fa-check-circle mr-1"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-4 py-3 bg-yellow-500 text-white text-xs font-semibold rounded-r-lg border-2 border-yellow-500 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Belum
                                        </span>
                                    @endif
                                </div>
                                <small class="block mt-1 text-xs text-gray-600">
                                    <i class="fas fa-lock mr-1"></i> Email tidak dapat diubah
                                </small>
                            </div>

                            <!-- No. Telepon/WA -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    No. Telepon/WA <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="no_telepon" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('no_telepon') border-red-500 @enderror" 
                                       value="{{ old('no_telepon', $user->no_telepon ?? $user->phone) }}" 
                                       placeholder="Contoh: 081234567890" 
                                       required>
                                <small class="block mt-1 text-xs text-gray-600">
                                    <i class="fas fa-info-circle mr-1"></i> Gunakan format: 08xxxxxxxxxx
                                </small>
                                @error('no_telepon')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="border-gray-300 my-8">

                    <!-- Data Akademik Section -->
                    <div class="mb-8">
                        <div class="flex items-center mb-5 pb-3 border-b-2 border-gray-200">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-graduation-cap text-blue-900 text-xl"></i>
                            </div>
                            <div>
                                <h6 class="text-base font-bold text-blue-900 m-0">Data Akademik</h6>
                                <small class="text-xs text-gray-600">Informasi pendidikan</small>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Fakultas -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Fakultas <span class="text-red-600">*</span>
                                </label>
                                <select name="fakultas" id="fakultas" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('fakultas') border-red-500 @enderror" 
                                        required>
                                    <option value="">-- Pilih Fakultas --</option>
                                    <option value="Ekonomi dan Bisnis" {{ old('fakultas', $user->fakultas) == 'Ekonomi dan Bisnis' ? 'selected' : '' }}>Ekonomi dan Bisnis</option>
                                    <option value="Teknik" {{ old('fakultas', $user->fakultas) == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                                    <option value="Teknologi Informasi dan Komunikasi" {{ old('fakultas', $user->fakultas) == 'Teknologi Informasi dan Komunikasi' ? 'selected' : '' }}>Teknologi Informasi dan Komunikasi</option>
                                    <option value="Psikologi" {{ old('fakultas', $user->fakultas) == 'Psikologi' ? 'selected' : '' }}>Psikologi</option>
                                    <option value="Teknologi Pertanian" {{ old('fakultas', $user->fakultas) == 'Teknologi Pertanian' ? 'selected' : '' }}>Teknologi Pertanian</option>
                                    <option value="Hukum" {{ old('fakultas', $user->fakultas) == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                                </select>
                                @error('fakultas')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Program Studi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Program Studi <span class="text-red-600">*</span>
                                </label>
                                <select name="program_studi" id="program_studi" 
                                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('program_studi') border-red-500 @enderror" 
                                        required>
                                    <option value="">-- Pilih Fakultas Terlebih Dahulu --</option>
                                </select>
                                @error('program_studi')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Angkatan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Angkatan <span class="text-red-600">*</span>
                                </label>
                                <input type="number" name="angkatan" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('angkatan') border-red-500 @enderror" 
                                       value="{{ old('angkatan', $user->angkatan) }}" 
                                       min="2000" max="{{ date('Y') + 1 }}" 
                                       placeholder="Contoh: 2022" 
                                       required>
                                @error('angkatan')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Semester -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Semester <span class="text-red-600">*</span>
                                </label>
                                <input type="number" name="semester" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('semester') border-red-500 @enderror" 
                                       value="{{ old('semester', $user->semester) }}" 
                                       min="1" max="14" 
                                       placeholder="Contoh: 6" 
                                       required>
                                @error('semester')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- IPK -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    IPK <span class="text-red-600">*</span>
                                </label>
                                <input type="number" name="ipk" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('ipk') border-red-500 @enderror" 
                                       value="{{ old('ipk', $user->ipk) }}" 
                                       step="0.01" min="0" max="4" 
                                       placeholder="Contoh: 3.75" 
                                       required>
                                @error('ipk')
                                    <div class="mt-2 text-xs text-red-600 font-medium">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="border-gray-300 my-8">

                    <!-- Foto Profile Section -->
                    <div class="mb-6">
                        <div class="flex items-center mb-5 pb-3 border-b-2 border-gray-200">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i class="fas fa-camera text-blue-900 text-xl"></i>
                            </div>
                            <div>
                                <h6 class="text-base font-bold text-blue-900 m-0">Foto Profile</h6>
                                <small class="text-xs text-gray-600">Upload foto (Opsional)</small>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Upload Foto Profile
                            </label>
                            <input type="file" name="foto_profil" 
                                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-2 focus:ring-blue-200 transition-all @error('foto_profil') border-red-500 @enderror" 
                                   accept="image/jpeg,image/jpg,image/png">
                            <small class="block mt-2 text-xs text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: JPG, JPEG, PNG. Maksimal 2MB
                            </small>
                            @error('foto_profil')
                                <div class="mt-2 text-xs text-red-600 font-medium">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3 px-4 bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold rounded-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i>
                        Simpan & Lanjutkan
                    </button>

                    <p class="text-center text-gray-600 mt-3 mb-0 text-xs">
                        <span class="text-red-600">*</span> Wajib diisi
                    </p>
                </form>
            </div>
        </div>

        <!-- Help Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 shadow-lg">
            <div class="flex items-start gap-3">
                <i class="fas fa-question-circle text-blue-600 text-lg mt-0.5"></i>
                <div>
                    <div class="font-bold text-sm text-gray-900 mb-2">Tips Pengisian</div>
                    <small class="text-xs text-gray-700 leading-relaxed">
                        • Pastikan semua data sesuai dengan dokumen resmi<br>
                        • Gunakan nomor WhatsApp yang aktif untuk komunikasi<br>
                        • IPK harus sesuai dengan transkrip nilai terbaru<br>
                        • Butuh bantuan? Hubungi 
                        <a href="mailto:international@usm.ac.id" class="text-blue-900 font-semibold hover:text-yellow-600">international@usm.ac.id</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom Animations */
    @keyframes spin-slow {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    @keyframes float-1 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    @keyframes float-2 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(-8deg); }
    }

    @keyframes float-3 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-18px) rotate(12deg); }
    }

    @keyframes float-4 {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-22px) rotate(-10deg); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 60s linear infinite;
    }

    .animate-float-1 {
        animation: float-1 6s ease-in-out infinite;
    }

    .animate-float-2 {
        animation: float-2 7s ease-in-out infinite;
    }

    .animate-float-3 {
        animation: float-3 5s ease-in-out infinite;
    }

    .animate-float-4 {
        animation: float-4 8s ease-in-out infinite;
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out;
    }

    /* Remove spinner for number input */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endpush

@push('scripts')
<script>
// Data Program Studi berdasarkan Fakultas
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

// Fungsi untuk update dropdown Program Studi
function updateProdiOptions(fakultasValue, selectedProdi = '') {
    const prodiSelect = document.getElementById('program_studi');
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
document.getElementById('fakultas').addEventListener('change', function() {
    updateProdiOptions(this.value);
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const fakultasSelect = document.getElementById('fakultas');
    const currentFakultas = fakultasSelect.value;
    const currentProdi = '{{ old("program_studi", $user->program_studi ?? "") }}';
    
    if (currentFakultas) {
        updateProdiOptions(currentFakultas, currentProdi);
    }
});
</script>
@endpush
@endsection