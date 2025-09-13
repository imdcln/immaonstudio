@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge([
        'class' => 'relative transition-colors duration-300 hover:text-blue-600
                    after:content-[""] after:absolute after:left-0 after:bottom-0
                    after:h-[2px] after:w-0 after:bg-blue-600 after:transition-all
                    after:duration-300 hover:after:w-full' .
                    ($active ? ' text-blue-600 after:w-full' : '')
   ]) }}>
    {{ $slot }}
</a>

{{-- Example Usage:
<x-link href="{{ route('about') }}" :active="request()->routeIs('about')">
    About Us
</x-link> --}}