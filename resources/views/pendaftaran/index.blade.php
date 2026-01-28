@extends('layouts.app')

@section('title', 'Pendaftaran KKN International')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-info-circle"></i> Informasi Pendaftaran KKN International</h4>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-info" role="alert">
                    <h5 class="alert-heading"><i class="fas fa-exclamation-circle"></i> Perhatian!</h5>
                    <p class="mb-0">Pastikan semua data yang Anda masukkan sudah benar dan lengkap. Dokumen yang diupload harus jelas dan sesuai dengan persyaratan.</p>
                </div>

                <h5 class="mb-3">Persyaratan Pendaftaran KKN International</h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-primary">Persyaratan Akademik:</h6>
                        <ul>
                        <li>Mahasiswa aktif Universitas Semarang</li>
                        <li>Telah menempuh minimal semester 6</li>
                        <li>IPK minimal 3.00</li>
                        <li>Telah menempuh minimal 110 SKS</li>
                        <li>Tidak sedang menjalani sanksi akademik</li>
                        <li>Sehat jasmani dan rohani</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">Persyaratan Khusus:</h6>
                    <ul>
                        <li>Memiliki sertifikat bahasa Inggris (TOEFL min. 500/IELTS min. 5.5) atau bahasa negara tujuan</li>
                        <li>Memiliki passport yang masih berlaku minimal 6 bulan</li>
                        <li>Surat rekomendasi dari dosen pembimbing akademik</li>
                        <li>Surat izin orang tua/wali</li>
                        <li>Surat keterangan sehat dari dokter</li>
                        <li>Mampu berkomunikasi dalam bahasa Inggris</li>
                    </ul>
                </div>
            </div>

            <h5 class="mb-3">Dokumen yang Harus Disiapkan</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Jenis Dokumen</th>
                            <th>Format</th>
                            <th>Ukuran Maks</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>KTP/Identitas</td>
                            <td>PDF/JPG/PNG</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>KHS Terakhir</td>
                            <td>PDF/JPG/PNG</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Transkrip Nilai</td>
                            <td>PDF/JPG/PNG</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Sertifikat Bahasa (TOEFL/IELTS)</td>
                            <td>PDF/JPG/PNG</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Passport</td>
                            <td>PDF/JPG/PNG</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Surat Rekomendasi Dosen</td>
                            <td>PDF</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Surat Izin Orang Tua</td>
                            <td>PDF</td>
                            <td>5 MB</td>
                            <td>Wajib</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h5 class="mb-3">Jadwal Pendaftaran</h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Periode 2024/2025 - Semester 1</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Pendaftaran:</strong> 1 Januari - 31 Januari 2025</p>
                            <p class="mb-1"><strong>Seleksi:</strong> 1 Februari - 15 Februari 2025</p>
                            <p class="mb-0"><strong>Pengumuman:</strong> 20 Februari 2025</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Periode 2024/2025 - Semester 2</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Pendaftaran:</strong> 1 Juli - 31 Juli 2025</p>
                            <p class="mb-1"><strong>Seleksi:</strong> 1 Agustus - 15 Agustus 2025</p>
                            <p class="mb-0"><strong>Pengumuman:</strong> 20 Agustus 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning" role="alert">
                <h6 class="alert-heading"><i class="fas fa-lightbulb"></i> Tips Pendaftaran:</h6>
                <ul class="mb-0">
                    <li>Pastikan semua dokumen dalam kondisi jelas dan terbaca</li>
                    <li>Sertifikat bahasa harus masih berlaku</li>
                    <li>Passport harus memiliki masa berlaku minimal 6 bulan</li>
                    <li>Tulis motivasi dengan jujur dan menarik (minimal 100 karakter)</li>
                    <li>Periksa kembali semua data sebelum mengirim</li>
                    <li>Simpan nomor pendaftaran Anda untuk pengecekan status</li>
                    <li>Cek email secara berkala untuk informasi lebih lanjut</li>
                </ul>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-edit me-2"></i> Mulai Pendaftaran
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary btn-lg ms-2">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection