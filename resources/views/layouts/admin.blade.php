{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - KKN International</title>
    
    {{-- ✅ TAILWIND CSS VIA VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white fixed h-screen overflow-y-auto shadow-xl z-50">
            {{-- Sidebar Header --}}
            <div class="p-5 border-b-4 border-yellow-400">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 text-white hover:text-yellow-400 transition-colors">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('images/logo-international-office.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                    </div>
                    <div>
                        <h5 class="text-base font-semibold">KKN International</h5>
                        <p class="text-xs opacity-90 mt-0.5">Admin Panel</p>
                    </div>
                </a>
            </div>
            
            {{-- Sidebar Menu --}}
            <nav class="py-4">
                {{-- MAIN MENU --}}
                <div class="px-5 py-3 text-xs font-semibold uppercase tracking-wider opacity-50">
                    Main Menu
                </div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.dashboard') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-home w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Dashboard</span>
                        <span class="text-xs opacity-70">Overview & Statistics</span>
                    </div>
                </a>
                
                {{-- NEW: Data Pendaftaran Menu --}}
                <a href="{{ route('admin.pendaftaran.index') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.pendaftaran.index') || request()->routeIs('admin.pendaftaran.show') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-clipboard-list w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Data Pendaftaran</span>
                        <span class="text-xs opacity-70">Kelola data pendaftar</span>
                    </div>
                </a>
                
                {{-- CONTENT MANAGEMENT --}}
                <div class="px-5 py-3 mt-4 text-xs font-semibold uppercase tracking-wider opacity-50">
                    Content Management
                </div>
                <a href="{{ route('admin.news.index') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.news.*') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-newspaper w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Kelola Berita</span>
                        <span class="text-xs opacity-70">Tambah, edit, hapus berita</span>
                    </div>
                </a>
                
                {{-- SYSTEM MANAGEMENT --}}
                <div class="px-5 py-3 mt-4 text-xs font-semibold uppercase tracking-wider opacity-50">
                    System Management
                </div>
                <a href="{{ route('admin.settings') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.settings') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-cog w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Pengaturan</span>
                        <span class="text-xs opacity-70">Buka/Tutup pendaftaran</span>
                    </div>
                </a>
                
                <a href="{{ route('admin.destinations') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.destinations*') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-globe w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Tujuan KKN</span>
                        <span class="text-xs opacity-70">Kelola negara tujuan</span>
                    </div>
                </a>
                
                <a href="{{ route('admin.periods') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.periods*') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-calendar-alt w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Periode KKN</span>
                        <span class="text-xs opacity-70">Kelola periode tahun ajaran</span>
                    </div>
                </a>
                
                {{-- REPORTS --}}
                <div class="px-5 py-3 mt-4 text-xs font-semibold uppercase tracking-wider opacity-50">
                    Reports
                </div>
                <a href="{{ route('admin.export') }}" 
                   class="flex items-center px-5 py-3 mx-2 text-sm font-medium transition-all duration-200 border-l-4 {{ request()->routeIs('admin.export*') ? 'bg-yellow-400/20 text-yellow-400 border-yellow-400' : 'text-white/85 border-transparent hover:bg-white/10 hover:text-yellow-400 hover:border-yellow-400' }}">
                    <i class="fas fa-file-download w-5 mr-3 text-center"></i>
                    <div class="flex-1">
                        <span class="block">Export Data</span>
                        <span class="text-xs opacity-70">Download laporan Excel/PDF</span>
                    </div>
                </a>
            </nav>

            {{-- Sidebar Footer --}}
            <div class="p-5 border-t border-white/10 mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2.5 bg-transparent border border-white/30 text-white rounded-lg hover:bg-red-500/20 hover:border-red-500 hover:text-red-400 transition-all duration-300 flex items-center justify-center gap-2 font-medium">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 ml-64 p-6 min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
            {{-- Success Alert --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-5 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div class="flex-1">
                            <p class="font-semibold text-green-900">Berhasil!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-5 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <div class="flex-1">
                            <p class="font-semibold text-red-900">Error!</p>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-5 rounded-lg shadow-sm" role="alert">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3 mt-0.5"></i>
                        <div class="flex-1">
                            <p class="font-semibold text-red-900 mb-2">Terjadi Kesalahan:</p>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    
    <script>
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('[role="alert"]').forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>