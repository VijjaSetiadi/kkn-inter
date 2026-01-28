@extends('layouts.app')

@section('title', 'Registrasi Mahasiswa - Step 1')

@push('styles')
<style>
    .content-wrapper {
        padding: 0 !important;
    }

    /* Globe Rotation Animation */
    @keyframes rotate-globe {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* World Map Background Animation */
    @keyframes world-pulse {
        0%, 100% { opacity: 0.05; transform: scale(1) rotate(0deg); }
        25% { opacity: 0.12; transform: scale(1.03) rotate(2deg); }
        50% { opacity: 0.08; transform: scale(1.05) rotate(0deg); }
        75% { opacity: 0.12; transform: scale(1.03) rotate(-2deg); }
    }

    /* Gradient Background Animation */
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        25% { background-position: 100% 50%; }
        50% { background-position: 50% 100%; }
        75% { background-position: 0% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Particles Animation */
    @keyframes particles-float {
        0% { transform: translateY(100vh) translateX(0) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100vh) translateX(100px) rotate(360deg); opacity: 0; }
    }

    .register-wrapper {
        background: linear-gradient(-45deg, #f8f9fa, #e9ecef, #dee2e6, #f1f3f5, #e8eaf0, #f5f6f8);
        background-size: 600% 600%;
        animation: gradient-shift 12s ease infinite;
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 200px);
        padding: 30px 15px;
    }

    /* Animated Particles */
    .register-wrapper .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: linear-gradient(135deg, #2d3b7f, #F9B234);
        border-radius: 50%;
        opacity: 0;
        animation: particles-float 20s linear infinite;
    }

    .register-wrapper .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 18s; }
    .register-wrapper .particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 22s; }
    .register-wrapper .particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 20s; }
    .register-wrapper .particle:nth-child(4) { left: 40%; animation-delay: 6s; animation-duration: 25s; }
    .register-wrapper .particle:nth-child(5) { left: 50%; animation-delay: 8s; animation-duration: 19s; }
    .register-wrapper .particle:nth-child(6) { left: 60%; animation-delay: 10s; animation-duration: 23s; }
    .register-wrapper .particle:nth-child(7) { left: 70%; animation-delay: 12s; animation-duration: 21s; }
    .register-wrapper .particle:nth-child(8) { left: 80%; animation-delay: 14s; animation-duration: 24s; }
    .register-wrapper .particle:nth-child(9) { left: 90%; animation-delay: 16s; animation-duration: 20s; }
    .register-wrapper .particle:nth-child(10) { left: 15%; animation-delay: 3s; animation-duration: 22s; }

    /* World Map Background */
    .register-wrapper::before {
        content: '\f57d';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        font-size: 350px;
        opacity: 0.05;
        top: 50%;
        left: 50%;
        color: #2d3b7f;
        transform: translate(-50%, -50%);
        animation: rotate-globe 60s linear infinite, world-pulse 8s ease-in-out infinite;
    }

    /* Floating Animation */
    @keyframes float-gentle {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        25% { transform: translateY(-10px) rotate(5deg) scale(1.03); }
        50% { transform: translateY(-5px) rotate(0deg) scale(1); }
        75% { transform: translateY(-12px) rotate(-5deg) scale(1.03); }
    }

    /* Floating Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 10;
    }

    .floating-icon {
        position: absolute;
        font-size: 35px;
        color: #2d3b7f;
        opacity: 0.15;
        animation: float-gentle 6s ease-in-out infinite;
        filter: drop-shadow(2px 2px 8px rgba(45, 59, 127, 0.3));
    }

    .floating-icon:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; font-size: 40px; }
    .floating-icon:nth-child(2) { top: 15%; right: 15%; animation-delay: 1s; font-size: 32px; }
    .floating-icon:nth-child(3) { bottom: 20%; left: 8%; animation-delay: 2s; font-size: 38px; }
    .floating-icon:nth-child(4) { bottom: 15%; right: 12%; animation-delay: 3s; font-size: 30px; }
    .floating-icon:nth-child(5) { top: 50%; left: 5%; animation-delay: 4s; font-size: 35px; }
    .floating-icon:nth-child(6) { top: 50%; right: 5%; animation-delay: 5s; font-size: 32px; }

    /* Card Float Animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .register-container {
        position: relative;
        z-index: 20;
        max-width: 550px;
        margin: 0 auto;
        animation: float 4s ease-in-out infinite;
    }

    /* Fade In Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-container {
        animation: float 4s ease-in-out infinite, fadeInUp 0.6s ease-out;
    }

    /* Custom Card Styling */
    .custom-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #2d3b7f 0%, #1f2a5a 100%);
        padding: 14px;
        text-align: center;
        border-bottom: 2px solid #F9B234;
    }

    /* Progress Steps */
    .progress-steps {
        background: white;
        border-radius: 10px;
        padding: 14px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        margin-bottom: 14px;
    }

    .step-item {
        display: flex;
        align-items: center;
        flex: 1;
        flex-direction: column;
        text-align: center;
        gap: 6px;
    }

    .step-text {
        text-align: center;
    }

    .step-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 13px;
        flex-shrink: 0;
    }

    .step-circle.active {
        background: #2d3b7f;
        color: white;
        box-shadow: 0 3px 10px rgba(45, 59, 127, 0.3);
    }

    .step-circle.inactive {
        background: #e0e0e0;
        color: #999;
    }

    .step-line {
        height: 2px;
        background: #e0e0e0;
        flex: 1;
        margin: 0 8px;
    }

    /* Form Styling */
    .form-label-custom {
        font-size: 12px;
        font-weight: 600;
        color: #333;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-input-custom {
        width: 100%;
        padding: 9px 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 13px;
        transition: all 0.3s;
    }

    .form-input-custom:focus {
        outline: none;
        border-color: #2d3b7f;
        box-shadow: 0 0 0 3px rgba(45, 59, 127, 0.1);
    }

    .form-input-custom.is-invalid {
        border-color: #dc3545;
    }

    /* Button */
    .btn-custom {
        width: 100%;
        padding: 11px;
        background: linear-gradient(90deg, #2d3b7f 0%, #1f2a5a 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 16px rgba(45, 59, 127, 0.3);
    }

    /* Alert Box */
    .alert-custom {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 14px;
    }



    /* Input Group */
    .input-group-custom {
        display: flex;
        align-items: stretch;
    }

    .input-group-text-custom {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-right: none;
        border-radius: 8px 0 0 8px;
        padding: 0 12px;
        display: flex;
        align-items: center;
    }

    .input-group-custom .form-input-custom {
        border-left: none;
        border-radius: 0 8px 8px 0;
    }

    .input-group-custom .form-input-custom:focus {
        border-left: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .register-container {
            max-width: 100%;
        }

        .progress-steps {
            padding: 10px;
        }

        .step-circle {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }

        .step-line {
            display: none;
        }

        .floating-icon {
            font-size: 25px !important;
        }

        .register-wrapper::before {
            font-size: 250px;
        }


    }
</style>
@endpush

@section('content')
<div class="register-wrapper">
    <!-- Animated Particles -->
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>
    <span class="particle"></span>

    <!-- Floating Elements -->
    <div class="floating-elements">
        <i class="floating-icon fas fa-plane"></i>
        <i class="floating-icon fas fa-globe"></i>
        <i class="floating-icon fas fa-plane"></i>
        <i class="floating-icon fas fa-globe-asia"></i>
        <i class="floating-icon fas fa-plane-departure"></i>
        <i class="floating-icon fas fa-globe-americas"></i>
    </div>

    <div class="register-container">


        {{-- Progress Steps --}}
        <div class="progress-steps">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                {{-- Step 1 - Active --}}
                <div class="step-item">
                    <div class="step-circle active">1</div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 700; color: #2d3b7f;">Buat Akun</div>
                        <div style="font-size: 9px; color: #999;">Email & Password</div>
                    </div>
                </div>

                <div class="step-line"></div>

                {{-- Step 2 --}}
                <div class="step-item">
                    <div class="step-circle inactive">2</div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 600; color: #999;">Verifikasi</div>
                        <div style="font-size: 9px; color: #999;">Kode Email</div>
                    </div>
                </div>

                <div class="step-line"></div>

                {{-- Step 3 --}}
                <div class="step-item">
                    <div class="step-circle inactive">3</div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 600; color: #999;">Profil</div>
                        <div style="font-size: 9px; color: #999;">Data Lengkap</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info Alert --}}
        <div class="alert-custom">
            <div style="display: flex; align-items: start; gap: 10px;">
                <i class="fas fa-info-circle" style="color: #3b82f6; font-size: 16px; margin-top: 2px;"></i>
                <div>
                    <div style="font-weight: 700; color: #1e40af; margin-bottom: 3px; font-size: 12px;">Langkah 1 dari 3: Buat Akun</div>
                    <div style="font-size: 11px; color: #1e40af; line-height: 1.4;">
                        Setelah registrasi, Anda akan menerima kode verifikasi via email. Pastikan email yang Anda masukkan aktif dan dapat diakses.
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="custom-card">
            <div class="card-header-custom">
                <h5 style="margin: 0; color: white; font-weight: 700; font-size: 15px;">
                    <i class="fas fa-user-plus" style="margin-right: 6px;"></i>Formulir Registrasi
                </h5>
            </div>
            <div style="padding: 20px;">
                <form method="POST" action="{{ route('register.mahasiswa') }}">
                    @csrf

                    {{-- Email --}}
                    <div style="margin-bottom: 16px;">
                        <label class="form-label-custom">
                            <i class="fas fa-envelope" style="color: #2d3b7f;"></i>
                            Email <span style="color: #dc3545;">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-input-custom @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            placeholder="nama@email.com"
                            required
                            autofocus
                        >
                        @error('email')
                            <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div style="font-size: 10px; color: #999; margin-top: 4px;">
                            <i class="fas fa-info-circle"></i> Gunakan email aktif untuk menerima kode verifikasi
                        </div>
                    </div>

                    {{-- Password --}}
                    <div style="margin-bottom: 16px;">
                        <label class="form-label-custom">
                            <i class="fas fa-lock" style="color: #2d3b7f;"></i>
                            Password <span style="color: #dc3545;">*</span>
                        </label>
                        <div class="input-group-custom">
                            <div class="input-group-text-custom">
                                <i class="fas fa-key" style="color: #999; font-size: 12px;"></i>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-input-custom @error('password') is-invalid @enderror" 
                                placeholder="Minimal 8 karakter"
                                required
                            >
                        </div>
                        @error('password')
                            <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div style="font-size: 10px; color: #999; margin-top: 4px;">
                            <i class="fas fa-shield-alt"></i> Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div style="margin-bottom: 16px;">
                        <label class="form-label-custom">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i>
                            Konfirmasi Password <span style="color: #dc3545;">*</span>
                        </label>
                        <div class="input-group-custom">
                            <div class="input-group-text-custom">
                                <i class="fas fa-check-double" style="color: #999; font-size: 12px;"></i>
                            </div>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-input-custom" 
                                placeholder="Ulangi password"
                                required
                            >
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn-custom">
                        <i class="fas fa-paper-plane" style="margin-right: 6px;"></i>
                        Daftar & Kirim Kode Verifikasi
                    </button>

                    {{-- Login Link --}}
                    <div style="text-align: center; margin-top: 14px;">
                        <p style="color: #666; font-size: 12px; margin: 0;">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" style="color: #2d3b7f; text-decoration: none; font-weight: 700;">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>



        {{-- Help Box --}}
        <div style="text-align: center; margin-top: 14px;">
            <div style="font-size: 11px; color: #999;">
                <i class="fas fa-question-circle"></i>
                Butuh bantuan? Hubungi 
                <a href="mailto:international@usm.ac.id" style="color: #2d3b7f; text-decoration: none; font-weight: 600;">
                    international@usm.ac.id
                </a>
            </div>
        </div>
    </div>
</div>
@endsection