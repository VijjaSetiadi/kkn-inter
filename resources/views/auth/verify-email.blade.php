@extends('layouts.app')

@section('title', 'Verifikasi Email')

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

    .verification-wrapper {
        background: linear-gradient(-45deg, #f8f9fa, #e9ecef, #dee2e6, #f1f3f5, #e8eaf0, #f5f6f8);
        background-size: 600% 600%;
        animation: gradient-shift 12s ease infinite;
        position: relative;
        overflow: hidden;
        min-height: calc(100vh - 200px);
        padding: 30px 15px;
    }

    /* Animated Particles */
    .verification-wrapper .particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: linear-gradient(135deg, #2d3b7f, #F9B234);
        border-radius: 50%;
        opacity: 0;
        animation: particles-float 20s linear infinite;
    }

    .verification-wrapper .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 18s; }
    .verification-wrapper .particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 22s; }
    .verification-wrapper .particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 20s; }
    .verification-wrapper .particle:nth-child(4) { left: 40%; animation-delay: 6s; animation-duration: 25s; }
    .verification-wrapper .particle:nth-child(5) { left: 50%; animation-delay: 8s; animation-duration: 19s; }
    .verification-wrapper .particle:nth-child(6) { left: 60%; animation-delay: 10s; animation-duration: 23s; }
    .verification-wrapper .particle:nth-child(7) { left: 70%; animation-delay: 12s; animation-duration: 21s; }
    .verification-wrapper .particle:nth-child(8) { left: 80%; animation-delay: 14s; animation-duration: 24s; }
    .verification-wrapper .particle:nth-child(9) { left: 90%; animation-delay: 16s; animation-duration: 20s; }
    .verification-wrapper .particle:nth-child(10) { left: 15%; animation-delay: 3s; animation-duration: 22s; }

    /* World Map Background */
    .verification-wrapper::before {
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

    .verification-container {
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

    .verification-container {
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

    /* Email Display */
    .email-display {
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 16px;
        text-align: center;
        margin-bottom: 14px;
    }

    .email-display p {
        margin: 0;
        font-size: 11px;
        color: #666;
        line-height: 1.5;
    }

    .email-display strong {
        color: #2d3b7f;
        font-size: 12px;
    }

    /* Verification Code Input */
    .verification-input {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        letter-spacing: 8px;
        transition: all 0.3s;
    }

    .verification-input:focus {
        outline: none;
        border-color: #2d3b7f;
        box-shadow: 0 0 0 3px rgba(45, 59, 127, 0.1);
    }

    .verification-input.is-invalid {
        border-color: #dc3545;
    }

    /* Remove spinner for number input */
    .verification-input::-webkit-outer-spin-button,
    .verification-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Timer Display */
    .timer-display {
        background: rgba(45, 59, 127, 0.1);
        border-radius: 20px;
        padding: 6px 14px;
        display: inline-block;
        margin-bottom: 14px;
    }

    .timer-display i {
        color: #2d3b7f;
        font-size: 11px;
    }

    .timer-display span {
        color: #2d3b7f;
        font-weight: 600;
        font-size: 11px;
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

    .btn-custom:active {
        transform: translateY(0);
    }

    .btn-outline {
        background: white;
        color: #2d3b7f;
        border: 2px solid #2d3b7f;
    }

    .btn-outline:hover {
        background: #2d3b7f;
        color: white;
    }

    /* Divider */
    .divider {
        position: relative;
        margin: 14px 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e0e0e0;
    }

    .divider span {
        position: relative;
        background: white;
        padding: 0 12px;
        font-size: 11px;
        color: #999;
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

    .help-box a:hover {
        color: #F9B234;
    }

    /* Back Link */
    .back-link {
        text-align: center;
        margin-top: 14px;
    }

    .back-link a {
        color: #999;
        text-decoration: none;
        font-size: 11px;
        transition: color 0.3s;
    }

    .back-link a:hover {
        color: #2d3b7f;
    }

    .back-link i {
        font-size: 10px;
    }

    /* Info Text */
    .info-text {
        font-size: 10px;
        color: #666;
        margin-top: 6px;
        text-align: center;
    }

    .info-text i {
        margin-right: 4px;
        font-size: 10px;
    }

    .invalid-feedback {
        display: block;
        margin-top: 6px;
        font-size: 11px;
        color: #dc3545;
        font-weight: 500;
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .verification-container {
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

        .verification-wrapper::before {
            font-size: 250px;
        }

        .verification-input {
            font-size: 20px;
            letter-spacing: 6px;
        }
    }
</style>
@endpush

@section('content')
<div class="verification-wrapper">
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

    <div class="verification-container">
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

                {{-- Step 2 - Active --}}
                <div class="step-item">
                    <div class="step-circle active">2</div>
                    <div class="step-text">
                        <div style="font-size: 11px; font-weight: 700; color: #2d3b7f;">Verifikasi</div>
                        <div style="font-size: 9px; color: #999;">Kode Email</div>
                    </div>
                </div>

                <div class="step-line inactive"></div>

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
                    <div style="font-weight: 700; color: #1e40af; margin-bottom: 3px; font-size: 12px;">Langkah 2 dari 3: Verifikasi Email</div>
                    <div style="font-size: 11px; color: #1e40af; line-height: 1.4;">
                        Masukkan kode 6 digit yang telah dikirim ke email Anda. Kode berlaku selama 10 menit.
                    </div>
                </div>
            </div>
        </div>

        {{-- Email Display --}}
        <div class="email-display">
            <p>
                Kode verifikasi telah dikirim ke<br>
                <strong>{{ session('verification_email') }}</strong>
            </p>
        </div>

        {{-- Main Form Card --}}
        <div class="custom-card">
            <div class="card-header-custom">
                <h5 style="margin: 0; color: white; font-weight: 700; font-size: 15px;">
                    <i class="fas fa-key" style="margin-right: 6px;"></i>Masukkan Kode Verifikasi
                </h5>
            </div>
            <div style="padding: 20px;">
                <form method="POST" action="{{ route('verification.verify') }}" id="verificationForm">
                    @csrf

                    {{-- Kode Verifikasi Input --}}
                    <div style="margin-bottom: 16px;">
                        <input 
                            type="text" 
                            name="verification_code" 
                            id="verification_code" 
                            class="verification-input @error('verification_code') is-invalid @enderror" 
                            maxlength="6"
                            pattern="[0-9]{6}"
                            placeholder="000000"
                            required
                            autofocus
                        >
                        @error('verification_code')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                        <div class="info-text">
                            <i class="fas fa-info-circle"></i>
                            Masukkan 6 digit kode yang dikirim ke email Anda
                        </div>
                    </div>

                    {{-- Timer Display --}}
                    <div style="text-align: center; margin-bottom: 16px;">
                        <div class="timer-display">
                            <i class="fas fa-clock"></i>
                            <span id="countdown">Kode berlaku selama 10 menit</span>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn-custom">
                        <i class="fas fa-check-circle" style="margin-right: 6px;"></i>
                        Verifikasi Email
                    </button>

                    {{-- Divider --}}
                    <div class="divider" style="text-align: center;">
                        <span>Tidak menerima kode?</span>
                    </div>
                </form>

                {{-- Resend Button (Separate Form) --}}
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn-custom btn-outline">
                        <i class="fas fa-redo" style="margin-right: 6px;"></i>
                        Kirim Ulang Kode Verifikasi
                    </button>
                </form>
            </div>
        </div>

        {{-- Help Box --}}
        <div class="help-box">
            <div style="display: flex; align-items: start; gap: 10px;">
                <i class="fas fa-question-circle"></i>
                <div>
                    <div style="font-weight: 700; margin-bottom: 6px; font-size: 12px; color: #333;">Tips Verifikasi</div>
                    <small>
                        • Periksa folder spam/junk email Anda<br>
                        • Pastikan email yang dimasukkan benar<br>
                        • Kode berlaku selama 10 menit<br>
                        • Butuh bantuan? Hubungi 
                        <a href="mailto:international@usm.ac.id">international@usm.ac.id</a>
                    </small>
                </div>
            </div>
        </div>

        {{-- Back Link --}}
        <div class="back-link">
            <a href="{{ route('register.mahasiswa') }}">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Registrasi
            </a>
        </div>
    </div>
</div>

<script>
// Auto-submit ketika 6 digit terisi (opsional)
document.getElementById('verification_code').addEventListener('input', function(e) {
    // Hanya izinkan angka
    e.target.value = e.target.value.replace(/[^0-9]/g, '');
    
    // Optional: Auto-submit saat 6 digit
    if (e.target.value.length === 6) {
        // Uncomment untuk auto-submit
        // document.getElementById('verificationForm').submit();
    }
});

// Countdown Timer (Optional - jika ada expiry time dari backend)
/*
let countdownElement = document.getElementById('countdown');
let expiryTime = new Date(Date.now() + 10 * 60 * 1000); // 10 menit dari sekarang

setInterval(function() {
    let now = new Date().getTime();
    let distance = expiryTime - now;
    
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    if (distance < 0) {
        countdownElement.innerHTML = "Kode telah kadaluarsa";
        countdownElement.classList.add('text-danger');
    } else {
        countdownElement.innerHTML = `Kode berlaku ${minutes}:${seconds.toString().padStart(2, '0')} lagi`;
    }
}, 1000);
*/
</script>
@endsection