@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                {{-- Header --}}
                <div class="card-header text-center bg-gradient text-white" style="background: linear-gradient(135deg, var(--success) 0%, var(--info) 100%); padding: 2rem;">
                    <i class="fas fa-lock-open fa-3x mb-3"></i>
                    <h3 class="mb-0 fw-bold">Reset Password</h3>
                    <p class="mb-0 small opacity-75">Buat Password Baru</p>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        {{-- Password Reset Token --}}
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope text-success me-2"></i>Email
                            </label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $request->email) }}" 
                                required 
                                autofocus
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock text-success me-2"></i>Password Baru
                            </label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Min. 8 karakter"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="fas fa-check-circle text-success me-2"></i>Konfirmasi Password
                            </label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="Ulangi password baru"
                                required
                            >
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg fw-semibold">
                                <i class="fas fa-save me-2"></i>Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection