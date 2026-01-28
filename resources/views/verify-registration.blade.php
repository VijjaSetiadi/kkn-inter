<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pendaftaran KKN Internasional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#1e3a8a',
                        gold: '#fbbf24',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes spin-slow {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes fade-in {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.5; }
            100% { transform: scale(0.8); opacity: 1; }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 60s linear infinite;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .animate-pulse-ring {
            animation: pulse-ring 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 min-h-screen py-8 px-4">
    
    <!-- Floating Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[500px] text-blue-900/5 animate-spin-slow">
            <i class="fas fa-globe"></i>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-2xl mx-auto relative z-10 animate-fade-in">
        
        @if($found)
        <!-- Success Card -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-blue-900 to-blue-800 py-8 px-6 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 text-center">
                    <!-- Dynamic Icon based on Status -->
                    <div class="relative inline-block mb-4">
                        @php
                            $iconConfig = [
                                'pending' => ['color' => 'yellow', 'icon' => 'clock'],
                                'diproses' => ['color' => 'blue', 'icon' => 'sync'],
                                'diterima' => ['color' => 'green', 'icon' => 'check-circle'],
                                'ditolak' => ['color' => 'red', 'icon' => 'times-circle'],
                            ];
                            $icon = $iconConfig[$pendaftaran->status] ?? $iconConfig['pending'];
                        @endphp
                        <div class="absolute inset-0 bg-{{ $icon['color'] }}-400 rounded-full blur-xl animate-pulse-ring"></div>
                        <div class="relative w-20 h-20 bg-gradient-to-br from-{{ $icon['color'] }}-400 to-{{ $icon['color'] }}-500 rounded-full flex items-center justify-center shadow-xl animate-float">
                            <i class="fas fa-{{ $icon['icon'] }} text-white text-4xl"></i>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-white mb-1 drop-shadow-lg">
                        Status Pendaftaran
                    </h1>
                    <p class="text-white/90 text-sm font-medium">
                        Informasi pendaftaran KKN Internasional Anda
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                
                <!-- Status Badge -->
                <div class="text-center mb-6">
                    @php
                        $statusConfig = [
                            'pending' => ['bg' => 'bg-yellow-500', 'icon' => 'clock', 'text' => 'MENUNGGU VERIFIKASI'],
                            'diproses' => ['bg' => 'bg-blue-500', 'icon' => 'sync', 'text' => 'SEDANG DIPROSES'],
                            'diterima' => ['bg' => 'bg-green-500', 'icon' => 'check-circle', 'text' => 'DITERIMA'],
                            'ditolak' => ['bg' => 'bg-red-500', 'icon' => 'times-circle', 'text' => 'DITOLAK'],
                        ];
                        $config = $statusConfig[$pendaftaran->status] ?? $statusConfig['pending'];
                    @endphp
                    
                    <div class="inline-flex items-center gap-3 px-8 py-3 {{ $config['bg'] }} text-white font-bold text-lg rounded-full shadow-lg">
                        <i class="fas fa-{{ $config['icon'] }} text-xl"></i>
                        <span>{{ $config['text'] }}</span>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="space-y-3">
                    
                    <!-- Barcode -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-barcode text-blue-900"></i>
                            Kode Barcode
                        </p>
                        <p class="text-lg font-black text-blue-900 tracking-widest">{{ $pendaftaran->barcode_number }}</p>
                    </div>

                    <!-- NIM -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-id-card text-blue-900"></i>
                            NIM
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->nim }}</p>
                    </div>

                    <!-- Nama -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-user text-blue-900"></i>
                            Nama Mahasiswa
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->name }}</p>
                    </div>

                    <!-- Fakultas/Prodi -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-building text-blue-900"></i>
                            Fakultas / Program Studi
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->fakultas }} / {{ $pendaftaran->mahasiswa->program_studi }}</p>
                    </div>

                    <!-- Periode -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-blue-900"></i>
                            Periode
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->periode }}</p>
                    </div>

                    <!-- Negara Tujuan -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-globe-asia text-blue-900"></i>
                            Negara Tujuan
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->negara_tujuan }}</p>
                    </div>

                    <!-- Tanggal Pendaftaran -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-clock text-blue-900"></i>
                            Tanggal Pendaftaran
                        </p>
                        <p class="text-base font-bold text-gray-800">{{ $pendaftaran->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>

                    <!-- Status Dokumen -->
                    <div class="bg-gray-50 p-4 rounded-xl border-l-4 border-blue-900">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-folder-open text-blue-900"></i>
                            Status Dokumen
                        </p>
                        <div class="flex items-center gap-3 mt-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $pendaftaran->dokumen->count() > 0 ? ($pendaftaran->dokumen->where('status_verifikasi', 'diterima')->count() / $pendaftaran->dokumen->count()) * 100 : 0 }}%"></div>
                            </div>
                            <span class="text-base font-bold text-gray-800">
                                {{ $pendaftaran->dokumen->where('status_verifikasi', 'diterima')->count() }} / {{ $pendaftaran->dokumen->count() }} 
                                <span class="text-sm text-gray-500">Diterima</span>
                            </span>
                        </div>
                    </div>

                    @if($pendaftaran->catatan_admin)
                    <!-- Catatan Admin -->
                    <div class="bg-yellow-50 p-4 rounded-xl border-l-4 border-yellow-500">
                        <p class="text-xs font-semibold text-gray-500 uppercase mb-1 flex items-center gap-2">
                            <i class="fas fa-comment-alt text-yellow-600"></i>
                            Catatan dari Admin
                        </p>
                        <p class="text-sm font-medium text-gray-700 mt-2">{{ $pendaftaran->catatan_admin }}</p>
                    </div>
                    @endif

                </div>

                <!-- Auto Refresh Notice -->
                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                    <div class="flex items-center justify-center gap-2 text-blue-700">
                        <i class="fas fa-sync-alt animate-spin text-sm"></i>
                        <p class="text-sm font-semibold m-0">
                            Halaman akan refresh otomatis setiap <span class="font-bold">30 detik</span>
                        </p>
                    </div>
                    <p class="text-xs text-blue-600 mt-1 m-0">Untuk mendapatkan update status terbaru</p>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
                <div class="text-center">
                    <p class="text-xs text-gray-500 m-0">
                        <i class="fas fa-shield-alt text-blue-900 mr-1"></i>
                        Data terverifikasi melalui sistem KKN Internasional - Universitas Semarang
                    </p>
                </div>
            </div>

        </div>

        @else
        <!-- Error Card -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            
            <!-- Header -->
            <div class="relative bg-gradient-to-br from-red-600 to-red-700 py-8 px-6 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 text-center">
                    <!-- Error Icon -->
                    <div class="relative inline-block mb-4">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl animate-float">
                            <i class="fas fa-times-circle text-red-600 text-4xl"></i>
                        </div>
                    </div>

                    <h1 class="text-2xl font-bold text-white mb-1 drop-shadow-lg">
                        Verifikasi Gagal
                    </h1>
                    <p class="text-white/90 text-sm font-medium">
                        Data pendaftaran tidak ditemukan dalam sistem
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <div class="text-center">
                    <!-- Warning Icon -->
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-yellow-100 rounded-full mb-6">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl"></i>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $message }}</h2>
                    <p class="text-gray-600 mb-6">
                        Silakan periksa kembali kode barcode Anda atau hubungi admin jika masalah berlanjut.
                    </p>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 text-left">
                        <p class="font-semibold text-blue-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            Kemungkinan Penyebab:
                        </p>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-circle text-blue-500 text-xs mt-1.5"></i>
                                <span>Kode barcode salah atau tidak valid</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-circle text-blue-500 text-xs mt-1.5"></i>
                                <span>Pendaftaran belum terdaftar dalam sistem</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-circle text-blue-500 text-xs mt-1.5"></i>
                                <span>Link verifikasi sudah kadaluarsa</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-sm font-semibold text-gray-700 mb-3">Butuh Bantuan?</p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="tel:0241234567" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800 transition-colors">
                                <i class="fas fa-phone"></i>
                                <span>(024) 1234567</span>
                            </a>
                            <a href="mailto:international@usm.ac.id" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border-2 border-blue-900 text-blue-900 font-semibold rounded-lg hover:bg-blue-900 hover:text-white transition-colors">
                                <i class="fas fa-envelope"></i>
                                <span>international@usm.ac.id</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @endif

    </div>

    @if($found)
    <script>
        // Auto refresh setiap 30 detik
        setTimeout(function() {
            location.reload();
        }, 30000);
    </script>
    @endif

</body>
</html>