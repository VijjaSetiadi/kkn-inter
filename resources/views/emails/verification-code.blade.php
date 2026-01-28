<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi - KKN International</title>
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
            transform: rotate(15deg);
        }
        .header::after {
            content: '✈️';
            position: absolute;
            bottom: -10px;
            left: -10px;
            font-size: 80px;
            opacity: 0.1;
            transform: rotate(-15deg);
        }
        .header h1 {
            color: #ffffff;
            margin: 0 0 8px 0;
            font-size: 28px;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }
        .header .subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        .globe-icon {
            font-size: 50px;
            margin-bottom: 15px;
            animation: spin 20s linear infinite;
            display: inline-block;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .language-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
            position: relative;
            z-index: 1;
        }
        .language-icons span {
            font-size: 20px;
            animation: float 2s ease-in-out infinite;
        }
        .language-icons span:nth-child(1) { animation-delay: 0s; }
        .language-icons span:nth-child(2) { animation-delay: 0.3s; }
        .language-icons span:nth-child(3) { animation-delay: 0.6s; }
        .language-icons span:nth-child(4) { animation-delay: 0.9s; }
        .language-icons span:nth-child(5) { animation-delay: 1.2s; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .content {
            padding: 40px 30px;
            line-height: 1.8;
            color: #374151;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 15px;
        }
        .content p {
            margin: 12px 0;
            font-size: 15px;
        }
        .verification-box {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 2px dashed #1e3a8a;
            border-radius: 10px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
        }
        .verification-label {
            font-size: 14px;
            color: #1e40af;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .verification-code {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: #ffffff;
            font-size: 42px;
            font-weight: bold;
            padding: 20px 40px;
            border-radius: 8px;
            letter-spacing: 8px;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
            font-family: 'Courier New', monospace;
        }
        .expiry-box {
            background-color: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 6px;
        }
        .expiry-box p {
            margin: 0;
            color: #991b1b;
            font-weight: 600;
            font-size: 14px;
        }
        .expiry-box .time {
            color: #dc2626;
            font-size: 16px;
            font-weight: bold;
        }
        .info-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 6px;
        }
        .info-box p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }
        .stamp {
            display: inline-block;
            border: 3px solid #1e3a8a;
            color: #1e3a8a;
            padding: 8px 20px;
            font-weight: bold;
            font-size: 12px;
            transform: rotate(-5deg);
            opacity: 0.3;
            margin: 20px 0;
            letter-spacing: 2px;
        }
        .footer {
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
            padding: 30px;
            text-align: center;
        }
        .footer-logo {
            font-size: 24px;
            color: #1e3a8a;
            margin-bottom: 10px;
        }
        .footer p {
            color: #6b7280;
            font-size: 13px;
            margin: 5px 0;
            line-height: 1.6;
        }
        .footer .copyright {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="globe-icon">🌍</div>
            <h1>KKN International</h1>
            <p class="subtitle">Universitas Semarang</p>
            <div class="language-icons">
                <span>✈️</span>
                <span>🌏</span>
                <span>🛫</span>
                <span>🌎</span>
                <span>🛬</span>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="greeting">Selamat Datang! Welcome! 👋</p>
            
            <p>Terima kasih telah mendaftar di <strong>KKN International</strong> - Universitas Semarang!</p>
            
            <p>Untuk melanjutkan proses pendaftaran, gunakan kode verifikasi berikut:</p>
            
            <!-- Verification Code Box -->
            <div class="verification-box">
                <div class="verification-label">🔐 Kode Verifikasi Anda</div>
                <div class="verification-code">{{ $verificationCode }}</div>
            </div>

            <!-- Stamp Effect -->
            <center>
                <div class="stamp">INTERNATIONAL VERIFIED</div>
            </center>

            <!-- Expiry Warning -->
            <div class="expiry-box">
                <p>⏰ <strong>Penting:</strong> Kode ini berlaku hingga:</p>
                <p class="time">📅 {{ $verificationExpiry }}</p>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p>💡 <strong>Catatan:</strong> Jika Anda tidak melakukan pendaftaran ini, abaikan email ini. Akun Anda tetap aman.</p>
            </div>

            <p style="margin-top: 30px;">
                <strong>Salam Hangat,</strong><br>
                <span style="color: #1e3a8a; font-weight: 600;">Tim KKN International</span><br>
                <span style="color: #6b7280; font-size: 14px;">Universitas Semarang</span>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo">🌍 ✈️ 🌏</div>
            <p><strong>KKN International Office</strong></p>
            <p>Universitas Semarang</p>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} KKN International - Universitas Semarang</p>
                <p>All rights reserved | Hak Cipta Dilindungi</p>
            </div>
        </div>
    </div>
</body>
</html>