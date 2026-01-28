{{-- resources/views/components/admin/filter-section.blade.php --}}
@props(['title' => 'Filter & Pencarian Data'])

<div class="bg-white rounded-lg shadow-md p-6 mb-5 border-t-4 border-blue-900">
    <h6 class="text-base font-bold text-blue-900 mb-4 flex items-center gap-2">
        <i class="fas fa-filter text-yellow-500 text-lg"></i>
        {{ $title }}
    </h6>
    
    {{ $slot }}
</div>