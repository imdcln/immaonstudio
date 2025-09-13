@props([
    'image' => null,
    'title' => 'Card Title',
    'description' => null,
    'link' => null,
    'linkLabel' => null,
])

<div class="rounded-2xl shadow-lg overflow-hidden bg-white dark:bg-gray-800">
    {{-- Image --}}
    @if ($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @endif

    {{-- Content --}}
    <div class="p-4">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ $title }}
        </h3>

        @if ($description)
            <p class="text-gray-600 dark:text-gray-300 mt-2">
                {{ $description }}
            </p>
        @endif

        @if ($link && $linkLabel)
            <a href="{{ $link }}" 
               class="mt-4 inline-block text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-300">
                {{ $linkLabel }} →
            </a>
        @endif
    </div>
</div>
