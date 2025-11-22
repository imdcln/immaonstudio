@extends('layouts.app')

@section('content')
{{-- About Section --}}
<section class="container mx-auto px-8 lg:px-16 py-16 text-center">
    <h1 class="text-7xl font-extrabold mb-10" data-aos="fade-up">About Us</h1>

    <div class="w-full bg-gray-200 rounded-2xl h-72 mb-10" data-aos="fade-up"></div>

    <p class="max-w-3xl mx-auto text-gray-600 text-lg leading-relaxed" data-aos="fade-up">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.
    </p>
</section>

{{-- Meet the Team --}}
<section 
    x-data="{ selectedImage: null }" 
    class="container mx-auto px-12 lg:px-24 py-16 text-center"
>
    <h2 class="text-5xl font-bold mb-12" data-aos="fade-up">Meet the Team</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 justify-center" data-aos="fade-up">
        @php
            $team = [
                ['name' => 'Declane Joseph D.', 'role' => 'Founder', 'image' => 'default_team.webp'],
                ['name' => 'Silviana Febrianti', 'role' => 'Co-Founder', 'image' => 'default_team.webp'],
                ['name' => 'Jason Valentino P.', 'role' => 'Co-Founder', 'image' => 'default_team.webp'],
                ['name' => 'Ying Er Aleitheia F.', 'role' => 'Tester', 'image' => 'default_team.webp'],
                ['name' => 'Lorem Ipsum Dolor', 'role' => 'Lorem Ipsum Dolor', 'image' => 'default_team.webp'],
                ['name' => 'Lorem Ipsum Dolor', 'role' => 'Lorem Ipsum Dolor', 'image' => 'default_team.webp'],
            ];
        @endphp

        @foreach ($team as $member)
            <div 
                @click="selectedImage = '{{ asset('images/' . $member['image']) }}'"
                class="relative rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 aspect-[4/5] flex items-end text-left text-white group cursor-pointer"
                style="background: url('{{ asset('images/' . $member['image']) }}') center/cover no-repeat;"
            >
                {{-- Zoom effect --}}
                <div class="absolute inset-0 bg-center bg-cover transition-transform duration-500 group-hover:scale-105" 
                    style="background-image: url('{{ asset('images/' . $member['image']) }}')">
                </div>

                {{-- Gradient overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent group-hover:from-black/80 transition duration-300"></div>

                {{-- Text content --}}
                <div class="relative z-10 p-6">
                    <p class="text-lg font-semibold">{{ $member['name'] }}</p>
                    <p class="text-md opacity-80">{{ $member['role'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Popup Modal --}}
    <div 
        x-show="selectedImage" 
        x-transition.opacity 
        class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4"
    >
        <div 
            @click.away="selectedImage = null"
            class="relative bg-white rounded-xl overflow-hidden max-w-lg w-full aspect-[4/5]"
        >
            <img 
                :src="selectedImage" 
                alt="Team Member" 
                class="w-full h-full object-cover"
            >
            <button 
                @click="selectedImage = null" 
                class="absolute top-3 right-3 bg-black/60 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-black/80 transition"
            >
                ✕
            </button>
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="container mx-auto px-8 lg:px-16 py-16">
    <div class="grid md:grid-cols-2 gap-10 items-start">
        <div data-aos="fade-right">
            <h2 class="text-5xl font-bold mb-4">Frequently Asked Questions</h2>
            <p class="text-gray-600 mb-6">Can’t find the answer you are looking for? Don’t worry reach with us.</p>
            <x-button variant="gradient" href="{{ route('contact') }}">
                Ask Your Question →
            </x-button>
        </div>

        {{-- Accordion --}}
		<div x-data="{ open: 1 }" data-aos="fade-left" class="space-y-4">
        @for ($i = 1; $i <= 4; $i++)
            <div class="border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <button 
                    @click="open === {{ $i }} ? open = null : open = {{ $i }}" 
                    :class="open === {{ $i }} 
                        ? 'bg-gradient-to-r from-blue-300 to-blue-700 text-white shadow-md hover:from-blue-400 hover:to-blue-800' 
                        : 'bg-white text-gray-800 hover:bg-gray-50'" 
                    class="flex justify-between items-center w-full p-4 text-left font-semibold transition-all duration-300">
                    <span>Lorem Ipsum Dolor Sit Amet?</span>
                    <span x-text="open === {{ $i }} ? '−' : '+'"></span>
                </button>

                <div 
                    x-show="open === {{ $i }}" 
                    x-collapse.duration.300ms 
                    class="px-4 py-4 text-gray-600 text-sm leading-relaxed bg-gray-50"
                >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.
                </div>
            </div>
        @endfor
    </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="container mx-auto px-6 lg:px-16 py-20">
    <div class="relative rounded-2xl overflow-hidden shadow-lg" data-aos="fade-up">
        <img src="{{ asset('images/smk_building.webp') }}" alt="Office Building" 
             class="absolute inset-0 w-full h-full object-cover brightness-[35%]">
        <div class="relative z-10 text-center text-white py-20 px-6">
            <h2 class="text-4xl font-extrabold mb-4">Simple, Fast, Organized.</h2>
            <p class="max-w-2xl mx-auto text-base mb-8">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.
            </p>
            <x-button variant="gradient" href="{{ route('reserve') }}">
                Start Your Reservation →
            </x-button>
        </div>
    </div>
</section>
@endsection
