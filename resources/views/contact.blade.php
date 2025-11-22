@extends('layouts.app')

@section('content')
<section class="container mx-auto px-8 lg:px-24 py-20 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    {{-- Left Side --}}
    <div data-aos="fade-right">
        <h2 class="text-7xl font-bold leading-tight mb-6">Let’s get<br>in touch</h2>
        <p class="text-xl font-semibold mb-6">Don’t be afraid to<br>say hello with us!</p>

        <div class="space-y-6">
            <div>
                <p class="text-gray-700">Phone</p>
                <p class="font-semibold text-gray-800">+(62) 813-4772-1109</p>
            </div>
            <div>
                <p class="text-gray-700">Email</p>
                <p class="font-semibold text-gray-800">immaonstudio@gmail.com</p>
            </div>
            <div>
                <p class="text-gray-700">Office</p>
                <p class="font-semibold text-gray-800">
                    Jl. Letnan Jendral Sutoyo, <br>
                    Parit Tokaya, Kec. Pontianak Selatan, <br>
                    Kota Pontianak, Kalimantan Barat 78121
                </p>
            </div>
        </div>
    </div>

    {{-- Right Side --}}
    <div data-aos="fade-left">
        <h3 class="text-3xl text-center font-bold mb-6">Contact</h3>

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 flex-col flex">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input label="Name" name="name" placeholder="Name" />
                <x-input type="email" label="Email" name="email" placeholder="Email" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input type="phone" label="Phone Number" name="phone" placeholder="812-3456-7890" />
			<x-input 
				type="select" 
				label="Class" 
				name="class" 
				placeholder="Select Class"
				:options="$classes"
			/>
			</div>

            <div>
                <label for="message" class="text-sm font-medium text-gray-700">Tell us about your interest</label>
                <textarea id="message" name="message" rows="4" 
                    class="w-full border-gray-300 rounded-2xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
            </div>

            <x-button type="submit" variant="gradient" style="fill" class="w-full md:w-auto justify-center">
                Send to Us
            </x-button>
        </form>
    </div>
</section>

@if ($errors->any())
    <div x-data x-init="
        popup(
            `{!! implode('\n', $errors->all()) !!}`,
            'error'
        )
    "></div>
@endif

@endsection

