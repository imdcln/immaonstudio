<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmaOnStudio</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon_io/site.webmanifest') }}">
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    {{-- Popup Function --}}
    @include('components.popup')

    <main>
        <div class="w-full max-h-screen min-h-screen flex shadow-xl overflow-hidden bg-white">
            <!-- Left Side -->
            <div class="lg:flex hidden box-border w-[35%] bg-gradient-to-br from-blue-300 to-blue-700 text-white flex-col justify-start items-start p-8">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('landing') }}"><img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" class="rounded-lg shadow-md w-auto h-12"></a>
                    <a href="{{ route('landing') }}"><span class="font-bold text-2xl text-shadow">ImmaOnStudio</span></a>
                </div>
                <div>
                    <h1 class="text-5xl font-extrabold leading-snug mt-6 mb-2">Simple,<br>Fast,<br>Organized</h1>
                </div>
                <div class="h-[47%] w-full flex items-center justify-center">
                    <img src="{{ asset('images/illustration_1.png') }}" alt="Illustration" class="max-h-[250px] w-auto h-auto"/>
                </div>
            </div>

            <!-- Right Side -->
            @yield('content')
        </div>
    </main>
</body>
</html>
