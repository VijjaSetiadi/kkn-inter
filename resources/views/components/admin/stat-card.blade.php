{{-- resources/views/components/admin/stat-card.blade.php --}}
@props(['label', 'value', 'icon', 'color' => 'blue'])

@php
$gradients = [
    'blue' => 'from-blue-700 to-blue-500',
    'yellow' => 'from-yellow-600 to-yellow-500',
    'cyan' => 'from-cyan-600 to-cyan-400',
    'green' => 'from-green-600 to-green-500',
    'red' => 'from-red-600 to-red-500',
];
$gradient = $gradients[$color] ?? $gradients['blue'];
@endphp

<div class="bg-gradient-to-br {{ $gradient }} rounded-lg p-5 text-white shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer relative overflow-hidden group">
    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full transform translate-x-1/3 -translate-y-1/3 group-hover:scale-110 transition-transform duration-300"></div>
    
    <div class="relative z-10">
        <div class="flex justify-between items-center">
            <div>
                <h6 class="text-xs font-bold uppercase tracking-wide mb-2 text-white/95">{{ $label }}</h6>
                <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">{{ $value }}</h2>
            </div>
            <div class="text-4xl md:text-5xl opacity-90 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                <i class="{{ $icon }} drop-shadow-lg"></i>
            </div>
        </div>
    </div>
</div>