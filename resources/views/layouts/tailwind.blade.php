<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KKN International Office')</title>
    
    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Google Fonts - Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    {{-- Navbar --}}
    <nav class="bg-blue-900 border-b-4 border-yellow-400 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-24">
                {{-- Logo & Brand --}}
                <a href="/" class="flex items-center gap-4 text-white hover:opacity-90 transition">
                    <div class="w-16 h-16 flex-shrink-0">
                        <img src="{{ asset('images/logo-international-office.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="hidden md:block">
                        <div class="text-xl font-semibold leading-tight">KKN International</div>
                        <div class="text-xs text-blue-200">by International Office Universitas Semarang</div>
                    </div>
                </a>
                
                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-2">
                    <a href="/" class="px-5 py-3 text-white hover:text-yellow-400 transition border-b-4 {{ Request::is('/') ? 'border-yellow-400' : 'border-transparent' }}">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('news.index') }}" class="px-5 py-3 text-white hover:text-yellow-400 transition border-b-4 {{ Request::is('news*') ? 'border-yellow-400' : 'border-transparent' }}">
                        <i class="fas fa-newspaper mr-2"></i>Berita
                    </a>
                    <a href="{{ route('pendaftaran.index') }}" class="px-5 py-3 text-white hover:text-yellow-400 transition border-b-4 {{ Request::is('pendaftaran') ? 'border-yellow-400' : 'border-transparent' }}">
                        <i class="fas fa-info-circle mr-2"></i>Informasi
                    </a>
                    
                    @auth
                        @if(auth()->user()->isMahasiswa())
                            <a href="{{ route('mahasiswa.dashboard') }}" class="px-5 py-3 text-white hover:text-yellow-400 transition border-b-4 {{ Request::is('mahasiswa/dashboard') ? 'border-yellow-400' : 'border-transparent' }}">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                            <div class="relative group">
                                <button class="px-5 py-3 text-white hover:text-yellow-400 transition flex items-center gap-2">
                                    <i class="fas fa-user-circle"></i>
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                                    <a href="{{ route('mahasiswa.profile') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-900 hover:text-white rounded-t-lg">
                                        <i class="fas fa-user-edit mr-2"></i>Profile
                                    </a>
                                    <hr class="border-gray-200">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 rounded-b-lg">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 text-white hover:text-yellow-400 transition">
                                <i class="fas fa-user-shield mr-2"></i>Admin
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-white border border-white rounded-lg hover:bg-red-600 hover:border-red-600 transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-3 text-white hover:text-yellow-400 transition border-b-4 {{ Request::is('login') ? 'border-yellow-400' : 'border-transparent' }}">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register.mahasiswa') }}" class="ml-2 px-5 py-2 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-500 transition shadow-lg">
                            <i class="fas fa-user-plus mr-2"></i>Daftar
                        </a>
                    @endauth
                </div>
                
                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="lg:hidden text-white p-2">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <a href="/" class="block px-4 py-3 text-white hover:bg-blue-800 rounded {{ Request::is('/') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="{{ route('news.index') }}" class="block px-4 py-3 text-white hover:bg-blue-800 rounded {{ Request::is('news*') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-newspaper mr-2"></i>Berita
                </a>
                <a href="{{ route('pendaftaran.index') }}" class="block px-4 py-3 text-white hover:bg-blue-800 rounded {{ Request::is('pendaftaran') ? 'bg-blue-800' : '' }}">
                    <i class="fas fa-info-circle mr-2"></i>Informasi
                </a>
                
                @auth
                    @if(auth()->user()->isMahasiswa())
                        <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-3 text-white hover:bg-blue-800 rounded">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.profile') }}" class="block px-4 py-3 text-white hover:bg-blue-800 rounded">
                            <i class="fas fa-user-edit mr-2"></i>Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-red-300 hover:bg-red-900 rounded">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-white hover:bg-blue-800 rounded">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('register.mahasiswa') }}" class="block px-4 py-3 bg-yellow-400 text-blue-900 font-semibold rounded mt-2 text-center">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm flex items-start gap-3">
                <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                <div class="flex-1">
                    <p class="font-semibold text-green-800">Berhasil!</p>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                <div class="flex-1">
                    <p class="font-semibold text-red-800">Error!</p>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mx-auto px-4 mt-4">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-semibold text-red-800">Terjadi Kesalahan:</p>
                        <ul class="list-disc list-inside text-red-700 text-sm mt-2 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-900 text-white mt-auto">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Logo & Info --}}
                <div class="text-center md:text-left">
                    <img src="{{ asset('images/logo-international-office.png') }}" alt="Logo" class="w-24 h-24 mx-auto md:mx-0 mb-4">
                    <div class="text-yellow-400 font-bold text-sm mb-3">WORLD CLASS UNIVERSITY</div>
                    <p class="text-sm text-blue-200">Universitas Semarang</p>
                    <p class="text-xs text-blue-300 mt-2">Jl. Soekarno Hatta, Tlogosari Kulon<br>Semarang, Jawa Tengah 50196</p>
                </div>
                
                {{-- Link Cepat --}}
                <div>
                    <h6 class="font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-link text-yellow-400"></i>
                        Link Cepat
                    </h6>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-blue-200 hover:text-yellow-400 transition">Beranda</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-blue-200 hover:text-yellow-400 transition">Berita</a></li>
                        <li><a href="{{ route('pendaftaran.index') }}" class="text-blue-200 hover:text-yellow-400 transition">Informasi</a></li>
                        <li><a href="{{ route('login') }}" class="text-blue-200 hover:text-yellow-400 transition">Login</a></li>
                        <li><a href="{{ route('register.mahasiswa') }}" class="text-blue-200 hover:text-yellow-400 transition">Daftar Sekarang</a></li>
                    </ul>
                </div>
                
                {{-- Social Media --}}
                <div>
                    <h6 class="font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-share-alt text-yellow-400"></i>
                        Our Social Media
                    </h6>
                    <p class="text-sm text-blue-200 mb-4">Ikuti kami untuk informasi terbaru</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-black rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    <div class="text-sm text-blue-200 space-y-2">
                        <p><i class="fas fa-phone mr-2 text-yellow-400"></i>(024) 1234567</p>
                        <p><i class="fas fa-envelope mr-2 text-yellow-400"></i>international@usm.ac.id</p>
                        <p><i class="fab fa-whatsapp mr-2 text-yellow-400"></i>+62 812-3456-7890</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Footer Bottom --}}
        <div class="bg-yellow-400 py-4">
            <div class="container mx-auto px-4 text-center">
                <p class="text-sm font-semibold text-blue-900">
                    Copyright © {{ date('Y') }} Office of Collaboration and International Affairs. All Rights Reserved
                </p>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.bg-green-50, .bg-red-50').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>