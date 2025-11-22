<!-- Navbar -->
<nav 
    x-data="{
        mobileMenuOpen: false,
        activeLink: '{{ request()->route()->getName() }}', 
        hoverLink: null
        }" 
    class="sticky top-0 z-50 flex gap-4 items-center justify-between px-4 md:px-8 py-4 bg-white shadow-sm col-2"
>
    <!-- Left logo -->
    <!-- Mobile menu button -->
        <div class="md:hidden flex items-center">
            <button 
                @click="mobileMenuOpen = !mobileMenuOpen" 
                class="p-2 rounded-md hover:bg-gray-100 transition focus:outline-none"
                aria-label="Toggle navigation"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="h-6 w-6 text-gray-800" 
                     fill="none" 
                     viewBox="0 0 21 21" 
                     stroke="currentColor" 
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile dropdown -->
    <div 
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.outside="mobileMenuOpen = false"
        class="absolute top-full left-0 w-full bg-white shadow-md md:hidden z-50"
    >
        <div class="flex flex-col items-center space-y-3 pb-4">
            <x-link href="{{ route('home') }}" :active="request()->routeIs('home', 'landing')">Home</x-link>
            <x-link href="{{ route('about') }}" :active="request()->routeIs('about')">About Us</x-link>
            <x-link href="{{ route('reviews') }}" :active="request()->routeIs('reviews')">Reviews</x-link>
            <x-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact Us</x-link>

            @auth
            <x-link href="{{ route('home') }}" route="contact">Reservation List</x-link>
            <x-link class="font-semibold" href="{{ route('reserve') }}" :active="request()->routeIs('reserve')">Start Reservation</x-link>
            @endauth
        </div>
    </div>
    <div class="w-fit">
        <a class="flex items-center space-x-2" href="{{ Auth::check() ? route('home') : route('landing') }}">
            <img src="{{ asset('images/ImmaOnStudio Logo.png') }}" alt="Logo" class="max-w-10 h-10 w-10 rounded-lg shadow-md">
            <span class="font-bold text-xl text-shadow hidden lg:block">ImmaOnStudio</span>
        </a>
    </div>

    <!-- Right side (profile always visible + links/hamburger) -->
    <div class="flex items-center justify-end space-x-4 w-full">

        <!-- Desktop navigation -->
        <div class="flex items-center space-x-5">
            <div class="hidden md:flex items-center space-x-5">
                <x-link href="{{ route('home') }}" :active="request()->routeIs('home', 'landing')">Home</x-link>
                <x-link href="{{ route('about') }}" :active="request()->routeIs('about')">About Us</x-link>
                <x-link href="{{ route('reviews') }}" :active="request()->routeIs('reviews')">Reviews</x-link>
                <x-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact Us</x-link>

                @auth
                <x-link href="{{ route('reserveList') }}" :active="request()->routeIs('reserveList')" route="contact">Reservation List</x-link>
                <x-link class="font-semibold" href="{{ route('reserve') }}" :active="request()->routeIs('reserve')">Start Reservation</x-link>
                @endauth
            </div>

            @guest
                <x-button variant="primary" style="outline" padding="md" href="{{ route('login') }}">Sign In</x-button>
                <x-button variant="primary" style="fill" padding="md" href="{{ route('signup') }}">Get Started</x-button>
            @endguest
        </div>

        @auth
            @if(request()->routeIs('profile'))

                <!-- PROFILE HEADER NAV (LIKE YOUR IMAGE) -->
                <div class="flex items-center bg-[#EAF4FF] px-2 py-1 rounded-full shadow-sm gap-1">

                    <!-- Avatar -->
                    <img 
                        src="{{ asset('images/profiles/' . Auth::user()->profile_picture . '.jpg') }}"
                        class="w-8 h-8 rounded-full object-cover"
                    >

                    <div class="w-[2px] h-6 bg-gray-300 mx-3 rounded-full"></div>

                    <!-- Username + Role -->
                    <div class="flex flex-col leading-tight mr-4">
                        <span class="font-semibold text-sm">{{ Auth::user()->username }}</span>
                        <span class="text-blue-500 text-xs">{{ Auth::user()->role->role }}</span>
                    </div>

                    <!-- Arrow -->
                    <svg class="w-6 h-6 text-gray-800"
                        fill="none" viewBox="0 0 32 32">
                        <path 
                            fill-rule="evenodd" 
                            clip-rule="evenodd"
                            d="M17.4133 21.4133C17.0383 21.7879 16.53 21.9982 16 21.9982C15.47 21.9982 14.9617 21.7879 14.5867 21.4133L7.04266 13.872C6.66764 13.4968 6.45703 12.988 6.45715 12.4575C6.45728 11.927 6.66813 11.4183 7.04332 11.0433C7.41852 10.6683 7.92732 10.4577 8.45779 10.4578C8.98827 10.4579 9.49697 10.6688 9.87199 11.044L16 17.172L22.128 11.044C22.505 10.6795 23.0101 10.4777 23.5345 10.482C24.0589 10.4863 24.5607 10.6964 24.9316 11.067C25.3026 11.4377 25.5132 11.9392 25.518 12.4636C25.5228 12.988 25.3215 13.4933 24.9573 13.8707L17.4147 21.4147L17.4133 21.4133Z"
                            fill="black"
                        />
                    </svg>
                </div>

            @else
                <!-- DEFAULT NAVBAR DROPDOWN (EXISTING CODE) -->
                <div 
                    x-data="{ userMenuOpen: false }" 
                    class="relative flex items-center gap-1 cursor-pointer select-none"
                >
                    <div 
                        class="flex items-center gap-1 transition-all duration-300"
                    >
                    <a href="{{ route('profile', Auth::user()->username) }}">
                        <img 
                            class="w-10 h-10 rounded-full object-cover transition-all duration-300 shadow-md hover:scale-105"
                            src="{{ asset('images/profiles/' . Auth::user()->profile_picture) . '.jpg' }}"
                            alt="{{ Auth::user()->name }}"
                        >
                    </a>

                        <svg 
                            @click="userMenuOpen = !userMenuOpen" 
                            :class="{ 'rotate-180': userMenuOpen }" 
                            class="w-5 h-5 transition-transform duration-300" 
                            viewBox="0 0 32 32" 
                            fill="none" 
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path 
                                fill-rule="evenodd" 
                                clip-rule="evenodd" 
                                d="M17.4133 21.4133C17.0383 21.7879 16.53 21.9982 16 21.9982C15.47 21.9982 14.9617 21.7879 14.5867 21.4133L7.04266 13.872C6.66764 13.4968 6.45703 12.988 6.45715 12.4575C6.45728 11.927 6.66813 11.4183 7.04332 11.0433C7.41852 10.6683 7.92732 10.4577 8.45779 10.4578C8.98827 10.4579 9.49697 10.6688 9.87199 11.044L16 17.172L22.128 11.044C22.505 10.6795 23.0101 10.4777 23.5345 10.482C24.0589 10.4863 24.5607 10.6964 24.9316 11.067C25.3026 11.4377 25.5132 11.9392 25.518 12.4636C25.5228 12.988 25.3215 13.4933 24.9573 13.8707L17.4147 21.4147L17.4133 21.4133Z" 
                                fill="#131515"
                            />
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div 
                        x-show="userMenuOpen" 
                        @click.away="userMenuOpen = false" 
                        x-transition.origin.top.right
                        class="absolute right-0 top-12 bg-white text-gray-700 shadow-lg rounded-xl py-2 min-w-[10rem] z-20"
                    >
                        <a href="{{ route('profile', Auth::user()->username) }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
</nav>