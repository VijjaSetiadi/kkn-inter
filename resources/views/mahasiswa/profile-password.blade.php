@extends('layouts.app')

@section('title', 'Ganti Password')

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

    /* Input Focus Animation */
    input:focus {
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }

    /* Button Hover Animation */
    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.4);
    }

    /* Password Strength Indicator */
    .password-strength {
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    <div class="main-container max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-4 flex items-center justify-between flex-wrap gap-3">
            <h2 class="text-blue-900 text-lg md:text-2xl font-bold bg-white/90 backdrop-blur-sm rounded-lg px-4 py-3 border-l-4 border-yellow-500 shadow-md">
                <i class="fas fa-lock mr-2"></i> Ganti Password
            </h2>
            <a href="{{ route('mahasiswa.profile') }}" 
               class="inline-flex items-center bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
        <div class="alert-notification bg-green-50 border-l-4 border-green-500 rounded-lg p-3 mb-3 shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-lg mr-2"></i>
                    <div>
                        <span class="text-green-800 font-bold text-sm">Berhasil!</span>
                        <p class="text-green-700 text-xs mt-1">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        <!-- Info Alert -->
        <div class="mobile-card">
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-3">
                        <h6 class="text-blue-900 font-bold text-sm mb-2">Perhatian:</h6>
                        <ul class="space-y-1 text-xs text-blue-800">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-600 mr-2 mt-0.5"></i>
                                <span>Password minimal 8 karakter</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-600 mr-2 mt-0.5"></i>
                                <span>Pastikan Anda mengingat password baru</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-600 mr-2 mt-0.5"></i>
                                <span>Setelah ganti password, Anda akan tetap login</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="mobile-card">
            <div class="mobile-card-header">
                <i class="fas fa-key mr-2"></i> Form Ganti Password
            </div>
            <div class="mobile-card-body">
                <form method="POST" action="{{ route('mahasiswa.profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key text-gray-600 mr-1"></i>
                            Password Lama <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                class="block w-full pl-10 pr-3 py-2.5 text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('current_password') border-red-500 @enderror" 
                                id="current_password" 
                                name="current_password" 
                                placeholder="Masukkan password lama Anda"
                                required>
                        </div>
                        @error('current_password')
                            <div class="text-red-600 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t-2 border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-4 text-xs font-bold text-gray-500">
                                PASSWORD BARU
                            </span>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">
                            <i class="fas fa-shield-alt text-blue-600 mr-1"></i>
                            Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-shield-alt text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                class="block w-full pl-10 pr-3 py-2.5 text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('password') border-red-500 @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Masukkan password baru (min. 8 karakter)"
                                required>
                        </div>
                        @error('password')
                            <div class="text-red-600 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @else
                            <div class="text-gray-500 text-xs mt-1 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Password minimal 8 karakter
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-gray-700 mb-2">
                            <i class="fas fa-check-circle text-green-600 mr-1"></i>
                            Konfirmasi Password Baru <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-check-double text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                class="block w-full pl-10 pr-3 py-2.5 text-sm text-gray-700 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all @error('password_confirmation') border-red-500 @enderror" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="Ulangi password baru"
                                required>
                        </div>
                        @error('password_confirmation')
                            <div class="text-red-600 text-xs mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t-2 border-gray-200 pt-4 flex flex-col md:flex-row justify-between items-center gap-3">
                        <a href="{{ route('mahasiswa.profile') }}" 
                           class="w-full md:w-auto inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md">
                            <i class="fas fa-times mr-2"></i> Batal
                        </a>
                        <button type="submit" 
                                class="w-full md:w-auto inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition-all shadow-md btn-hover">
                            <i class="fas fa-save mr-2"></i> Simpan Password Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Tips Card -->
        <div class="mobile-card">
            <div class="mobile-card-header bg-gradient-to-r from-green-600 to-green-700">
                <i class="fas fa-shield-alt mr-2"></i> Tips Keamanan Password
            </div>
            <div class="mobile-card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Tip 1 -->
                    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-800 text-xs leading-relaxed">
                                    Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tip 2 -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-800 text-xs leading-relaxed">
                                    Hindari menggunakan informasi pribadi (tanggal lahir, nama, dll)
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tip 3 -->
                    <div class="bg-purple-50 border-l-4 border-purple-500 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-800 text-xs leading-relaxed">
                                    Jangan gunakan password yang sama untuk akun lain
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tip 4 -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-800 text-xs leading-relaxed">
                                    Ganti password secara berkala untuk keamanan akun Anda
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });

    // Password strength indicator (optional enhancement)
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            // You can add visual feedback based on strength here
            console.log('Password strength:', strength);
        });
    }

    // Confirm password match validation
    const confirmPassword = document.getElementById('password_confirmation');
    if (confirmPassword && passwordInput) {
        confirmPassword.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                this.classList.add('border-red-500');
                this.classList.remove('border-gray-300');
            } else {
                this.classList.remove('border-red-500');
                this.classList.add('border-green-500');
            }
        });
    }
</script>
@endpush