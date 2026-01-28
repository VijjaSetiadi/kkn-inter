@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-file-alt"></i> Detail Status Pendaftaran KKN International</h4>
            </div>
            <div class="card-body p-4">
                <!-- Status Badge -->
                <div class="text-center mb-4">
                    <h5>Status Pendaftaran:</h5>
                    <h3>{!! $pendaftaran->status_badge !!}</h3>
                    @if($pendaftaran->status == 'pending')
                        <p class="text-muted">Pendaftaran Anda sedang menunggu verifikasi</p>
                    @elseif($pendaftaran->status == 'diproses')
                        <p class="text-muted">Pendaftaran Anda sedang dalam proses seleksi</p>
                    @elseif($pendaftaran->status == 'diterima')
                        <p class="text-success"><i class="fas fa-check-circle"></i> Selamat! Pendaftaran Anda diterima</p>
                    @elseif($pendaftaran->status == 'ditolak')
                        <p class="text-danger"><i class="fas fa-times-circle"></i> Maaf, pendaftaran Anda ditolak</p>
                    @endif
                </div>

                <hr>

                <!-- Data Mahasiswa -->
                <h5 class="mb-3"><i class="fas fa-user"></i> Data Mahasiswa</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>NIM</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->nim }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->email }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Program Studi</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->program_studi }}</td>
                            </tr>
                            <tr>
                                <td><strong>Semester</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->semester }}</td>
                            </tr>
                            <tr>
                                <td><strong>IPK</strong></td>
                                <td>: {{ $pendaftaran->mahasiswa->ipk }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <!-- Data KKN International -->
                <h5 class="mb-3"><i class="fas fa-globe"></i> Data KKN International</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="180"><strong>No. Pendaftaran</strong></td>
                                <td>: <span class="badge bg-primary">{{ $pendaftaran->id }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Periode</strong></td>
                                <td>: {{ $pendaftaran->periode }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Daftar</strong></td>
                                <td>: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d F Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="180"><strong>Negara Tujuan</strong></td>
                                <td>: <span class="badge bg-info">{{ $pendaftaran->negara_tujuan }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Universitas Tujuan</strong></td>
                                <td>: {{ $pendaftaran->universitas_tujuan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Motivasi -->
                <div class="mb-4">
                    <strong>Motivasi:</strong>
                    <div class="card mt-2">
                        <div class="card-body bg-light">
                            <p class="mb-0">{{ $pendaftaran->motivasi }}</p>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Dokumen -->
                <h5 class="mb-3"><i class="fas fa-file-upload"></i> Dokumen Pendukung</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Jenis Dokumen</th>
                                <th>Nama File</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftaran->dokumen as $index => $dok)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary">{{ $dok->jenis_dokumen_formatted }}</span>
                                </td>
                                <td>{{ $dok->nama_file }}</td>
                                <td>
                                    <a href="{{ route('pendaftaran.download-dokumen', $dok->id) }}" 
                                       class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada dokumen</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Catatan Admin -->
                @if($pendaftaran->catatan_admin)
                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading"><i class="fas fa-sticky-note"></i> Catatan dari Admin:</h6>
                    <p class="mb-0">{{ $pendaftaran->catatan_admin }}</p>
                </div>
                @endif

                <!-- Info Tambahan berdasarkan Status -->
                @if($pendaftaran->status == 'pending')
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i>
                    Pendaftaran Anda sedang menunggu verifikasi dari tim admin. Mohon tunggu 3-5 hari kerja.
                </div>
                @elseif($pendaftaran->status == 'diproses')
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-spinner fa-spin"></i>
                    Pendaftaran Anda sedang dalam proses seleksi. Hasil akan diumumkan sesuai jadwal.
                </div>
                @elseif($pendaftaran->status == 'diterima')
                <div class="alert alert-success" role="alert">
                    <h6 class="alert-heading"><i class="fas fa-check-circle"></i> Selamat!</h6>
                    <p>Pendaftaran Anda telah diterima untuk KKN International di {{ $pendaftaran->universitas_tujuan }}, {{ $pendaftaran->negara_tujuan }}.</p>
                    <hr>
                    <p class="mb-0">
                        <strong>Langkah Selanjutnya:</strong><br>
                        1. Cek email untuk instruksi lebih lanjut<br>
                        2. Siapkan dokumen tambahan jika diperlukan<br>
                        3. Tunggu informasi jadwal pembekalan<br>
                        4. Persiapkan visa dan akomodasi
                    </p>
                </div>
                @elseif($pendaftaran->status == 'ditolak')
                <div class="alert alert-danger" role="alert">
                    <h6 class="alert-heading"><i class="fas fa-times-circle"></i> Pendaftaran Ditolak</h6>
                    <p class="mb-0">Mohon maaf, pendaftaran Anda tidak dapat kami proses. Anda dapat mendaftar kembali pada periode berikutnya dengan memperhatikan catatan dari admin.</p>
                </div>
                @endif

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i> Cetak
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary ms-2">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@media print {
    .navbar, .footer, .btn {
        display: none !important;
    }
}
</style>
@endpush
@endsection