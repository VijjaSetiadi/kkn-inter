{{-- resources/views/components/admin/data-table.blade.php --}}
@props(['icon', 'title'])

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-6 py-4 border-b-4 border-yellow-400">
        <h5 class="text-base md:text-lg font-semibold text-white flex items-center gap-3">
            <i class="{{ $icon }} text-yellow-400 text-lg md:text-xl drop-shadow"></i>
            {{ $title }}
        </h5>
    </div>
    
    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>