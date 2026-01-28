<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftar Baru KKN International</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px;
        }
        .alert-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .alert-box h3 {
            margin-top: 0;
            color: #856404;
        }
        .info-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
        }
        .info-table tr {
            border-bottom: 1px solid #dee2e6;
        }
        .info-table tr:last-child {
            border-bottom: none;
        }
        .info-table td {
            padding: 12px 15px;
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
            color: #666;
            background: #e9ecef;
        }
        .info-table td:last-child {
            color: #333;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-warning {
            background: #ffc107;
            color: #000;
        }
        .badge-success {
            background: #28a745;
            color: white;
        }
        .badge-info {
            background: #17a2b8;
            color: white;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 2px solid #dee2e6;
        }
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            margin: 5px 0;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            opacity: 0.9;
        }
        .button-secondary {
            background: #6c757d;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #667eea, transparent);
            margin: 20px 0;
        }
        .dokumen-list {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .dokumen-item {
            padding: 8px 0;
            border-bottom: 1px dashed #dee2e6;
        }
        .dokumen-item:last-child {
            border-bottom: none;
        }
        .priority-high {
            background: #fff3cd;
            border: 2px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">🔔</div>
            <h1>Pendaftar Baru!</h1>
            <p style="margin: 10px 0 0 0;">KKN International</p>
        </div>

        <div class="content">
            <div class="priority-high">
                <h2 style="margin: 0 0 10px 0; color: #856404;">⚡ Perhatian Admin</h2>
                <p style="margin: 0; font-size: 16px;">
                    Ada pendaftar baru yang memerlukan verifikasi segera!
                </p>
            </div>

            <h3 style="color: #667eea; margin-bottom: 5px;">
                👤 Data Mahasiswa
            </h3>
            <table class="info-table">
                <tr>
                    <td>No. Pendaftaran</td>
                    <td><strong>#{{ $pendaftaran->id }}</strong></td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td><strong>{{ $pendaftaran->mahasiswa->nim }}</strong></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td><strong>{{ $pendaftaran->mahasiswa->name }}</strong></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $pendaftaran->mahasiswa->email }}</td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>{{ $pendaftaran->mahasiswa->no_telepon ?? $pendaftaran->mahasiswa->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Fakultas</td>
                    <td>{{ $pendaftaran->mahasiswa->fakultas ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>{{ $pendaftaran->mahasiswa->program_studi ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>{{ $pendaftaran->mahasiswa->semester ?? '-' }}</td>
                </tr>
                <tr>
                    <td>IPK</td>
                    <td><strong>{{ $pendaftaran->mahasiswa->ipk ?? '-' }}</strong></td>
                </tr>
            </table>

            <div class="divider"></div>

            <h3 style="color: #667eea; margin-bottom: 5px;">
                🌍 Detail Pendaftaran KKN
            </h3>
            <table class="info-table">
                <tr>
                    <td>Periode</td>
                    <td><span class="badge badge-info">{{ $pendaftaran->periode }}</span></td>
                </tr>
                <tr>
                    <td>Negara Tujuan</td>
                    <td><span class="badge badge-success">{{ $pendaftaran->negara_tujuan }}</span></td>
                </tr>
                <tr>
                    <td>Waktu Daftar</td>
                    <td>{{ $pendaftaran->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><span class="badge badge-warning">⏳ Pending - Menunggu Verifikasi</span></td>
                </tr>
            </table>

            <div class="divider"></div>

            <h3 style="color: #667eea; margin-bottom: 10px;">
                💭 Motivasi Mahasiswa
            </h3>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; border-left: 4px solid #667eea;">
                <p style="margin: 0; text-align: justify; font-style: italic; color: #555;">
                    "{{ $pendaftaran->motivasi }}"
                </p>
            </div>

            <div class="divider"></div>

            <h3 style="color: #667eea; margin-bottom: 10px;">
                📄 Dokumen yang Diupload ({{ $pendaftaran->dokumen->count() }})
            </h3>
            <div class="dokumen-list">
                @php
                    $jenisLabel = [
                        'ktp' => 'KTP',
                        'khs' => 'KHS Terakhir',
                        'transkrip' => 'Transkrip Nilai',
                        'sertifikat_bahasa' => 'Sertifikat Bahasa',
                        'passport' => 'Passport',
                        'surat_rekomendasi' => 'Surat Rekomendasi',
                        'surat_izin_ortu' => 'Surat Izin Ortu',
                        'pas_foto' => 'Pas Foto 3x4',
                        'lainnya' => 'Lainnya'
                    ];
                @endphp
                @forelse($pendaftaran->dokumen as $index => $dok)
                    <div class="dokumen-item">
                        <strong>{{ $index + 1 }}. {{ $jenisLabel[$dok->jenis_dokumen] ?? ucwords(str_replace('_', ' ', $dok->jenis_dokumen)) }}</strong>
                        <br>
                        <small style="color: #666;">📎 {{ $dok->nama_file }}</small>
                    </div>
                @empty
                    <p style="text-align: center; color: #999; margin: 10px 0;">Tidak ada dokumen</p>
                @endforelse
            </div>

            <div class="alert-box">
                <h3>⚠️ Tindakan Diperlukan</h3>
                <p style="margin: 5px 0 0 0;">
                    Silakan login ke dashboard admin untuk memverifikasi dokumen dan mengubah status pendaftaran.
                </p>
            </div>

            <!-- Action Buttons -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="button">
                    👁️ Lihat Detail & Verifikasi
                </a>
                <br>
                <a href="{{ route('admin.dashboard') }}" class="button button-secondary" style="margin-top: 10px;">
                    📊 Dashboard Admin
                </a>
            </div>

            <div class="divider"></div>

            <!-- Quick Stats -->
            <h3 style="color: #667eea; text-align: center; margin-bottom: 15px;">
                📊 Statistik Hari Ini
            </h3>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ \App\Models\PendaftaranKkn::whereDate('created_at', today())->count() }}</div>
                    <div class="stat-label">Pendaftar Hari Ini</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ \App\Models\PendaftaranKkn::where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Menunggu Verifikasi</div>
                </div>
            </div>

            <p style="color: #666; font-size: 14px; margin-top: 30px; text-align: center;">
                💡 <strong>Tips:</strong> Verifikasi pendaftaran secepat mungkin untuk meningkatkan kepuasan mahasiswa
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0;"><strong>Sistem KKN International</strong></p>
            <p style="margin: 5px 0;">Universitas Semarang</p>
            <p style="margin: 5px 0; font-size: 12px; color: #999;">
                Email ini dikirim secara otomatis oleh sistem
            </p>
        </div>
    </div>
</body>
</html>