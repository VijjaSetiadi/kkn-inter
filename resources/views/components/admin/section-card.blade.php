{{-- resources/views/components/admin/section-card.blade.php --}}
@props(['icon', 'title'])

<div class="bg-white rounded-xl shadow-md overflow-hidden mb-5">
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
        <h5 class="text-base md:text-lg font-semibold text-white flex items-center gap-3">
            <i class="{{ $icon }} text-yellow-400 text-lg md:text-xl drop-shadow"></i>
            {{ $title }}
        </h5>
    </div>
    
    <div class="p-6">
        {{ $slot }}
    </div>
</div>