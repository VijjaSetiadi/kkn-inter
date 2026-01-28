@extends('layouts.app')

@section('title', 'Verifikasi Email')

@push('styles')
<style>xxx
    .verification-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px;
    }

    .verification-card {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .icon-container {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
    }

    .icon-container i {
        font-size: 2.5rem;
        color: white;
    }

    .code-inputs {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin: 30px 0;
    }

    .code-input {
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .code-input:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .resend-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
    }

    .resend-link:hover {
        text-decoration: underline;
    }

    .btn-verify {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 15px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        width: 100%;
        color: white;
        transition: transform 0.3s;
    }

    .btn-verify:hover {
        transform: translateY(-2px);
    }

    .info-box {
        background: #e3f2fd;
        border-left: 4px solid #2196f3;
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="verification-container">
    <div class="verification-card">
        <div class="icon-container">
            <i class="fas fa-envelope"></i>
        </div>

        <h2 class="text-center mb-3 fw-bold">Verifikasi Email</h2>
        <p class="text-center text-muted mb-4">
            Kami telah mengirim kode verifikasi 6 digit ke:<br>
            <strong>{{ session('email') }}</strong>
        </p>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('verification.verify') }}" method="POST" id="verificationForm">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            
            <div class="code-inputs">
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
                <input type="text" class="code-input" maxlength="1" name="code[]" required>
            </div>

            <!-- Hidden input untuk menggabungkan kode -->
            <input type="hidden" name="code" id="combinedCode">

            @error('code')
                <div class="text-danger text-center mb-3">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-verify">
                <i class="fas fa-check-circle me-2"></i>Verifikasi Sekarang
            </button>
        </form>

        <div class="info-box mt-4">
            <small>
                <i class="fas fa-info-circle me-1"></i>
                <strong>Catatan:</strong> Kode berlaku selama <strong>10 menit</strong>. Periksa folder spam jika email tidak masuk.
            </small>
        </div>

        <div class="text-center mt-4">
            <p class="text-muted mb-2">Tidak menerima kode?</p>
            <form action="{{ route('verification.resend') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">
                <button type="submit" class="btn btn-link resend-link p-0">
                    <i class="fas fa-redo me-1"></i>Kirim Ulang Kode
                </button>
            </form>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('register.mahasiswa') }}" class="text-muted">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Registrasi
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.code-input');
    const form = document.getElementById('verificationForm');
    const combinedCodeInput = document.getElementById('combinedCode');

    // Auto focus next input
    inputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Only allow numbers
            if (!/^\d$/.test(value)) {
                e.target.value = '';
                return;
            }

            // Move to next input
            if (value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Handle backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Handle paste
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').trim();
            
            if (/^\d{6}$/.test(pastedData)) {
                pastedData.split('').forEach((char, i) => {
                    if (inputs[i]) {
                        inputs[i].value = char;
                    }
                });
                inputs[5].focus();
            }
        });
    });

    // Combine code before submit
    form.addEventListener('submit', function(e) {
        const code = Array.from(inputs).map(input => input.value).join('');
        combinedCodeInput.value = code;

        if (code.length !== 6) {
            e.preventDefault();
            alert('Mohon lengkapi semua digit kode verifikasi!');
        }
    });

    // Auto focus first input
    inputs[0].focus();
});
</script>
@endpush
@endsection