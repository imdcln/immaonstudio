@props([
    'variant' => 'primary',   // primary | secondary | tertiary
    'style' => 'fill',        // fill | outline
    'href' => '#',            // link destination
])

@php
$baseClasses = "inline-flex items-center gap-2 px-6 py-2 rounded-full font-semibold shadow-sm transition duration-300";

$styles = [
    'primary' => [
        'fill' => "bg-blue-600 text-white hover:bg-blue-700 shadow-md",
        'outline' => "border border-blue-600 text-blue-600 bg-transparent hover:bg-blue-50 hover:shadow-md",
    ],
    'secondary' => [
        'fill' => "bg-red-600 text-white hover:bg-red-700 shadow-md",
        'outline' => "border border-red-600 text-red-600 bg-transparent hover:bg-red-50 hover:shadow-md",
    ],
    'tertiary' => [
        'fill' => "bg-black text-white hover:bg-gray-900 shadow-md",
        'outline' => "border border-black text-black bg-transparent hover:bg-gray-100 hover:shadow-md",
    ],
];

$finalClasses = $baseClasses . ' ' . ($styles[$variant][$style] ?? $styles['primary']['fill']);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $finalClasses]) }}>
    <span>{{ $slot }}</span>
    @if (isset($icon))
        <span class="ml-1">{{ $icon }}</span>
    @endif
</a>


{{-- Example Usage:

No Icon
<x-button variant="primary" style="fill" href="/get-started">
    Get Started
</x-button>

With Icon
<x-button variant="tertiary" style="fill" href="/explore">
    Explore
    <x-slot:icon>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </x-slot:icon>
</x-button> --}}