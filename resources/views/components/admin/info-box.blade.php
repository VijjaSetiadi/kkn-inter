{{-- resources/views/components/admin/info-box.blade.php --}}
@props(['icon' => 'fas fa-info-circle'])

<div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 p-4 rounded-lg mb-4 shadow-sm">
    <div class="flex items-start gap-3">
        <i class="{{ $icon }} text-blue-600 text-xl mt-0.5"></i>
        <div class="flex-1 text-sm text-blue-900 font-medium">
            {{ $slot }}
        </div>
    </div>
</div>