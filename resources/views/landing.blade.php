@extends('layouts.guest')

@section('content')

{{-- Hero Section --}}
<div class="bg-gradient-to-b from-white from-30% to-blue-600">
    <section class="text-center py-20">
    <h1 class="text-4xl md:text-5xl font-bold">
        Book Your School <span class="text-blue-600">Studio</span><br>
        Easily and Quickly
    </h1>
    <p class="mt-4 text-gray-600 max-w-xl mx-auto">
        An online reservation system to support learning, practice, and creativity at your school.
    </p>
    <x-button variant="tertiary" style="fill" href="{{ route('signup' ) }}" class="mt-6">
        Get Started
        <x-slot:icon>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </x-slot:icon>
    </x-button>
</section>

{{-- Cards Section --}}
<section class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto px-6 py-12">
    <x-card 
        image="{{ asset('images/Ekskul Band.png') }}"
        title="Ekskul Band"
        description="Practice modern band instruments and build teamwork while preparing performances for school events."
    />
    <x-card 
        image="{{ asset('images/MTC Club.png') }}"
        title="MTC Club"
        description="A place to learn traditional music and explore creativity with friends through regular extracurricular sessions."
    /> 
    <x-card 
        image="{{ asset('images/Competition Practice.png') }}"
        title="Competition Club"
        description="Focused training sessions to prepare students for music competitions, both inside and outside the school."
    />
</section>
</div>

@endsection
