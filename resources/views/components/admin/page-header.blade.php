{{-- resources/views/components/admin/page-header.blade.php --}}
@props(['icon', 'title', 'subtitle' => null])

<div class="bg-gradient-to-r from-blue-900 to-blue-600 rounded-xl shadow-lg mb-5 p-6 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400/10 rounded-full transform translate-x-1/3 -translate-y-1/3"></div>
    
    <div class="relative z-10">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex flex-col md:flex-row md:items-center gap-2 md:gap-3 drop-shadow-md">
            <i class="{{ $icon }} text-yellow-400 text-2xl md:text-3xl drop-shadow"></i>
            <span>{{ $title }}</span>
        </h2>
        @if($subtitle)
        <p class="text-white/90 text-sm ml-0 md:ml-11 drop-shadow mt-2">
            {{ $subtitle }}
        </p>
        @endif
    </div>
</div>