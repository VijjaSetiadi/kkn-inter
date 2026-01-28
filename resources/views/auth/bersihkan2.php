@extends('layouts.app')

@section('title', 'Registrasi Mahasiswa')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-user-plus"></i> Registrasi Akun Mahasiswa</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Informasi:</strong> Silakan lengkapi data diri Anda untuk membuat akun. Setelah registrasi, Anda dapat login dan mendaftar KKN International.
                </div>

                <form method="POST" action="{{ route('register.mahasiswa') }}">
                    @csrf

                    <!-- Data Akademik -->
                    <h5 class="mb-3 text-primary"><i class="fas fa-graduation-cap"></i> Data Akademik</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NIM <span class="text-danger">*</span></label>
                            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" 
                                   value="{{ old('nim') }}" required autofocus>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Program Studi <span class="text-danger">*</span></label>
                            <select name="program_studi" class="form-select @error('program_studi') is-invalid @enderror" required>
                                <option value="">Pilih Program Studi</option>
                                <option value="Teknik Informatika" {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                                <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                                <option value="Manajemen" {{ old('program_studi') == 'Manajemen' ? 'selected' : '' }}>Manajemen</option>
                                <option value="Akuntansi" {{ old('program_studi') == 'Akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                                <option value="Hukum" {{ old('program_studi') == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                                <option value="Psikologi" {{ old('program_studi') == 'Psikologi' ? 'selected' : '' }}>Psikologi</option>
                            </select>
                            @error('program_studi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Semester <span class="text-danger">*</span></label>
                            <input type="number" name="semester" class="form-control @error('semester') is-invalid @enderror" 
                                   value="{{ old('semester') }}" min="1" max="14" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">IPK <span class="text-danger">*</span></label>
                            <input type="number" name="ipk" class="form-control @error('ipk') is-invalid @enderror" 
                                   value="{{ old('ipk') }}" step="0.01" min="0" max="4" required>
                            @error('ipk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Data Pribadi -->
                    <h5 class="mb-3 text-primary"><i class="fas fa-user"></i> Data Pribadi</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. Telepon/WA <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                                   value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx" required>
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Password -->
                    <h5 class="mb-3 text-primary"><i class="fas fa-lock"></i> Keamanan Akun</h5>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            <small class="text-muted">Minimal 8 karakter</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-lg ms-2">
                            <i class="fas fa-sign-in-alt"></i> Sudah Punya Akun? Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection