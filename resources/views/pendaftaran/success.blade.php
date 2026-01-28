@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<!-- Animated Background Wrapper -->
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 relative overflow-hidden py-8 px-4">
    <!-- Animated Particles -->
    @for($i = 1; $i <= 8; $i++)
    <span class="absolute w-1.5 h-1.5 bg-gradient-to-br from-blue-900 to-yellow-400 rounded-full opacity-0 animate-float-particle" 
          style="left: {{ $i * 12 }}%; animation-delay: {{ $i * 2 }}s; animation-duration: {{ 18 + $i * 2 }}s;"></span>
    @endfor

    <!-- Floating World Map Background -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <i class="fas fa-globe text-[350px] text-blue-900 opacity-5 animate-spin-slow"></i>
    </div>

    <!-- Floating Icons -->
    <div class="absolute inset-0 pointer-events-none">
        <i class="fas fa-check-circle absolute top-[10%] left-[10%] text-4xl text-green-600 opacity-15 animate-float"></i>
        <i class="fas fa-trophy absolute top-[15%] right-[15%] text-3xl text-yellow-500 opacity-15 animate-float" style="animation-delay: 1s;"></i>
        <i class="fas fa-graduation-cap absolute bottom-[20%] left-[8%] text-4xl text-blue-900 opacity-15 animate-float" style="animation-delay: 2s;"></i>
        <i class="fas fa-passport absolute bottom-[15%] right-[12%] text-3xl text-blue-900 opacity-15 animate-float" style="animation-delay: 3s;"></i>
    </div>

    <!-- Main Container -->
    <div class="max-w-6xl mx-auto relative z-10 animate-fade-in-up">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 hover:shadow-3xl transition-all duration-300">
            <!-- Success Icon & Title -->
            <div class="text-center p-8 md:p-12">
                <!-- Animated Success Icon -->
                <div class="mb-6 animate-scale-in">
                    <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full shadow-2xl">
                        <i class="fas fa-check-circle text-6xl md:text-7xl text-white"></i>
                    </div>
                </div>
                
                <!-- Title -->
                <h2 class="text-3xl md:text-4xl font-bold text-green-600 mb-3">
                    Pendaftaran Berhasil!
                </h2>
                
                <!-- Subtitle -->
                <p class="text-lg md:text-xl text-gray-600 mb-2">
                    Terima kasih telah mendaftar KKN International
                </p>
                <p class="text-xl md:text-2xl font-bold text-blue-900">
                    Universitas Semarang
                </p>
            </div>

            <!-- Information Box -->
            <div class="px-6 md:px-12 pb-8">
                <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-2xl p-6 md:p-8 text-white shadow-xl">
                    <h5 class="text-xl md:text-2xl font-bold mb-6 flex items-center justify-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Informasi Pendaftaran Anda
                    </h5>
                    
                    <!-- Registration Info Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nomor Pendaftaran -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="mb-3">
                                <i class="fas fa-receipt text-4xl text-yellow-400"></i>
                            </div>
                            <p class="text-sm opacity-75 uppercase font-semibold mb-2">Nomor Pendaftaran</p>
                            <h4 class="text-2xl md:text-3xl font-bold bg-white text-blue-900 rounded-lg py-3 px-4 tracking-wider shadow-lg">
                                {{ session('nomor_pendaftaran') ?? 'N/A' }}
                            </h4>
                        </div>

                        <!-- NIM -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="mb-3">
                                <i class="fas fa-id-card text-4xl text-yellow-400"></i>
                            </div>
                            <p class="text-sm opacity-75 uppercase font-semibold mb-2">NIM</p>
                            <h4 class="text-2xl md:text-3xl font-bold bg-white text-gray-800 rounded-lg py-3 px-4 tracking-wider shadow-lg">
                                {{ session('nim') ?? 'N/A' }}
                            </h4>
                        </div>
                    </div>

                    <!-- Country & Period Info -->
                    @if(session('negara_tujuan'))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Negara Tujuan -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 text-center border border-white/20">
                            <p class="text-sm opacity-75 uppercase font-semibold mb-2">Negara Tujuan</p>
                            <h5 class="text-xl font-bold flex items-center justify-center">
                                <i class="fas fa-globe mr-2 text-yellow-400"></i>
                                {{ session('negara_tujuan') }}
                            </h5>
                        </div>

                        <!-- Periode -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 text-center border border-white/20">
                            <p class="text-sm opacity-75 uppercase font-semibold mb-2">Periode</p>
                            <h5 class="text-xl font-bold flex items-center justify-center">
                                <i class="fas fa-calendar mr-2 text-yellow-400"></i>
                                {{ session('periode') ?? 'N/A' }}
                            </h5>
                        </div>
                    </div>
                    @endif

                    <!-- Registration Date -->
                    <div class="mt-6 pt-4 border-t border-white/20 text-center">
                        <p class="text-sm opacity-90">
                            <i class="fas fa-clock mr-2"></i>
                            Tanggal Pendaftaran: {{ now()->format('d F Y, H:i') }} WIB
                        </p>
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="px-6 md:px-12 pb-8">
                <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-r-xl p-5 shadow-md">
                    <h6 class="font-bold text-yellow-900 mb-3 flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-2 text-xl"></i>
                        <span class="text-lg">PENTING!</span>
                    </h6>
                    <ul class="space-y-2 text-sm text-yellow-800 ml-6">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1"></i>
                            <span>Simpan nomor pendaftaran dan NIM Anda dengan baik</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1"></i>
                            <span>Screenshot halaman ini untuk arsip Anda</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1"></i>
                            <span>Pantau status pendaftaran Anda secara berkala melalui dashboard</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 md:px-12 pb-10">
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('mahasiswa.dashboard') }}" 
                       class="px-8 py-4 bg-gradient-to-r from-blue-900 to-blue-800 text-white font-bold rounded-lg hover:from-blue-800 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center">
                        <i class="fas fa-tachometer-alt mr-2"></i> 
                        Ke Dashboard
                    </a>
                    
                    <a href="{{ route('home') }}" 
                       class="px-8 py-4 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-700 transform hover:scale-105 transition-all duration-300 shadow-lg flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i> 
                        Ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Next Steps Card -->
        <div class="mt-6 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-blue-900 to-blue-800 px-6 py-4">
                <h5 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-tasks mr-3"></i>
                    Langkah Selanjutnya
                </h5>
            </div>
            <div class="p-6 md:p-8">
                <div class="space-y-4">
                    <!-- Step 1 -->
                    <div class="flex items-start bg-gray-50 rounded-xl p-4 border-l-4 border-blue-900 hover:shadow-md transition-all duration-300">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-900 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            1
                        </div>
                        <div>
                            <h6 class="font-bold text-gray-800 mb-1">Screenshot Halaman Ini</h6>
                            <p class="text-sm text-gray-600">Simpan bukti pendaftaran untuk arsip Anda</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start bg-gray-50 rounded-xl p-4 border-l-4 border-green-600 hover:shadow-md transition-all duration-300">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            2
                        </div>
                        <div>
                            <h6 class="font-bold text-gray-800 mb-1">Pantau Dashboard Anda</h6>
                            <p class="text-sm text-gray-600">Cek status pendaftaran secara berkala melalui dashboard mahasiswa</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start bg-gray-50 rounded-xl p-4 border-l-4 border-yellow-500 hover:shadow-md transition-all duration-300">
                        <div class="flex-shrink-0 w-10 h-10 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            3
                        </div>
                        <div>
                            <h6 class="font-bold text-gray-800 mb-1">Tunggu Pengumuman Seleksi</h6>
                            <p class="text-sm text-gray-600">Tim kami akan meninjau aplikasi Anda dan mengirimkan pemberitahuan</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start bg-gray-50 rounded-xl p-4 border-l-4 border-red-600 hover:shadow-md transition-all duration-300">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center font-bold mr-4">
                            4
                        </div>
                        <div>
                            <h6 class="font-bold text-gray-800 mb-1">Hubungi Admin Jika Ada Pertanyaan</h6>
                            <p class="text-sm text-gray-600">Jangan ragu untuk menghubungi kami jika ada hal yang perlu ditanyakan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes float-particle {
        0% { transform: translateY(100vh) translateX(0) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100vh) translateX(100px) rotate(360deg); opacity: 0; }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
        25% { transform: translateY(-10px) rotate(5deg) scale(1.03); }
        50% { transform: translateY(-5px) rotate(0deg) scale(1); }
        75% { transform: translateY(-12px) rotate(-5deg) scale(1.03); }
    }
    
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes scale-in {
        0% { transform: scale(0) rotate(-180deg); opacity: 0; }
        50% { transform: scale(1.2) rotate(10deg); }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    
    .animate-float-particle {
        animation: float-particle 20s linear infinite;
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    .animate-spin-slow {
        animation: spin 60s linear infinite;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out;
    }
    
    .animate-scale-in {
        animation: scale-in 0.8s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus on dashboard button
    setTimeout(function() {
        const dashboardBtn = document.querySelector('a[href*="dashboard"]');
        if (dashboardBtn) {
            dashboardBtn.focus();
        }
    }, 500);

    // Add celebration effect
    setTimeout(function() {
        // You can add confetti or celebration animation here if needed
        console.log('🎉 Pendaftaran berhasil!');
    }, 1000);
});
</script>
@endpush
@endsection