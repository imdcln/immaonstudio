@props([
    'variant' => 'primary',   // primary | secondary | tertiary | gradient
    'style' => 'fill',        // fill | outline
    'href' => null,           // link
    'type' => 'button',       // button | submit
    'padding' => 'lg',        // sm | md | lg
])

@php
$baseClasses = "inline-flex items-center justify-center gap-2 rounded-full font-semibold shadow-sm transition duration-300 cursor-pointer";

$paddings = [
    'sm' => 'px-2 py-2',
    'md' => 'px-4 py-2',
    'lg' => 'px-5 py-3',
];

$styles = [
    'primary' => [
        'fill' => "bg-blue-600 text-white hover:bg-blue-700 shadow-md",
        'white' => "bg-white text-blue-600 hover:bg-blue-100 shadow-md",
        'outline' => "ring-1 ring-inset ring-blue-600 text-blue-600 bg-transparent hover:bg-blue-50 hover:shadow-md",
    ],
    'secondary' => [
        'fill' => "bg-red-600 text-white hover:bg-red-700 shadow-md",
        'outline' => "ring-1 ring-inset ring-red-600 text-red-600 bg-transparent hover:bg-red-50 hover:shadow-md",
    ],
    'tertiary' => [
        'fill' => "bg-black text-white hover:bg-gray-900 shadow-md",
        'outline' => "ring-1 ring-inset ring-black text-black bg-transparent hover:bg-gray-100 hover:shadow-md",
    ],
    'gradient' => [
        'fill' => "bg-gradient-to-r from-blue-300 to-blue-700 text-white shadow-md hover:from-blue-400 hover:to-blue-800",
        'outline' => "ring-1 ring-inset ring-blue-500 text-blue-600 bg-transparent hover:bg-blue-50 hover:shadow-md",
    ],
];

$finalClasses = $baseClasses
    . ' ' . $paddings[$padding]
    . ' ' . ($styles[$variant][$style] ?? $styles['primary']['fill']);
@endphp

@if ($href)
    {{-- Link button --}}
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $finalClasses, 'role' => 'button']) }}>
        {{ $slot }}
    </a>
@else
    {{-- Normal button --}}
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $finalClasses]) }}>
        {{ $slot }}
    </button>
@endif
