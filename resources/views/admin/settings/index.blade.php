{{-- resources/views/admin/settings.blade.php --}}
@extends('layouts.admin')

@section('title', 'Pengaturan Pendaftaran')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    {{-- Page Header --}}
    <div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3 drop-shadow-md">
                <i class="fas fa-cog text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
                Pengaturan Pendaftaran
            </h2>
            <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow">
                Kelola status dan periode pendaftaran KKN International
            </p>
        </div>
    </div>

    {{-- Main Settings Card --}}
    <div class="bg-white rounded-lg shadow-md mb-5 overflow-hidden border-t-4 border-blue-900">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
            <h5 class="text-lg font-semibold text-white flex items-center gap-3">
                <i class="fas fa-sliders-h text-yellow-400 text-xl drop-shadow"></i>
                Pengaturan Sistem
            </h5>
        </div>
        
        <div class="p-6 bg-gray-50">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                {{-- Status Pendaftaran --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-blue-900 mb-3">
                        Status Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   name="registration_status" 
                                   id="registrationStatus"
                                   value="open"
                                   class="sr-only peer"
                                   {{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? 'checked' : '' }}>
                            <div class="w-14 h-7 bg-red-500 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500 shadow-md"></div>
                        </label>
                        <span id="statusText" class="text-lg font-bold {{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? 'text-green-600' : 'text-red-600' }}">
                            {{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? '✓ Pendaftaran Dibuka' : '✕ Pendaftaran Ditutup' }}
                        </span>
                    </div>
                    <small class="block text-gray-600 font-medium mt-2 ml-1">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Aktifkan untuk membuka pendaftaran KKN International
                    </small>
                </div>

                <hr class="border-t-2 border-gray-200 my-6">

                {{-- Periode Pendaftaran --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Tanggal Mulai Pendaftaran
                        </label>
                        <input type="date" 
                               name="registration_start" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium @error('registration_start') border-red-500 @enderror"
                               value="{{ old('registration_start', $settings['registration_start']->value ?? '') }}">
                        @error('registration_start')
                            <small class="text-red-500 font-medium">{{ $message }}</small>
                        @enderror
                        <small class="block text-gray-500 font-medium mt-2">
                            Opsional - Tentukan kapan pendaftaran dimulai
                        </small>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-900 mb-2">
                            Tanggal Selesai Pendaftaran
                        </label>
                        <input type="date" 
                               name="registration_end" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 bg-gray-50 hover:bg-white text-sm font-medium @error('registration_end') border-red-500 @enderror"
                               value="{{ old('registration_end', $settings['registration_end']->value ?? '') }}">
                        @error('registration_end')
                            <small class="text-red-500 font-medium">{{ $message }}</small>
                        @enderror
                        <small class="block text-gray-500 font-medium mt-2">
                            Opsional - Tentukan kapan pendaftaran berakhir
                        </small>
                    </div>
                </div>

                <hr class="border-t-2 border-gray-200 my-6">

                {{-- Info Box --}}
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 rounded-lg p-5 mb-6 shadow-sm">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-500 text-xl mt-1"></i>
                        <div class="flex-1">
                            <strong class="text-blue-900 font-bold text-sm">Informasi Penting:</strong>
                            <ul class="mt-2 space-y-2 text-sm text-gray-700 font-medium">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                    <span>Status pendaftaran akan mempengaruhi akses mahasiswa ke form pendaftaran</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                    <span>Jika status ditutup, mahasiswa tidak dapat mendaftar KKN International</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                                    <span>Tanggal mulai dan selesai bersifat opsional sebagai informasi tambahan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex gap-3 justify-end flex-wrap">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="px-5 py-2.5 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-gradient-to-r from-blue-900 to-blue-600 text-white rounded-lg font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Current Status Display --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Status Card --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border-2 {{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? 'border-green-500' : 'border-red-500' }} relative group">
            <div class="absolute top-0 right-0 w-32 h-32 {{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? 'bg-green-500/10' : 'bg-red-500/10' }} rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
            
            <div class="p-6 relative">
                <h6 class="text-base font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-toggle-{{ (isset($settings['registration_status']) && $settings['registration_status']->value == 'open') ? 'on' : 'off' }} text-yellow-500 text-lg"></i>
                    Status Saat Ini
                </h6>
                
                <div class="mb-4">
                    @if(isset($settings['registration_status']) && $settings['registration_status']->value == 'open')
                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-bold shadow-md uppercase tracking-wide">
                            <i class="fas fa-check-circle mr-2"></i>
                            Pendaftaran DIBUKA
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-bold shadow-md uppercase tracking-wide">
                            <i class="fas fa-times-circle mr-2"></i>
                            Pendaftaran DITUTUP
                        </span>
                    @endif
                </div>
                
                <small class="text-gray-500 font-medium flex items-center gap-2">
                    <i class="fas fa-clock text-blue-500"></i>
                    Terakhir diupdate: {{ isset($settings['registration_status']) ? $settings['registration_status']->updated_at->format('d M Y, H:i') : '-' }}
                </small>
            </div>
        </div>
        
        {{-- Period Card --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border-2 border-blue-500 relative group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
            
            <div class="p-6 relative">
                <h6 class="text-base font-bold text-blue-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-yellow-500 text-lg"></i>
                    Periode Pendaftaran
                </h6>
                
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg">
                        <i class="fas fa-calendar-check text-green-500 text-lg"></i>
                        <div>
                            <strong class="text-blue-900 text-sm block">Mulai:</strong>
                            <span class="text-gray-700 font-semibold">
                                {{ isset($settings['registration_start']) && $settings['registration_start']->value ? \Carbon\Carbon::parse($settings['registration_start']->value)->format('d M Y') : '-' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-3 bg-gradient-to-r from-red-50 to-pink-50 rounded-lg">
                        <i class="fas fa-calendar-times text-red-500 text-lg"></i>
                        <div>
                            <strong class="text-blue-900 text-sm block">Selesai:</strong>
                            <span class="text-gray-700 font-semibold">
                                {{ isset($settings['registration_end']) && $settings['registration_end']->value ? \Carbon\Carbon::parse($settings['registration_end']->value)->format('d M Y') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update status text when toggle switch changes
    const toggleSwitch = document.getElementById('registrationStatus');
    const statusText = document.getElementById('statusText');
    
    if (toggleSwitch && statusText) {
        toggleSwitch.addEventListener('change', function() {
            if (this.checked) {
                statusText.textContent = '✓ Pendaftaran Dibuka';
                statusText.classList.remove('text-red-600');
                statusText.classList.add('text-green-600');
                
                // Add animation
                statusText.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    statusText.style.transform = 'scale(1)';
                }, 200);
            } else {
                statusText.textContent = '✕ Pendaftaran Ditutup';
                statusText.classList.remove('text-green-600');
                statusText.classList.add('text-red-600');
                
                // Add animation
                statusText.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    statusText.style.transform = 'scale(1)';
                }, 200);
            }
        });
        
        // Add transition to status text
        statusText.style.transition = 'all 0.3s ease';
    }
});

console.log('✅ Admin Settings Page - Tailwind CSS Version Loaded Successfully');
</script>
@endpush