<nav 
    x-data="{ open: false }" 
    class="sticky top-0 z-50 flex items-center justify-between px-8 py-4 bg-white shadow-sm"
>
    <!-- Left logo -->
    <div class="flex items-center space-x-2 w-1/2 md:w-[30%]">
        <a href="#">
            <img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" class="max-w-10 h-10 w-10 rounded-lg shadow-md">
        </a>
        <a href="#">
            <span class="font-bold text-xl text-shadow">ImmaOnStudio</span>
        </a>
    </div>

    <!-- Desktop navigation -->
    <div class="hidden md:flex items-center justify-end space-x-3 w-1/2 md:w-[70%]">
        <x-link href="{{ route('contact') }}">About Us</x-link>
        <x-link href="{{ route('contact') }}">Reviews</x-link>
        <x-link href="{{ route('contact') }}">Contact Us</x-link>

        @guest
        <x-button variant="primary" style="outline" padding="md" href="{{ route('login') }}">Sign In</x-button>
        <x-button variant="primary" style="fill" padding="md" href="{{ route('signup') }}">Get Started</x-button>
        @endguest

        @auth

        @endauth
    </div>

    <!-- Menu -->
    <div class="md:hidden flex items-center">
        <button 
            @click="open = !open" 
            class="p-2 rounded-md hover:bg-gray-100 transition focus:outline-none"
            aria-label="Toggle navigation"
        >
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 text-gray-800" 
                 fill="none" 
                 viewBox="0 0 24 24" 
                 stroke="currentColor" 
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile dropdown -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.outside="open = false"
        class="absolute top-full left-0 w-full bg-white shadow-md md:hidden z-50"
    >
        <div class="flex flex-col items-center space-y-3 pb-4">
            <x-link href="{{ route('contact') }}">About Us</x-link>
            <x-link href="{{ route('contact') }}">Reviews</x-link>
            <x-link href="{{ route('contact') }}">Contact Us</x-link>

            @guest
            <x-link href="{{ route('login') }}">Sign in</x-link>
            <x-link href="{{ route('signup') }}">Get Started</x-link>
            @endguest

            @auth
            <x-link href="{{ route('signup') }}">Start Reservation</x-link>
            <x-link href="{{ route('signup') }}">Start Reservation</x-link>
            @endauth
        </div>
    </div>
</nav>