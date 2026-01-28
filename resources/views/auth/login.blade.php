@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="relative min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 overflow-hidden flex items-center justify-center py-12 px-4">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Rotating Globe -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[500px] text-blue-900/5 animate-spin-slow">
            <i class="fas fa-globe"></i>
        </div>
        
        <!-- Floating Icons -->
        <div class="absolute top-[10%] left-[10%] text-[70px] text-blue-900/20 animate-float-gentle-1">
            <i class="fas fa-plane"></i>
        </div>
        <div class="absolute top-[15%] right-[15%] text-[55px] text-blue-900/20 animate-float-gentle-2">
            <i class="fas fa-globe"></i>
        </div>
        <div class="absolute bottom-[20%] left-[8%] text-[65px] text-blue-900/20 animate-float-gentle-3">
            <i class="fas fa-plane"></i>
        </div>
        <div class="absolute bottom-[15%] right-[12%] text-[50px] text-blue-900/20 animate-float-gentle-4">
            <i class="fas fa-globe-asia"></i>
        </div>
        <div class="absolute top-1/2 left-[5%] text-[60px] text-blue-900/20 animate-float-gentle-5">
            <i class="fas fa-plane-departure"></i>
        </div>
        <div class="absolute top-1/2 right-[5%] text-[55px] text-blue-900/20 animate-float-gentle-6">
            <i class="fas fa-globe-americas"></i>
        </div>
    </div>

    <!-- Main Container -->
    <div class="relative z-20 w-full max-w-sm animate-fade-in-up">
        <div class="bg-white rounded-lg shadow-2xl overflow-hidden border border-gray-200 animate-float">
            <!-- Passport Stamps -->
            <div class="absolute -top-2 -right-2 px-4 py-2 bg-white border-2 border-blue-900 rounded text-xs font-bold text-blue-900 transform rotate-[-15deg] opacity-15 z-[-1] animate-stamp-appear">
                INTERNATIONAL
            </div>
            <div class="absolute -bottom-2 -left-2 px-4 py-2 bg-white border-2 border-blue-900 rounded text-xs font-bold text-blue-900 transform rotate-[15deg] opacity-15 z-[-1] animate-stamp-appear-delayed">
                INTERNATIONAL
            </div>

            <!-- Header -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 py-10 px-6 text-center relative overflow-hidden">
                <!-- Rotating Globe Icon -->
                <div class="inline-block text-5xl text-yellow-500 mb-3 animate-spin-slow-header">
                    <i class="fas fa-globe"></i>
                </div>
                
                <h1 class="text-2xl font-bold text-white mb-1 drop-shadow-lg">
                    Welcome! Selamat Datang!
                </h1>
                <p class="text-sm text-white/90">
                    International Office Portal
                </p>

                <!-- Language Icons -->
                <div class="flex justify-center gap-4 mt-3">
                    <span class="text-xl text-yellow-500 animate-language-float-1">
                        <i class="fas fa-plane"></i>
                    </span>
                    <span class="text-xl text-yellow-500 animate-language-float-2">
                        <i class="fas fa-globe"></i>
                    </span>
                    <span class="text-xl text-yellow-500 animate-language-float-3">
                        <i class="fas fa-plane-departure"></i>
                    </span>
                    <span class="text-xl text-yellow-500 animate-language-float-4">
                        <i class="fas fa-globe-asia"></i>
                    </span>
                    <span class="text-xl text-yellow-500 animate-language-float-5">
                        <i class="fas fa-plane-arrival"></i>
                    </span>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6">
                <!-- Session Status Alert -->
                @if (session('status'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-5 flex items-center gap-3 animate-slide-in-down">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                        <p class="flex-1 text-sm text-green-800 font-medium m-0">{{ session('status') }}</p>
                        <button type="button" onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope text-blue-900 text-xs"></i>
                            Email
                        </label>
                        <input 
                            type="email" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-900 focus:ring-4 focus:ring-blue-100 transition-all @error('email') border-red-500 bg-red-50 @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="Masukkan email Anda"
                            required 
                            autofocus
                        >
                        @error('email')
                            <div class="mt-2 text-xs text-red-600 font-medium">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock text-blue-900 text-xs"></i>
                            Password
                        </label>
                        <input 
                            type="password" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-900 focus:ring-4 focus:ring-blue-100 transition-all @error('password') border-red-500 bg-red-50 @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                        @error('password')
                            <div class="mt-2 text-xs text-red-600 font-medium">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-2 mb-5">
                        <input 
                            type="checkbox" 
                            id="remember_me" 
                            name="remember"
                            class="w-4 h-4 cursor-pointer accent-blue-900"
                        >
                        <label for="remember_me" class="text-sm text-gray-600 font-medium cursor-pointer m-0">
                            Ingat Saya
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold rounded-lg text-sm hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 animate-button-shine"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>

                    <!-- Forgot Password -->
                    <div class="text-center mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-900 hover:text-yellow-600 transition-colors">
                                <i class="fas fa-key mr-1 text-xs"></i>Lupa Password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 border-t border-gray-200 py-5 px-6 text-center">
                <p class="text-sm text-gray-600 m-0">
                    Belum punya akun? 
                    <a href="{{ route('register.mahasiswa') }}" class="font-bold text-blue-900 hover:text-yellow-600 transition-colors">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Animations */
    @keyframes spin-slow {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    @keyframes spin-slow-header {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes float-gentle-1 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        25% { transform: translateY(-15px) rotate(8deg) scale(1.05); }
        50% { transform: translateY(-8px) rotate(0deg) scale(1); }
        75% { transform: translateY(-20px) rotate(-8deg) scale(1.05); }
    }

    @keyframes float-gentle-2 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        25% { transform: translateY(-12px) rotate(-6deg) scale(1.03); }
        50% { transform: translateY(-6px) rotate(0deg) scale(1); }
        75% { transform: translateY(-18px) rotate(6deg) scale(1.03); }
    }

    @keyframes float-gentle-3 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        33% { transform: translateY(-10px) rotate(5deg) scale(1.04); }
        66% { transform: translateY(-5px) rotate(-5deg) scale(1); }
    }

    @keyframes float-gentle-4 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        40% { transform: translateY(-14px) rotate(-7deg) scale(1.05); }
        80% { transform: translateY(-7px) rotate(7deg) scale(1.02); }
    }

    @keyframes float-gentle-5 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        30% { transform: translateY(-16px) rotate(6deg) scale(1.04); }
        70% { transform: translateY(-8px) rotate(-6deg) scale(1.02); }
    }

    @keyframes float-gentle-6 {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        35% { transform: translateY(-11px) rotate(-8deg) scale(1.03); }
        75% { transform: translateY(-9px) rotate(8deg) scale(1.04); }
    }

    @keyframes language-float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
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

    @keyframes stamp-appear {
        0% { opacity: 0; transform: scale(0) rotate(-45deg); }
        50% { opacity: 0.3; transform: scale(1.2) rotate(-10deg); }
        100% { opacity: 0.15; transform: scale(1) rotate(-15deg); }
    }

    @keyframes slide-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes button-shine {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .animate-spin-slow {
        animation: spin-slow 60s linear infinite;
    }

    .animate-spin-slow-header {
        animation: spin-slow-header 20s linear infinite;
    }

    .animate-float-gentle-1 {
        animation: float-gentle-1 6s ease-in-out infinite;
    }

    .animate-float-gentle-2 {
        animation: float-gentle-2 7s ease-in-out infinite;
    }

    .animate-float-gentle-3 {
        animation: float-gentle-3 5s ease-in-out infinite;
    }

    .animate-float-gentle-4 {
        animation: float-gentle-4 8s ease-in-out infinite;
    }

    .animate-float-gentle-5 {
        animation: float-gentle-5 6.5s ease-in-out infinite;
    }

    .animate-float-gentle-6 {
        animation: float-gentle-6 7.5s ease-in-out infinite;
    }

    .animate-language-float-1 {
        animation: language-float 2s ease-in-out infinite 0s;
    }

    .animate-language-float-2 {
        animation: language-float 2s ease-in-out infinite 0.3s;
    }

    .animate-language-float-3 {
        animation: language-float 2s ease-in-out infinite 0.6s;
    }

    .animate-language-float-4 {
        animation: language-float 2s ease-in-out infinite 0.9s;
    }

    .animate-language-float-5 {
        animation: language-float 2s ease-in-out infinite 1.2s;
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out;
    }

    .animate-stamp-appear {
        animation: stamp-appear 1s ease-out 0.3s both;
    }

    .animate-stamp-appear-delayed {
        animation: stamp-appear 1s ease-out 0.6s both;
    }

    .animate-slide-in-down {
        animation: slide-in-down 0.5s ease-out;
    }

    .animate-button-shine {
        background-size: 200% auto;
    }

    .animate-button-shine:hover {
        animation: button-shine 1.5s linear infinite;
    }
</style>
@endsection