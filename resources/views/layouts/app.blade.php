<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KKN International Office')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Fixed colors untuk konsistensi */
        .bg-navy { background-color: #1e3a8a; }
        .bg-gold { background-color: #F9B234; }
        .text-navy { color: #1e3a8a; }
        .text-gold { color: #F9B234; }
        .border-gold { border-color: #F9B234; }
        .hover\:bg-gold:hover { background-color: #e5a020; }
        .hover\:text-gold:hover { color: #F9B234; }
        .hover\:border-gold:hover { border-color: #F9B234; }

        /* Nav Link Styling */
        .nav-link {
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: white;
            border-bottom: 4px solid transparent;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .nav-link:hover {
            color: #F9B234;
            border-bottom-color: #F9B234;
        }

        .nav-link.active {
            color: #F9B234;
            border-bottom-color: #F9B234;
        }

        /* Dropdown Menu Item Styling */
        .dropdown-item {
            display: block;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #1e3a8a;
            color: white;
        }

        .dropdown-item.logout {
            color: #dc2626;
        }

        .dropdown-item.logout:hover {
            background-color: #dc2626;
            color: white;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-sm">
    <!-- Navbar -->
    <nav class="bg-navy border-b-4 border-gold">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between" style="min-height: 90px;">
                <!-- Logo & Brand -->
                <a href="/" class="flex items-center gap-4 text-white hover:no-underline">
                    <div class="w-[70px] h-[70px] flex-shrink-0">
                        <img src="{{ asset('images/logo-international-office.png') }}" alt="Logo International Office" class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white text-lg font-semibold leading-tight">KKN International</span>
                        <span class="text-white text-xs font-normal opacity-90 leading-tight">by International Office Universitas Semarang</span>
                    </div>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white p-2 hover:text-gold focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-2">
                    <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
                        <i class="fas fa-home text-xs mr-1"></i> Beranda
                    </a>
                    <a href="{{ route('news.index') }}" class="nav-link {{ Request::is('news*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper text-xs mr-1"></i> Berita
                    </a>
                    <a href="{{ route('pendaftaran.index') }}" class="nav-link {{ Request::is('pendaftaran') ? 'active' : '' }}">
                        <i class="fas fa-info-circle text-xs mr-1"></i> Informasi
                    </a>
                    
                    @auth
                        @if(auth()->user()->isMahasiswa())
                            <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ Request::is('mahasiswa/dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt text-xs mr-1"></i> Dashboard
                            </a>
                            <div class="relative group">
                                <button class="px-4 py-2.5 text-sm font-medium text-white hover:text-gold transition-all flex items-center gap-1">
                                    <i class="fas fa-user-circle text-xs"></i> {{ auth()->user()->name }} <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute right-0 mt-0 w-48 bg-white shadow-lg border border-gray-200 hidden group-hover:block z-50 rounded-b-lg overflow-hidden">
                                    <a href="{{ route('mahasiswa.profile') }}" class="dropdown-item">
                                        <i class="fas fa-user-edit mr-2"></i> Profile
                                    </a>
                                    <hr class="border-gray-200 m-0">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left dropdown-item logout">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                <i class="fas fa-user-shield text-xs mr-1"></i> Admin
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                                @csrf
                                <button type="submit" class="px-3.5 py-1.5 text-sm font-medium text-white border border-white/80 rounded hover:bg-red-600 hover:border-red-600 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="nav-link {{ Request::is('login') ? 'active' : '' }}">
                            <i class="fas fa-sign-in-alt text-xs mr-1"></i> Login
                        </a>
                        <a href="{{ route('register.mahasiswa') }}" class="ml-2 px-4 py-2 text-sm font-medium text-white bg-gold rounded hover:bg-gold/90 transition-colors">
                            <i class="fas fa-user-plus mr-1"></i> Daftar
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-blue-800 rounded my-2 p-3">
                <a href="/" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                    <i class="fas fa-home text-xs mr-2"></i> Beranda
                </a>
                <a href="{{ route('news.index') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                    <i class="fas fa-newspaper text-xs mr-2"></i> Berita
                </a>
                <a href="{{ route('pendaftaran.index') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                    <i class="fas fa-info-circle text-xs mr-2"></i> Informasi
                </a>
                
                @auth
                    @if(auth()->user()->isMahasiswa())
                        <a href="{{ route('mahasiswa.dashboard') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                            <i class="fas fa-tachometer-alt text-xs mr-2"></i> Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.profile') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                            <i class="fas fa-user-edit text-xs mr-2"></i> Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2.5 text-sm font-medium text-red-600 hover:text-white hover:bg-red-600 rounded transition-all">
                                <i class="fas fa-sign-out-alt text-xs mr-2"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                            <i class="fas fa-user-shield text-xs mr-2"></i> Admin
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white border border-white/80 rounded hover:bg-red-600 hover:border-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 text-sm font-medium text-white hover:text-gold transition-all">
                        <i class="fas fa-sign-in-alt text-xs mr-2"></i> Login
                    </a>
                    <a href="{{ route('register.mahasiswa') }}" class="block mt-2 px-4 py-2 text-sm font-medium text-white bg-gold rounded text-center hover:bg-gold/90 transition-colors">
                        <i class="fas fa-user-plus mr-1"></i> Daftar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 mt-3">
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-700 mr-2"></i>
                        <div>
                            <strong class="font-medium text-green-900">Berhasil!</strong>
                            <span class="text-green-800 ml-2">{{ session('success') }}</span>
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 mt-3">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-700 mr-2"></i>
                        <div>
                            <strong class="font-medium text-red-900">Error!</strong>
                            <span class="text-red-800 ml-2">{{ session('error') }}</span>
                        </div>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="container mx-auto px-4 mt-3">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle text-red-700 mr-2"></i>
                            <strong class="font-medium text-red-900">Terjadi Kesalahan:</strong>
                        </div>
                        <ul class="list-disc list-inside text-red-800 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900 ml-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="flex-1">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-navy text-white/90">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8">
                <!-- Logo & University Info -->
                <div class="text-center">
                    <div class="inline-block mb-4">
                        <img src="{{ asset('images/logo-international-office.png') }}" alt="Logo International Office" class="w-32 h-auto mx-auto">
                        <div class="text-gold text-base font-semibold mt-2 tracking-wider">JOURNEY TO<br>EXCELLENCE</div>
                    </div>
                    <p class="font-medium mb-1">Universitas Semarang</p>
                    <p class="text-sm opacity-80">Jl. Soekarno Hatta, Tlogosari Kulon<br>Semarang, Jawa Tengah 50196</p>
                </div>
                
                <!-- Link Cepat -->
                <div>
                    <h6 class="flex items-center gap-2 text-white text-base font-semibold mb-5">
                        <i class="fas fa-link text-gold text-xl"></i> Link Cepat
                    </h6>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-white/85 hover:text-gold hover:pl-1 transition-all inline-block">Beranda</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-white/85 hover:text-gold hover:pl-1 transition-all inline-block">Berita</a></li>
                        <li><a href="{{ route('pendaftaran.index') }}" class="text-white/85 hover:text-gold hover:pl-1 transition-all inline-block">Informasi</a></li>
                        <li><a href="{{ route('login') }}" class="text-white/85 hover:text-gold hover:pl-1 transition-all inline-block">Login</a></li>
                        <li><a href="{{ route('register.mahasiswa') }}" class="text-white/85 hover:text-gold hover:pl-1 transition-all inline-block">Daftar Sekarang</a></li>
                    </ul>
                </div>
                
                <!-- Our Social Media -->
                <div>
                    <h6 class="flex items-center gap-2 text-white text-base font-semibold mb-5">
                        <i class="fas fa-share-alt text-gold text-xl"></i> Our Social Media
                    </h6>
                    <p class="text-white/85 mb-5 leading-relaxed">Ikuti kami di media sosial untuk informasi terbaru tentang program KKN International</p>
                    <div class="flex flex-wrap gap-3 mb-5">
                        <a href="https://www.instagram.com/io_usm" target="_blank" rel="noopener noreferrer" class="w-11 h-11 flex items-center justify-center bg-white/10 rounded-lg text-white text-xl hover:bg-pink-600 hover:-translate-y-1 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/p/International-Office-Usm-100064186593529/" target="_blank" rel="noopener noreferrer" class="w-11 h-11 flex items-center justify-center bg-white/10 rounded-lg text-white text-xl hover:bg-blue-600 hover:-translate-y-1 transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                    <div class="space-y-2 text-white/85">
                        <p><i class="fas fa-phone mr-2"></i> (024) 6702757</p>
                        <p><i class="fas fa-envelope mr-2"></i> international@usm.ac.id</p>
                        <p><i class="fab fa-whatsapp mr-2"></i> +62 821 1021 0236</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="bg-gold text-navy text-center py-4">
            <p class="text-sm font-semibold m-0">Copyright © {{ date('Y') }} International Office Universitas Semarang. All Rights Reserved</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>