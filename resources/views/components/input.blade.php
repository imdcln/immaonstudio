@props([
    'type' => 'text',
    'label' => '',
    'name' => '',
    'placeholder' => '',
    'options' => [],
    'min' => null,
    'max' => null,
    'step' => 1,
    'prefix' => null,
])

<div class="flex flex-col space-y-1 w-full">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif

    {{-- Password with toggle --}}
    @if($type === 'password')
        <div x-data="{ show: false }" class="relative">
            <input 
                :type="show ? 'text' : 'password'"
                id="{{ $name }}"
                name="{{ $name }}"
                placeholder="{{ $placeholder }}"
                {{ $attributes->merge(['class' => 'w-full rounded-full border-gray-300 focus:ring-blue-500 focus:border-blue-500']) }}
            />
            <button type="button"
                @click="show = !show"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5" x-show="!show">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.98 8.223A10.477 10.477 0 001.5 12
                          c2.28 4.04 6.53 7 10.5 7s8.22-2.96
                          10.5-7a10.477 10.477 0 00-2.48-3.777M15
                          12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5" x-show="show">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.458 12C3.732 7.943 7.522 5
                          12 5c4.478 0 8.268 2.943 9.542
                          7-1.274 4.057-5.064 7-9.542
                          7-4.478 0-8.268-2.943-9.542-7z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

    {{-- Phone number with prefix --}}
    @elseif($type === 'phone')
        <div 
            x-data 
            x-init="$watch('$refs.phoneInput.value', value => {
                if (value.match(/^[06]/)) {
                    $refs.phoneInput.value = value.replace(/^[06]+/, '');
                }
            })"
            class="flex items-center rounded-full border border-gray-300 focus-within:ring-2 focus-within:ring-blue-500 bg-white overflow-hidden"
        >
            <span class="px-3 text-gray-500 text-sm select-none">+62</span>
            <input
                x-ref="phoneInput"
                type="tel"
                id="{{ $name }}"
                name="{{ $name }}"
                placeholder="{{ $placeholder ?: '812-3456-7890' }}"
                @input="if ($event.target.value.match(/^[06]/)) $event.target.value = $event.target.value.replace(/^[06]+/, '')"
                {{ $attributes->merge(['class' => 'flex-1 border-0 focus:ring-0 focus:outline-none rounded-r-full text-gray-700']) }}
            />
        </div>

    {{-- Select dropdown (generic) --}}
    @elseif($type === 'select')
        <select 
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes->merge(['class' => 'w-full rounded-full border-gray-300 focus:ring-blue-500 focus:border-blue-500']) }}
        >
            <option value="" disabled selected hidden>{{ $placeholder ?: 'Select option' }}</option>
            @foreach($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        </select>

    {{-- Number input --}}
    @elseif($type === 'number')
        <input 
            type="number"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            min="{{ $min }}"
            max="{{ $max }}"
            step="{{ $step }}"
            {{ $attributes->merge(['class' => 'w-full rounded-full border-gray-300 focus:ring-blue-500 focus:border-blue-500']) }}
        />

    {{-- Default text/email/date/etc --}}
    @else
        <input 
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full rounded-full border-gray-300 focus:ring-blue-500 focus:border-blue-500']) }}
        />
    @endif
</div>