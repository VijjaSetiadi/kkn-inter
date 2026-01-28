@extends('layouts.app')

@section('title', 'Lengkapi Profile')

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

    .profile-wrapper {
        background: linear-gradient(-45deg, #f8f9fa, #e9ecef, #dee2e6, #f1f3f5, #e8eaf0, #f5f6f8);
        background-size: 600% 600%;
        animation: gradient-shift 12s ease infinite;
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 200px);
        padding: 30px 15px;
    }

    /* Animated Particles */
    .profile-wrapper .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: linear-gradient(135deg, #2d3b7f, #F9B234);
        border-radius: 50%;
        opacity: 0;
        animation: particles-float 20s linear infinite;
    }

    .profile-wrapper .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 18s; }
    .profile-wrapper .particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 22s; }
    .profile-wrapper .particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 20s; }
    .profile-wrapper .particle:nth-child(4) { left: 40%; animation-delay: 6s; animation-duration: 25s; }
    .profile-wrapper .particle:nth-child(5) { left: 50%; animation-delay: 8s; animation-duration: 19s; }
    .profile-wrapper .particle:nth-child(6) { left: 60%; animation-delay: 10s; animation-duration: 23s; }
    .profile-wrapper .particle:nth-child(7) { left: 70%; animation-delay: 12s; animation-duration: 21s; }
    .profile-wrapper .particle:nth-child(8) { left: 80%; animation-delay: 14s; animation-duration: 24s; }
    .profile-wrapper .particle:nth-child(9) { left: 90%; animation-delay: 16s; animation-duration: 20s; }
    .profile-wrapper .particle:nth-child(10) { left: 15%; animation-delay: 3s; animation-duration: 22s; }

    /* World Map Background */
    .profile-wrapper::before {
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

    .profile-container {
        position: relative;
        z-index: 20;
        max-width: 900px;
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

    .profile-container {
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

    .step-circle.completed {
        background: #10b981;
        color: white;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
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
        flex: 1;
        margin: 0 8px;
    }

    .step-line.completed {
        background: #10b981;
    }

    .step-line.inactive {
        background: #e0e0e0;
    }

    /* Alert Box */
    .alert-custom {
        background: rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 14px;
    }

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
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

    .form-input-custom:disabled {
        background: #f8f9fa;
        cursor: not-allowed;
    }

    /* Section Header */
    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e0e0e0;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(45, 59, 127, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
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

    /* Help Box */
    .help-box {
        background: rgba(59, 130, 246, 0.05);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 10px;
        padding: 12px;
        margin-top: 14px;
    }

    .help-box i {
        color: #3b82f6;
        font-size: 14px;
    }

    .help-box small {
        font-size: 11px;
        color: #666;
        line-height: 1.5;
    }

    .help-box a {
        color: #2d3b7f;
        text-decoration: none;
        font-weight: 600;
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

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
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

        .profile-wrapper::before {
            font-size: 250px;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-wrapper">
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
        <i class="floating-icon fas fa-user-graduate"></i>
        <i class="floating-icon fas fa-university"></i>
        <i class="floating-icon fas fa-graduation-cap"></i>
        <i class="floating-icon fas fa-book"></i>
        <i class="floating-icon fas fa-user-circle"></i>
        <i class="floating-icon fas fa-id-card"></i>
    </div>

    <div class="profile-container">
        {{-- Progress Steps --}}
        <div class="progress-steps">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                {{-- Step 1 - Completed --}}
                <div class="step-item">
                    <div class="step-circle completed">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 700; color: #10b981;">Buat Akun</div>
                        <div style="font-size: 9px; color: #999;">Email & Password</div>
                    </div>
                </div>

                <div class="step-line completed"></div>

                {{-- Step 2 - Completed --}}
                <div class="step-item">
                    <div class="step-circle completed">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 700; color: #10b981;">Verifikasi</div>
                        <div style="font-size: 9px; color: #999;">Kode Email</div>
                    </div>
                </div>

                <div class="step-line completed"></div>

                {{-- Step 3 - Active --}}
                <div class="step-item">
                    <div class="step-circle active">3</div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 700; color: #2d3b7f;">Profil</div>
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
                    <div style="font-weight: 700; color: #1e40af; margin-bottom: 3px; font-size: 12px;">Langkah 3 dari 3: Lengkapi Data Profil</div>
                    <div style="font-size: 11px; color: #1e40af; line-height: 1.4;">
                        Isi semua data diri dengan lengkap dan benar. Data ini akan digunakan untuk proses pendaftaran KKN International.
                    </div>
                </div>
            </div>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="alert-custom alert-error">
            <div style="display: flex; align-items: start; gap: 10px;">
                <i class="fas fa-exclamation-triangle" style="color: #ef4444; font-size: 16px; margin-top: 2px;"></i>
                <div style="flex: 1;">
                    <div style="font-weight: 700; color: #991b1b; margin-bottom: 6px; font-size: 12px;">Terjadi Kesalahan!</div>
                    <ul style="margin: 0; padding-left: 20px; font-size: 11px; color: #991b1b; line-height: 1.6;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Main Form Card --}}
        <div class="custom-card">
            <div class="card-header-custom">
                <h5 style="margin: 0; color: white; font-weight: 700; font-size: 15px;">
                    <i class="fas fa-user-edit" style="margin-right: 6px;"></i>Lengkapi Data Profile
                </h5>
            </div>
            <div style="padding: 20px;">
                <form action="{{ route('profile.complete.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Data Pribadi Section --}}
                    <div style="margin-bottom: 24px;">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-user" style="color: #2d3b7f; font-size: 16px;"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-size: 13px; font-weight: 700; color: #2d3b7f;">Data Pribadi</h6>
                                <small style="font-size: 10px; color: #666;">Informasi identitas diri</small>
                            </div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-user" style="color: #2d3b7f; font-size: 11px;"></i>
                                    Nama Lengkap <span style="color: #dc3545;">*</span>
                                </label>
                                <input type="text" name="name" 
                                       class="form-input-custom @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- NIM --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-id-badge" style="color: #2d3b7f; font-size: 11px;"></i>
                                    NIM <span style="color: #dc3545;">*</span>
                                </label>
                                @if($user->nim)
                                    <input type="text" 
                                           class="form-input-custom" 
                                           value="{{ $user->nim }}" disabled>
                                    <input type="hidden" name="nim" value="{{ $user->nim }}">
                                    <small style="display: block; margin-top: 4px; font-size: 10px; color: #666;">
                                        <i class="fas fa-lock" style="font-size: 9px;"></i> NIM tidak dapat diubah
                                    </small>
                                @else
                                    <input type="text" name="nim" 
                                           class="form-input-custom @error('nim') is-invalid @enderror" 
                                           value="{{ old('nim') }}" 
                                           placeholder="Contoh: G.211.22.0091" 
                                           required>
                                    @error('nim')
                                        <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-envelope" style="color: #10b981; font-size: 11px;"></i>
                                    Email
                                </label>
                                <input type="email" 
                                       class="form-input-custom" 
                                       value="{{ $user->email }}" disabled>
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <small style="display: block; margin-top: 4px; font-size: 10px; color: #666;">
                                    <i class="fas fa-lock" style="font-size: 9px;"></i> Email tidak dapat diubah
                                </small>
                            </div>

                            {{-- No. Telepon/WA --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fab fa-whatsapp" style="color: #10b981; font-size: 11px;"></i>
                                    No. Telepon/WA <span style="color: #dc3545;">*</span>
                                </label>
                                <input type="text" name="no_telepon" 
                                       class="form-input-custom @error('no_telepon') is-invalid @enderror" 
                                       value="{{ old('no_telepon', $user->no_telepon ?? $user->phone) }}" 
                                       placeholder="Contoh: 081234567890" 
                                       required>
                                <small style="display: block; margin-top: 4px; font-size: 10px; color: #666;">
                                    <i class="fas fa-info-circle" style="font-size: 9px;"></i> Gunakan format: 08xxxxxxxxxx
                                </small>
                                @error('no_telepon')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div style="margin: 20px 0; border-top: 1px solid #e0e0e0;"></div>

                    {{-- Data Akademik Section --}}
                    <div style="margin-bottom: 24px;">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-graduation-cap" style="color: #2d3b7f; font-size: 16px;"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-size: 13px; font-weight: 700; color: #2d3b7f;">Data Akademik</h6>
                                <small style="font-size: 10px; color: #666;">Informasi pendidikan</small>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                            {{-- Fakultas --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-university" style="color: #2d3b7f; font-size: 11px;"></i>
                                    Fakultas <span style="color: #dc3545;">*</span>
                                </label>
                                <select name="fakultas" id="fakultas" 
                                        class="form-input-custom @error('fakultas') is-invalid @enderror" 
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
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Program Studi --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-book" style="color: #2d3b7f; font-size: 11px;"></i>
                                    Program Studi <span style="color: #dc3545;">*</span>
                                </label>
                                <select name="program_studi" id="program_studi" 
                                        class="form-input-custom @error('program_studi') is-invalid @enderror" 
                                        required>
                                    <option value="">-- Pilih Fakultas Terlebih Dahulu --</option>
                                </select>
                                @error('program_studi')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Angkatan --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-calendar-alt" style="color: #3b82f6; font-size: 11px;"></i>
                                    Angkatan <span style="color: #dc3545;">*</span>
                                </label>
                                <input type="number" name="angkatan" 
                                       class="form-input-custom @error('angkatan') is-invalid @enderror" 
                                       value="{{ old('angkatan', $user->angkatan) }}" 
                                       min="2000" max="{{ date('Y') + 1 }}" 
                                       placeholder="Contoh: 2022" 
                                       required>
                                @error('angkatan')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Semester --}}
                            <div>
                                <label class="form-label-custom">
                                    <i class="fas fa-layer-group" style="color: #f59e0b; font-size: 11px;"></i>
                                    Semester <span style="color: #dc3545;">*</span>
                                </label>
                                <input type="number" name="semester" 
                                       class="form-input-custom @error('semester') is-invalid @enderror" 
                                       value="{{ old('semester', $user->semester) }}" 
                                       min="1" max="14" 
                                       placeholder="Contoh: 6" 
                                       required>
                                @error('semester')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- IPK --}}
                            <div style="grid-column: 1 / -1;">
                                <label class="form-label-custom">
                                    <i class="fas fa-chart-line" style="color: #10b981; font-size: 11px;"></i>
                                    IPK <span style="color: #dc3545;">*</span>
                                </label>
                                <input type="number" name="ipk" 
                                       class="form-input-custom @error('ipk') is-invalid @enderror" 
                                       value="{{ old('ipk', $user->ipk) }}" 
                                       step="0.01" min="0" max="4" 
                                       placeholder="Contoh: 3.75" 
                                       required>
                                @error('ipk')
                                    <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div style="margin: 20px 0; border-top: 1px solid #e0e0e0;"></div>

                    {{-- Foto Profile Section --}}
                    <div style="margin-bottom: 20px;">
                        <div class="section-header">
                            <div class="section-icon">
                                <i class="fas fa-camera" style="color: #2d3b7f; font-size: 16px;"></i>
                            </div>
                            <div>
                                <h6 style="margin: 0; font-size: 13px; font-weight: 700; color: #2d3b7f;">Foto Profile</h6>
                                <small style="font-size: 10px; color: #666;">Upload foto (Opsional)</small>
                            </div>
                        </div>

                        <div>
                            <label class="form-label-custom">
                                <i class="fas fa-image" style="color: #2d3b7f; font-size: 11px;"></i>
                                Upload Foto Profile
                            </label>
                            <input type="file" name="foto_profil" 
                                   class="form-input-custom @error('foto_profil') is-invalid @enderror" 
                                   accept="image/jpeg,image/jpg,image/png">
                            <small style="display: block; margin-top: 4px; font-size: 10px; color: #666;">
                                <i class="fas fa-info-circle" style="font-size: 9px;"></i>
                                Format: JPG, JPEG, PNG. Maksimal 2MB
                            </small>
                            @error('foto_profil')
                                <div style="color: #dc3545; font-size: 11px; margin-top: 4px;">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn-custom">
                        <i class="fas fa-save" style="margin-right: 6px;"></i>
                        Simpan & Lanjutkan
                    </button>

                    <p style="text-align: center; color: #666; margin-top: 10px; margin-bottom: 0; font-size: 11px;">
                        <span style="color: #dc3545;">*</span> Wajib diisi
                    </p>
                </form>
            </div>
        </div>

        {{-- Help Box --}}
        <div class="help-box">
            <div style="display: flex; align-items: start; gap: 10px;">
                <i class="fas fa-question-circle"></i>
                <div>
                    <div style="font-weight: 700; margin-bottom: 6px; font-size: 12px; color: #333;">Tips Pengisian</div>
                    <small>
                        • Pastikan semua data sesuai dengan dokumen resmi<br>
                        • Gunakan nomor WhatsApp yang aktif untuk komunikasi<br>
                        • IPK harus sesuai dengan transkrip nilai terbaru<br>
                        • Butuh bantuan? Hubungi 
                        <a href="mailto:international@usm.ac.id">international@usm.ac.id</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection