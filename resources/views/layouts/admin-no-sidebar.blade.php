<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - KKN International</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    {{-- MAIN CONTENT (No Sidebar, No Top Bar, Full Width) --}}
    <main class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        {{-- Success Alert --}}
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm" role="alert">
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
            </div>
        @endif

        {{-- Error Alert --}}
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
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
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-sm" role="alert">
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
            </div>
        @endif

        @yield('content')
    </main>
    
    <script>
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