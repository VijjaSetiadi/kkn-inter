<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran KKN Internasional - {{ $pendaftaran->mahasiswa->nim }}</title>
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
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        @media print {
            body {
                background: white !important;
            }
            .no-print {
                display: none !important;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 min-h-screen py-8 px-4">
    
    <!-- Floating Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-5">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[400px] text-blue-900 animate-spin-slow">
            <i class="fas fa-globe"></i>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-4xl mx-auto relative z-10">
        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            
            <!-- Decorative Stamps -->
            <div class="absolute -top-2 -right-2 px-4 py-2 bg-white border-2 border-blue-900 rounded text-xs font-bold text-blue-900 transform rotate-12 opacity-15 z-0">
                INTERNATIONAL
            </div>
            <div class="absolute -bottom-2 -left-2 px-4 py-2 bg-white border-2 border-blue-900 rounded text-xs font-bold text-blue-900 transform -rotate-12 opacity-15 z-0">
                INTERNATIONAL
            </div>

            <!-- Header -->
            <div class="relative bg-gradient-to-br from-blue-900 to-blue-800 py-10 px-8 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-xl animate-float">
                        <i class="fas fa-globe text-white text-4xl"></i>
                    </div>

                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-white mb-1 drop-shadow-lg">
                            BUKTI PENDAFTARAN
                        </h1>
                        <p class="text-white/90 text-base font-medium">
                            Program KKN Internasional - Universitas Semarang
                        </p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-8 relative z-10">
                
                <!-- QR Code Section -->
                <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl p-8 mb-8 text-center overflow-hidden relative">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-white rounded-full blur-2xl"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="inline-block bg-white p-8 rounded-2xl shadow-2xl mb-6">
                            <img src="{{ $qrcode }}" alt="QR Code" class="w-56 h-56 mx-auto">
                        </div>

                        <div class="bg-white/20 backdrop-blur-sm inline-block px-12 py-4 rounded-xl mb-4">
                            <p class="text-3xl font-black text-white tracking-[0.4em]">
                                {{ $pendaftaran->barcode_number }}
                            </p>
                        </div>

                        <p class="text-white text-base font-semibold">
                            <i class="fas fa-mobile-screen-button mr-2 text-lg"></i>
                            Scan QR Code untuk melihat status pendaftaran tanpa login ke portal
                        </p>
                    </div>
                </div>

                <!-- Student Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-user-graduate text-blue-900"></i>
                        Data Mahasiswa
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NIM -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-id-card mr-1"></i> NIM
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->nim }}</p>
                        </div>

                        <!-- Nama -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-user mr-1"></i> Nama Lengkap
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->name }}</p>
                        </div>

                        <!-- Email -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-envelope mr-1"></i> Email
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->email }}</p>
                        </div>

                        <!-- Fakultas -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-building mr-1"></i> Fakultas
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->fakultas }}</p>
                        </div>

                        <!-- Program Studi -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-graduation-cap mr-1"></i> Program Studi
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->mahasiswa->program_studi }}</p>
                        </div>

                        <!-- Periode -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i> Periode
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->periode }}</p>
                        </div>

                        <!-- Negara Tujuan -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-globe-asia mr-1"></i> Negara Tujuan
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->negara_tujuan }}</p>
                        </div>

                        <!-- Tanggal -->
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-1">
                                <i class="fas fa-clock mr-1"></i> Tanggal Pendaftaran
                            </p>
                            <p class="text-base font-bold text-gray-800">{{ $pendaftaran->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>

                        <!-- Status -->
                        <div class="col-span-full bg-gray-50 p-4 rounded-lg border-l-4 border-blue-900">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-2">
                                <i class="fas fa-info-circle mr-1"></i> Status Pendaftaran
                            </p>
                            @php
                                $statusConfig = [
                                    'pending' => ['bg' => 'bg-yellow-500', 'text' => 'MENUNGGU VERIFIKASI'],
                                    'diproses' => ['bg' => 'bg-blue-500', 'text' => 'SEDANG DIPROSES'],
                                    'diterima' => ['bg' => 'bg-green-500', 'text' => 'DITERIMA'],
                                    'ditolak' => ['bg' => 'bg-red-500', 'text' => 'DITOLAK'],
                                ];
                                $config = $statusConfig[$pendaftaran->status] ?? $statusConfig['pending'];
                            @endphp
                            
                            <span class="inline-flex items-center gap-2 px-5 py-2 {{ $config['bg'] }} text-white font-bold text-sm rounded-full">
                                <i class="fas fa-circle text-xs"></i>
                                {{ $config['text'] }}
                            </span>
                        </div>

                        @if($pendaftaran->catatan_admin)
                        <!-- Catatan Admin -->
                        <div class="col-span-full bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-500">
                            <p class="text-xs font-semibold text-gray-500 uppercase mb-2">
                                <i class="fas fa-comment-alt mr-1"></i> Catatan dari Admin
                            </p>
                            <p class="text-sm font-medium text-gray-700">{{ $pendaftaran->catatan_admin }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-folder-open text-blue-900"></i>
                        Dokumen Pendaftaran
                        <span class="text-sm text-gray-500 font-normal">({{ $pendaftaran->dokumen->count() }})</span>
                    </h2>

                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                        @forelse($pendaftaran->dokumen as $dok)
                        <div class="bg-white p-4 rounded-lg mb-3 last:mb-0 border-l-4 
                            @if($dok->status_verifikasi == 'diterima') border-green-500 
                            @elseif($dok->status_verifikasi == 'ditolak') border-red-500 
                            @else border-yellow-500 @endif
                            flex items-center justify-between">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 
                                    @if($dok->status_verifikasi == 'diterima') bg-green-500 
                                    @elseif($dok->status_verifikasi == 'ditolak') bg-red-500 
                                    @else bg-yellow-500 @endif
                                    rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">
                                        {{ $loop->iteration }}. {{ $dok->jenis_dokumen }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        Diunggah: {{ $dok->created_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 font-bold text-xs
                                @if($dok->status_verifikasi == 'diterima') text-green-600 
                                @elseif($dok->status_verifikasi == 'ditolak') text-red-600 
                                @else text-yellow-600 @endif">
                                @if($dok->status_verifikasi == 'diterima')
                                    <i class="fas fa-check-circle"></i>
                                    <span>Diterima</span>
                                @elseif($dok->status_verifikasi == 'ditolak')
                                    <i class="fas fa-times-circle"></i>
                                    <span>Ditolak</span>
                                @else
                                    <i class="fas fa-clock"></i>
                                    <span>Menunggu</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <i class="fas fa-inbox text-5xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">Belum ada dokumen yang diunggah</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Verification Info -->
                <div class="bg-blue-50 rounded-xl p-6 border-2 border-dashed border-blue-300">
                    <div class="text-center">
                        <div class="inline-flex items-center gap-2 bg-blue-900 px-5 py-2 rounded-full mb-4">
                            <i class="fas fa-shield-alt text-yellow-400"></i>
                            <span class="font-bold text-white">VERIFIKASI DOKUMEN</span>
                        </div>
                        
                        <p class="text-gray-700 font-medium text-sm mb-3">
                            Scan QR Code untuk melihat status pendaftaran tanpa login atau kunjungi:
                        </p>
                        
                        <div class="bg-white rounded-lg px-4 py-3 inline-block border border-blue-200">
                            <code class="font-mono font-bold text-blue-900 text-xs">
                                {{ url('/verify-registration/' . $pendaftaran->barcode_number) }}
                            </code>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <div class="bg-gray-100 px-8 py-6 border-t-2 border-blue-900">
                <div class="text-center space-y-2">
                    <p class="text-sm text-gray-600 font-medium">
                        <i class="fas fa-print text-blue-900 mr-1"></i>
                        Dokumen dicetak pada: {{ now()->format('d F Y, H:i') }} WIB
                    </p>
                    <p class="text-xs text-gray-500">
                        © {{ date('Y') }} Sistem Informasi KKN Internasional - Universitas Semarang
                    </p>
                </div>
            </div>

            <!-- Print Button -->
            <div class="p-6 bg-gray-50 border-t no-print">
                <button 
                    onclick="window.print()" 
                    class="w-full bg-gradient-to-r from-blue-900 to-blue-800 hover:from-blue-800 hover:to-blue-700 text-white font-bold text-base py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3">
                    <i class="fas fa-print text-xl"></i>
                    <span>Cetak Bukti Pendaftaran</span>
                </button>
            </div>

        </div>
    </div>

</body>
</html>