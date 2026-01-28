<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pendaftaran - KKN International</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f9fafb 0%, #dbeafe 50%, #f3f4f6 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '🌍';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
        }
        .globe-icon {
            font-size: 50px;
            margin-bottom: 10px;
            animation: spin 20s linear infinite;
            display: inline-block;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin: 8px 0 0 0;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 20px;
        }
        .content p {
            color: #374151;
            line-height: 1.8;
            margin: 12px 0;
            font-size: 15px;
        }

        /* Status Boxes */
        .status-box {
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: center;
        }
        .status-diterima {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border: 2px solid #10b981;
        }
        .status-ditolak {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #ef4444;
        }
        .status-diproses {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 2px solid #3b82f6;
        }
        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 2px solid #f59e0b;
        }
        .status-icon {
            font-size: 60px;
            margin-bottom: 15px;
        }
        .status-text {
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-diterima .status-text { color: #065f46; }
        .status-ditolak .status-text { color: #991b1b; }
        .status-diproses .status-text { color: #1e40af; }
        .status-pending .status-text { color: #92400e; }

        .status-subtitle {
            font-size: 14px;
            margin: 10px 0 0 0;
            opacity: 0.8;
        }

        /* Info Table */
        .info-card {
            background: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #6b7280;
            font-size: 14px;
        }
        .info-value {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
        }

        /* Catatan Box */
        .note-box {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 25px 0;
            border-radius: 6px;
        }
        .note-box h3 {
            color: #92400e;
            margin: 0 0 10px 0;
            font-size: 16px;
        }
        .note-box p {
            color: #78350f;
            margin: 0;
            font-size: 14px;
        }

        /* Next Steps Box */
        .steps-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .steps-box h4 {
            color: #1e40af;
            margin: 0 0 15px 0;
            font-size: 16px;
        }
        .steps-box ul {
            margin: 0;
            padding-left: 20px;
            color: #1e3a8a;
        }
        .steps-box li {
            margin: 8px 0;
            font-size: 14px;
        }

        /* Button */
        .button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 25px 0;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
            transition: all 0.3s ease;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }

        /* Footer */
        .footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 30px;
            text-align: center;
        }
        .footer-logo {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .footer p {
            color: #6b7280;
            font-size: 13px;
            margin: 5px 0;
        }
        .footer .copyright {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to right, transparent, #1e3a8a, transparent);
            margin: 30px 0;
            opacity: 0.2;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="globe-icon">🌍</div>
            <h1>Status Update</h1>
            <p class="subtitle">KKN International - Universitas Semarang</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Halo, {{ $pendaftaran->mahasiswa->name }}! 👋</p>
            
            <p>Status pendaftaran KKN International Anda telah diperbarui.</p>

            <!-- Status Box -->
            @if($statusBaru == 'diterima')
                <div class="status-box status-diterima">
                    <div class="status-icon">🎉</div>
                    <div class="status-text">SELAMAT! ANDA DITERIMA</div>
                    <p class="status-subtitle">Pendaftaran Anda telah disetujui</p>
                </div>
            @elseif($statusBaru == 'ditolak')
                <div class="status-box status-ditolak">
                    <div class="status-icon">😔</div>
                    <div class="status-text">PENDAFTARAN DITOLAK</div>
                    <p class="status-subtitle">Mohon maaf, pendaftaran tidak dapat diproses</p>
                </div>
            @elseif($statusBaru == 'diproses')
                <div class="status-box status-diproses">
                    <div class="status-icon">⚙️</div>
                    <div class="status-text">SEDANG DIPROSES</div>
                    <p class="status-subtitle">Pendaftaran Anda dalam tahap seleksi</p>
                </div>
            @else
                <div class="status-box status-pending">
                    <div class="status-icon">⏳</div>
                    <div class="status-text">{{ strtoupper($statusBaru) }}</div>
                </div>
            @endif

            <div class="divider"></div>

            <!-- Detail Pendaftaran -->
            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">🎫 No. Pendaftaran</span>
                    <span class="info-value">#{{ $pendaftaran->id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🎓 NIM</span>
                    <span class="info-value">{{ $pendaftaran->mahasiswa->nim }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📅 Periode</span>
                    <span class="info-value">{{ $pendaftaran->periode }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">🌏 Negara Tujuan</span>
                    <span class="info-value">{{ $pendaftaran->negara_tujuan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">📊 Status</span>
                    <span class="info-value" style="color: 
                        @if($statusBaru == 'diterima') #10b981
                        @elseif($statusBaru == 'ditolak') #ef4444
                        @elseif($statusBaru == 'diproses') #3b82f6
                        @else #f59e0b
                        @endif
                    ">{{ ucfirst($statusBaru) }}</span>
                </div>
            </div>

            <!-- Catatan Admin -->
            @if($catatanAdmin)
            <div class="note-box">
                <h3>📝 Catatan Admin</h3>
                <p>{{ $catatanAdmin }}</p>
            </div>
            @endif

            <!-- Langkah Selanjutnya -->
            @if($statusBaru == 'diterima')
                <div class="steps-box">
                    <h4>✅ Langkah Selanjutnya</h4>
                    <ul>
                        <li>Login ke dashboard untuk detail program</li>
                        <li>Siapkan dokumen yang diperlukan</li>
                        <li>Hubungi admin jika ada pertanyaan</li>
                    </ul>
                </div>
            @elseif($statusBaru == 'ditolak')
                <div class="note-box">
                    <h3>💡 Informasi</h3>
                    <p>Anda dapat mendaftar kembali pada periode berikutnya. Pastikan melengkapi semua persyaratan dengan benar.</p>
                </div>
            @elseif($statusBaru == 'diproses')
                <div class="steps-box">
                    <h4>⏰ Informasi</h4>
                    <ul>
                        <li>Proses seleksi memerlukan waktu 3-7 hari kerja</li>
                        <li>Kami akan mengirim notifikasi jika ada update</li>
                    </ul>
                </div>
            @endif

            <!-- Button -->
            <center>
                <a href="{{ route('mahasiswa.pendaftaran.show', $pendaftaran->id) }}" class="button">
                    📋 Lihat Detail Pendaftaran
                </a>
            </center>

            <div class="divider"></div>

            <p style="color: #6b7280; font-size: 14px; text-align: center;">
                Pertanyaan? Hubungi admin melalui dashboard Anda.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🌍 ✈️ 🌏</div>
            <p><strong>KKN International Office</strong></p>
            <p>Universitas Semarang</p>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} KKN International - Universitas Semarang</p>
                <p>Email otomatis - Mohon tidak membalas</p>
            </div>
        </div>
    </div>
</body>
</html>