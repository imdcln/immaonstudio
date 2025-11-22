<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ImmaOnStudio</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon_io/site.webmanifest')}}">
    
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased bg-white text-gray-900 w-full min-h-screen flex flex-col">
    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @if (session('success') || session('error'))
        <div 
            x-data="{ 
                show: true, 
                message: '{{ session('success') ?? session('error') }}', 
                type: '{{ session('success') ? 'success' : 'error' }}' 
            }"
            x-show="show"
            x-transition.opacity.duration.300ms
            class="fixed inset-0 flex items-center justify-center z-50 bg-black/40"
            x-init="setTimeout(() => show = false, 1500)"
        >
            <div 
                :class="{
                    'bg-white text-green-700 border-green-400': type === 'success',
                    'bg-white text-red-700 border-red-400': type === 'error'
                }"
                class="w-[90%] max-w-md rounded-2xl border shadow-xl p-6 text-center relative"
            >
                <!-- Icon -->
                <div class="flex justify-center mb-3">
                    <template x-if="type === 'success'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </template>

                    <template x-if="type === 'error'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </template>
                </div>

                <!-- Message -->
                <h2 class="text-lg font-semibold" x-text="type === 'success' ? 'Success!' : 'Error'"></h2>
                <p class="mt-1 text-sm" x-text="message"></p>

                <!-- Close button -->
                <button 
                    @click="show = false" 
                    class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl leading-none"
                >
                    &times;
                </button>
            </div>
        </div>
    @endif

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out',
        });
    </script>

    {{-- Popup Function --}}
    @include('components.popup')

</body>
</html>
