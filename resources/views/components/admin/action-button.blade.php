{{-- resources/views/components/admin/action-button.blade.php --}}
@props(['color' => 'blue', 'icon', 'title' => ''])

@php
$colors = [
    'blue' => 'from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600',
    'yellow' => 'from-yellow-500 to-yellow-400 hover:from-yellow-600 hover:to-yellow-500',
    'red' => 'from-red-500 to-red-600 hover:from-red-600 hover:to-red-700',
    'green' => 'from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600',
];
$bgColor = $colors[$color] ?? $colors['blue'];
@endphp

<button {{ $attributes->merge(['class' => "w-8 h-8 inline-flex items-center justify-center rounded-lg bg-gradient-to-br {$bgColor} text-white shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300", 'title' => $title]) }}>
    <i class="{{ $icon }} text-xs drop-shadow"></i>
</button>