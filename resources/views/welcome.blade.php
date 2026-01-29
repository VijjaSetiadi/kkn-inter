@extends('layouts.app')

@section('title', 'KKN International Office - Universitas Semarang')

@section('content')

<!-- Hero Slider -->
<section class="relative h-[600px] overflow-hidden">
    <!-- Slide 1 -->
    <div class="hero-slide active absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1200&q=80" alt="International Students" class="w-full h-full object-cover">
        <!-- Gradient overlay yang lebih gelap dan lebih merata -->
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-blue-900/90 via-blue-800/85 to-navy/90 z-10"></div>
        <!-- Layer tambahan untuk meningkatkan kontras di tengah -->
        <div class="absolute top-0 left-0 w-full h-full z-10" style="background: radial-gradient(circle at center, rgba(15, 23, 42, 0.3) 0%, rgba(15, 23, 42, 0.7) 100%);"></div>
        
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 text-center text-white w-[90%] max-w-[800px] animate-fade-in-up">
            <h1 class="text-[42px] font-bold leading-tight mb-4 tracking-tight drop-shadow-2xl">Wujudkan Pengalaman Global Anda</h1>
            <p class="text-[15px] opacity-95 mb-6 leading-relaxed drop-shadow-lg">
                Bergabung dengan KKN International di universitas mitra terkemuka dunia dan raih peluang karir global
            </p>
            <div class="flex gap-4 justify-center flex-wrap mt-8">
                @guest
                    <a href="{{ route('register.mahasiswa') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 hover:-translate-y-0.5 hover:shadow-gold/40 transition-all min-w-[180px]">
                        <i class="fas fa-rocket mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-9 py-3 text-sm font-semibold border-2 border-white text-white bg-white/10 backdrop-blur-md rounded-lg hover:bg-white hover:text-navy hover:-translate-y-0.5 hover:shadow-white/30 transition-all min-w-[180px]">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @else
                    @if(auth()->user()->isMahasiswa())
                        <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 transition-all min-w-[180px]">
                            <i class="fas fa-edit mr-2"></i> Daftar KKN
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 transition-all min-w-[180px]">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
    
    <!-- Slide 2 -->
    <div class="hero-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000">
        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=80" alt="Global Network" class="w-full h-full object-cover">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-blue-900/90 via-blue-800/85 to-navy/90 z-10"></div>
        <div class="absolute top-0 left-0 w-full h-full z-10" style="background: radial-gradient(circle at center, rgba(15, 23, 42, 0.3) 0%, rgba(15, 23, 42, 0.7) 100%);"></div>
        
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 text-center text-white w-[90%] max-w-[800px]">
            <h1 class="text-[42px] font-bold leading-tight mb-4 tracking-tight drop-shadow-2xl">Bangun Network Internasional</h1>
            <p class="text-[15px] opacity-95 mb-6 leading-relaxed drop-shadow-lg">
                Bergabung dengan komunitas mahasiswa dari 15+ negara dan 50+ universitas partner terkemuka
            </p>
            <div class="flex gap-4 justify-center flex-wrap mt-8">
                @guest
                    <a href="{{ route('register.mahasiswa') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 transition-all min-w-[180px]">
                        <i class="fas fa-users mr-2"></i> Bergabung Sekarang
                    </a>
                @else
                    <a href="{{ route('mahasiswa.dashboard') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 transition-all min-w-[180px]">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
    
    <!-- Slide 3 -->
    <div class="hero-slide absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000">
        <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?w=1200&q=80" alt="International Education" class="w-full h-full object-cover">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-blue-900/90 via-blue-800/85 to-navy/90 z-10"></div>
        <div class="absolute top-0 left-0 w-full h-full z-10" style="background: radial-gradient(circle at center, rgba(15, 23, 42, 0.3) 0%, rgba(15, 23, 42, 0.7) 100%);"></div>
        
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 text-center text-white w-[90%] max-w-[800px]">
            <h1 class="text-[42px] font-bold leading-tight mb-4 tracking-tight drop-shadow-2xl">Raih Sertifikat Internasional</h1>
            <p class="text-[15px] opacity-95 mb-6 leading-relaxed drop-shadow-lg">
                Dapatkan sertifikat dari universitas mitra yang diakui secara internasional dan tingkatkan karir Anda
            </p>
            <div class="flex gap-4 justify-center flex-wrap mt-8">
                @guest
                    <a href="{{ route('pendaftaran.index') }}" class="px-9 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-lg hover:bg-gold/90 transition-all min-w-[180px]">
                        <i class="fas fa-info-circle mr-2"></i> Info Lengkap
                    </a>
                @endguest
            </div>
        </div>
    </div>
    
    <!-- Slider Controls -->
    <button onclick="changeSlide(-1)" class="absolute top-1/2 left-5 transform -translate-y-1/2 z-30 bg-white/20 backdrop-blur-sm border-0 text-white w-11 h-11 rounded-full cursor-pointer transition-all hover:bg-gold/80 flex items-center justify-center">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button onclick="changeSlide(1)" class="absolute top-1/2 right-5 transform -translate-y-1/2 z-30 bg-white/20 backdrop-blur-sm border-0 text-white w-11 h-11 rounded-full cursor-pointer transition-all hover:bg-gold/80 flex items-center justify-center">
        <i class="fas fa-chevron-right"></i>
    </button>
    
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-30 flex gap-2.5">
        <button onclick="currentSlide(0)" class="slider-dot w-2.5 h-2.5 rounded-full bg-white/50 cursor-pointer transition-all border-0 p-0 active"></button>
        <button onclick="currentSlide(1)" class="slider-dot w-2.5 h-2.5 rounded-full bg-white/50 cursor-pointer transition-all border-0 p-0"></button>
        <button onclick="currentSlide(2)" class="slider-dot w-2.5 h-2.5 rounded-full bg-white/50 cursor-pointer transition-all border-0 p-0"></button>
    </div>
</section>

<style>
    .hero-slide.active { opacity: 1; }
    .slider-dot.active { background: #F9B234; width: 30px; border-radius: 5px; }
    
    /* Animasi Fade In Up */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out;
    }
    
    /* Animasi Float */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Animasi Bounce In */
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            transform: scale(1);
        }
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.6s ease-out;
    }
    
    /* Animasi Slide In dari kiri */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out;
    }
    
    /* Animasi Slide In dari kanan */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out;
    }
    
    /* Animasi Pulse */
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }
    
    .animate-pulse-custom {
        animation: pulse 2s ease-in-out infinite;
    }
    
    /* Delay untuk animasi berurutan */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-600 { animation-delay: 0.6s; }
</style>

<!-- Latest News Section -->
@if(isset($latestNews) && $latestNews->count() > 0)
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div class="animate-slide-in-left">
                <h2 class="text-3xl font-bold text-navy mb-1">Berita Terbaru</h2>
                <p class="text-sm text-gray-600">Informasi dan update terkini seputar KKN International</p>
            </div>
            <a href="{{ route('news.index') }}" class="px-4 py-2 text-sm font-medium text-navy border border-navy rounded hover:bg-navy hover:text-white transition-colors animate-slide-in-right">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($latestNews as $index => $news)
            <a href="{{ route('news.show', $news->slug) }}" class="block group animate-bounce-in delay-{{ ($index + 1) * 100 }}">
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 transition-all hover:-translate-y-2 hover:shadow-xl h-full flex flex-col">
                    <div class="relative w-full h-[200px] overflow-hidden">
                        @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover transition-transform group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center">
                                <i class="fas fa-newspaper text-6xl text-white opacity-50"></i>
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 bg-teal-500 text-white px-3.5 py-1.5 rounded-full font-bold text-[0.65rem] uppercase tracking-wider shadow-lg shadow-teal-500/40">NEWS</span>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-amber-500 mb-2.5 line-clamp-2 min-h-[56px]">{{ $news->title }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed mb-4 line-clamp-3 flex-1">{{ $news->excerpt }}</p>
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-100 mt-auto">
                            <span class="text-xs text-gray-400 flex items-center gap-1">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $news->published_date->format('d M Y') }}
                            </span>
                            <span class="text-xs font-semibold text-teal-500 group-hover:text-teal-700">
                                READ MORE »
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Features -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 animate-fade-in-up">
            <h2 class="text-3xl font-bold text-navy mb-2">Mengapa KKN International?</h2>
            <p class="text-sm text-gray-600">Program yang dirancang untuk mengembangkan kompetensi global Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md hover:border-navy animate-bounce-in delay-100">
                <div class="w-[50px] h-[50px] rounded-lg bg-gradient-to-br from-navy to-blue-900 flex items-center justify-center mb-4 animate-float">
                    <i class="fas fa-globe-asia text-white text-2xl"></i>
                </div>
                <h3 class="text-base font-semibold mb-2 text-navy">Pengalaman Global</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Belajar dan bekerja di lingkungan internasional dengan budaya beragam</p>
            </div>
            
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md hover:border-navy animate-bounce-in delay-200">
                <div class="w-[50px] h-[50px] rounded-lg bg-gradient-to-br from-navy to-blue-900 flex items-center justify-center mb-4 animate-float" style="animation-delay: 0.5s;">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-base font-semibold mb-2 text-navy">Network Profesional</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Bangun koneksi dengan mahasiswa dan profesional dari berbagai negara</p>
            </div>
            
            <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:-translate-y-1 hover:shadow-md hover:border-navy animate-bounce-in delay-300">
                <div class="w-[50px] h-[50px] rounded-lg bg-gradient-to-br from-navy to-blue-900 flex items-center justify-center mb-4 animate-float" style="animation-delay: 1s;">
                    <i class="fas fa-certificate text-white text-2xl"></i>
                </div>
                <h3 class="text-base font-semibold mb-2 text-navy">Sertifikat Resmi</h3>
                <p class="text-sm text-gray-600 leading-relaxed">Dapatkan sertifikat dari universitas mitra yang diakui internasional</p>
            </div>
        </div>
    </div>
</section>

<!-- Process -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 animate-fade-in-up">
            <h2 class="text-3xl font-bold text-navy mb-2">Cara Mendaftar</h2>
            <p class="text-sm text-gray-600">Proses pendaftaran yang mudah dan cepat</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="relative p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:shadow-md hover:-translate-y-1 animate-slide-in-left delay-100">
                <div class="absolute -top-2.5 left-6 w-8 h-8 rounded-md bg-gradient-to-br from-navy to-blue-900 text-white font-bold flex items-center justify-center text-sm animate-pulse-custom">1</div>
                <h4 class="font-semibold mt-3 mb-1 text-[15px] text-navy">Registrasi</h4>
                <p class="text-sm text-gray-600">Buat akun dan lengkapi data diri</p>
            </div>
            
            <div class="relative p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:shadow-md hover:-translate-y-1 animate-fade-in-up delay-200">
                <div class="absolute -top-2.5 left-6 w-8 h-8 rounded-md bg-gradient-to-br from-navy to-blue-900 text-white font-bold flex items-center justify-center text-sm animate-pulse-custom" style="animation-delay: 0.3s;">2</div>
                <h4 class="font-semibold mt-3 mb-1 text-[15px] text-navy">Upload Dokumen</h4>
                <p class="text-sm text-gray-600">Lengkapi persyaratan dokumen</p>
            </div>
            
            <div class="relative p-6 bg-white rounded-lg border border-gray-200 shadow-sm transition-all hover:shadow-md hover:-translate-y-1 animate-slide-in-right delay-300">
                <div class="absolute -top-2.5 left-6 w-8 h-8 rounded-md bg-gradient-to-br from-navy to-blue-900 text-white font-bold flex items-center justify-center text-sm animate-pulse-custom" style="animation-delay: 0.6s;">3</div>
                <h4 class="font-semibold mt-3 mb-1 text-[15px] text-navy">Seleksi</h4>
                <p class="text-sm text-gray-600">Tim akan verifikasi dan seleksi</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-center bg-cover text-white text-center relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1200&q=80');">
    <!-- Gradient Overlay yang lebih kuat untuk keterbacaan -->
    <div class="absolute inset-0 bg-gradient-to-br from-navy/95 via-blue-900/90 to-navy/95 z-0"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/40 z-0"></div>
    
    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="animate-fade-in-up">
            <h2 class="text-[36px] font-bold mb-3 tracking-tight drop-shadow-lg">Siap Memulai Perjalanan Global?</h2>
            <p class="text-[16px] mb-8 drop-shadow-md">Daftar sekarang dan jadilah bagian dari generasi unggul</p>
            
            @guest
                <div class="flex gap-4 justify-center flex-wrap mb-8">
                    <a href="{{ route('register.mahasiswa') }}" class="px-8 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-xl hover:bg-gold/90 hover:scale-105 transition-all">
                        <i class="fas fa-rocket mr-2"></i> Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3 text-sm font-semibold border-2 border-white text-white bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white hover:text-navy hover:scale-105 transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>
            @else
                @if(auth()->user()->isMahasiswa())
                    <div class="mb-8">
                        <a href="{{ route('mahasiswa.pendaftaran.create') }}" class="inline-block px-8 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-xl hover:bg-gold/90 hover:scale-105 transition-all">
                            <i class="fas fa-edit mr-2"></i> Daftar KKN Sekarang
                        </a>
                    </div>
                @else
                    <div class="mb-8">
                        <a href="{{ route('admin.dashboard') }}" class="inline-block px-8 py-3 text-sm font-semibold bg-gold text-white rounded-lg shadow-xl hover:bg-gold/90 hover:scale-105 transition-all">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </div>
                @endif
            @endguest
            
            <div class="pt-4 border-t border-white/20 inline-block">
                <p class="mb-2 text-sm font-medium drop-shadow-md"><i class="fas fa-phone mr-2"></i> (024) 6702757</p>
                <p class="mb-0 text-sm font-medium drop-shadow-md"><i class="fas fa-envelope mr-2"></i> international@usm.ac.id</p>
            </div>
        </div>
    </div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-gold/20 rounded-full blur-3xl animate-pulse-custom"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl animate-pulse-custom" style="animation-delay: 1s;"></div>
</section>

<script>
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.slider-dot');

function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    if (index >= slides.length) currentSlideIndex = 0;
    if (index < 0) currentSlideIndex = slides.length - 1;
    
    slides[currentSlideIndex].classList.add('active');
    dots[currentSlideIndex].classList.add('active');
}

function changeSlide(direction) {
    currentSlideIndex += direction;
    showSlide(currentSlideIndex);
}

function currentSlide(index) {
    currentSlideIndex = index;
    showSlide(currentSlideIndex);
}

// Auto slide every 5 seconds
setInterval(() => {
    currentSlideIndex++;
    showSlide(currentSlideIndex);
}, 5000);

// Intersection Observer untuk animasi saat scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe semua elemen yang perlu animasi
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.animate-fade-in-up, .animate-bounce-in, .animate-slide-in-left, .animate-slide-in-right');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        observer.observe(el);
    });
});
</script>

@endsection