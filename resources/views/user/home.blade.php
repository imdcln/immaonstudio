@extends('layouts.app')

@php
$starSvg = <<<SVG
<svg class="w-4 h-4 text-black-900" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path d="M23.9988 40.212L12.3651 47.5499C11.8511 47.8923 11.3138 48.0391 10.7532 47.9902C10.1925 47.9413 9.70191 47.7456 9.28142 47.4031C8.86092 47.0607 8.53387 46.6331 8.30026 46.1205C8.06665 45.6078 8.01993 45.0325 8.16009 44.3946L11.2437 30.5259L0.941565 21.2067C0.474346 20.7664 0.182802 20.2645 0.0669313 19.7009C-0.0489389 19.1374 -0.0143649 18.5875 0.170654 18.0514C0.355672 17.5152 0.636003 17.0749 1.01165 16.7305C1.38729 16.3861 1.90123 16.166 2.55347 16.0701L16.1495 14.8227L21.4057 1.76111C21.6394 1.17407 22.0019 0.733794 22.4934 0.440277C22.9849 0.146759 23.4867 0 23.9988 0C24.5109 0 25.0127 0.146759 25.5042 0.440277C25.9957 0.733794 26.3583 1.17407 26.5919 1.76111L31.8481 14.8227L45.4441 16.0701C46.0982 16.1679 46.6122 16.3881 46.986 16.7305C47.3597 17.073 47.6401 17.5132 47.827 18.0514C48.0138 18.5895 48.0494 19.1403 47.9335 19.7039C47.8176 20.2674 47.5251 20.7684 47.056 21.2067L36.7539 30.5259L39.8375 44.3946C39.9777 45.0305 39.931 45.6058 39.6974 46.1205C39.4637 46.6351 39.1367 47.0627 38.7162 47.4031C38.2957 47.7436 37.8051 47.9393 37.2445 47.9902C36.6838 48.041 36.1465 47.8943 35.6325 47.5499L23.9988 40.212Z"/>
</svg>
SVG;

$reviewsToDisplay = $reviews ?? collect();

@endphp

@section('content')
{{-- Hero Section --}}
<section 
    class="flex flex-col md:flex-row items-center justify-between px-6 md:px-20 py-16 bg-white overflow-hidden"
>
    <div class="max-w-[700px] space-y-6 text-center md:text-left" data-aos="fade-right">
        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
            Your Creative Journey<br>Starts Here
        </h1>
        <p class="text-gray-600 text-lg">
            Book your music studio easily and hassle-free. Choose your preferred schedule, enjoy a comfortable space
            with complete facilities, and focus on what matters most—your creativity. Simple and convenient.
        </p>
        <x-button variant="gradient" href="{{ route('reserve') }}">
            Reserve Studio →
        </x-button>
    </div>
    <img 
        src="{{ asset('images/illustration_2.png') }}" 
        alt="Creative Studio Illustration" 
        class="w-64 md:w-72 lg:w-96 xl:w-[32rem] object-contain"
        data-aos="zoom-in"
    >
</section>

{{-- Creative Space Section --}}
<section class="bg-blue-700 text-white py-16 px-6 md:px-20">
    <div class="flex flex-col md:flex-row items-center justify-between gap-12">
        {{-- Collage Images --}}
        <div class="hidden md:flex flex-col space-y-6" data-aos="fade-right">
            {{-- First Row --}}
            <div class="flex items-end space-x-6">
                <img src="{{ asset('images/about-1.jpg') }}" 
                        alt="Studio Image 1" 
                        class="w-40 lg:w-48 h-40 lg:h-48 object-cover rounded-xl shadow-lg transition duration-300 hover:shadow-[0_0_15px_rgba(255,255,255,0.4)]">
                <img src="{{ asset('images/about-2.jpg') }}" 
                        alt="Studio Image 2" 
                        class="w-48 lg:w-64 h-48 lg:h-64 object-cover rounded-xl shadow-lg transition duration-300 hover:shadow-[0_0_15px_rgba(255,255,255,0.4)]">
            </div>

            {{-- Second Row --}}
            <div class="flex items-start space-x-6 pl-8 lg:pl-12">
                <img src="{{ asset('images/about-3.jpg') }}" 
                        alt="Studio Image 3" 
                        class="w-48 lg:w-64 h-48 lg:h-64 object-cover rounded-xl shadow-lg transition duration-300 hover:shadow-[0_0_15px_rgba(255,255,255,0.4)]">
                <img src="{{ asset('images/about-4.jpg') }}" 
                        alt="Studio Image 4" 
                        class="w-40 lg:w-48 h-40 lg:h-48 object-cover rounded-xl shadow-lg transition duration-300 hover:shadow-[0_0_15px_rgba(255,255,255,0.4)]">
            </div>
        </div>

        {{-- Text Content --}}
        <div class="max-w-xl space-y-4 text-center md:text-left" data-aos="fade-left">
            <h2 class="text-5xl md:text-6xl lg:text-5xl font-bold leading-snug">
                Find Your Creative Space
            </h2>
            <p class="text-blue-100 text-base md:text-lg">
                Book a studio with professional equipment and inspiring atmosphere for your best creations.
            </p>

            <div class="flex justify-center md:justify-start items-center gap-8 text-lg font-semibold">
                <div data-aos="zoom-in" data-aos-delay="150">
                    <span class="text-4xl font-bold">2</span>
                    <p class="text-sm uppercase tracking-wide text-blue-200">
                        Total Reservation<br>Today
                    </p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300">
                    <span class="text-4xl font-bold">6</span>
                    <p class="text-sm uppercase tracking-wide text-blue-200">
                        Operating Hours<br>Per Day
                    </p>
                </div>
            </div>
            <x-button variant="secondary" href="{{ route('reserveList') }}">
                Reservation List →
            </x-button>
        </div>
    </div>
</section>

{{-- Reviews Section --}}
<section class="py-20 px-6 md:px-20 bg-white">
    <h2 class="text-5xl md:text-6xl font-bold text-center mb-10" data-aos="fade-up">
        What people says about ImmaOnStudio
    </h2>

    <div class="px-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse ($reviewsToDisplay as $index => $review)
            <div 
                class="border rounded-2xl p-6 shadow-sm hover:shadow-md transition flex flex-col h-full"
                data-aos="fade-up"
                data-aos-delay="{{ $index * 150 }}"
            >
                {{-- Star Rating Display (MODIFIED) --}}
                <div class="flex gap-x-2 items-center mb-4">
                    {{-- Loop 5 times to display all 5 stars --}}
                    @for ($i = 1; $i <= 5; $i++)
                        @php
                            // Determine the class based on the current star number ($i) vs. the review rating
                            $starColorClass = $i <= $review->rating ? 'text-blue-600' : 'text-gray-300';
                        @endphp
                        
                        {{-- Output the star SVG with the dynamic color class --}}
                        <span class="{{ $starColorClass }}">
                            {!! $starSvg !!}
                        </span>
                    @endfor
                </div>

                <p class="text-gray-600 mb-4 line-clamp-4">
                    {{ $review->review ?? 'Great experience!' }}
                </p>
                
                {{-- User Info (Anchored to bottom) --}}
                <div class="flex items-center gap-3 mt-auto">
                    {{-- Profile Picture --}}
                    <img 
                        src="{{ $review->user->profile_picture 
                            ? asset('images/profiles/' . $review->user->profile_picture . '.jpg') 
                            : asset('images/default_profile_picture.webp') }}" 
                        alt="{{ $review->user->username ?? 'Reviewer' }}" 
                        class="w-10 h-10 rounded-full object-cover"
                    >
                    <div>
                        <p class="font-semibold text-gray-800">{{ $review->user->username ?? 'Guest User' }}</p>
                        <p class="text-gray-500 text-sm">Member</p>
                    </div>
                </div>
            </div>
        @empty
            {{-- Fallback if no reviews are available --}}
            <p class="col-span-full text-center text-gray-500">No reviews yet. Be the first to share your experience!</p>
        @endforelse
    </div>

    <p class="text-center text-gray-600 mt-10 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="{{ $reviewsToDisplay->count() * 150 }}">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    </p>

    <div class="text-center mt-8" data-aos="zoom-in">
        <x-button variant="gradient" href="{{ route('reviews') }}">
            More About Reviews →
        </x-button>
    </div>
</section>
@endsection