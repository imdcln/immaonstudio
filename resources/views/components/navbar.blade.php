<nav class="flex items-center justify-between px-8 py-4 shadow-s">
    <div class="flex items-center space-x-2 w-1/2 md:w-[38%]">
        <a href="#"><img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" class="h-10 rounded-lg shadow-md"></a>
        <a href="#"><span class="font-bold text-xl text-shadow">ImmaOnStudio</span></a>
    </div>

    <div class="hidden md:flex justify-center space-x-6 w-[24%]">
    <x-link href="{{ route('about') }}">
        About Us
    </x-link>
    <x-link href="{{ route('contact') }}">
        Contact
    </x-link>
    </div>

    <div class="flex justify-end space-x-3 w-1/2 md:w-[38%]">
        <x-button variant="primary" style="outline" href="{{ route('login') }}">
            Sign In
        </x-button>
        <x-button variant="primary" style="fill" href="{{ route('signup') }}">
            Get Started
        </x-button>
    </div>
</nav>
