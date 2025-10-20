@extends('layouts.auth')

@section('content')
<x-button variant="tertiary" style="fill" padding="sm" href="{{ route('landing') }}" class="fixed lg:hidden top-10 left-10 z-50">
    <svg xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2" 
            class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" 
                d="M9 15l-6-6 6-6M3 9h10a6 6 0 010 12h-3" />
    </svg>
</x-button>
<div class="bg-white px-12 py-8 w-full lg:w-[65%] flex justify-center items-center ">

    <form action="{{ route('login.post') }}" method="POST" class="w-full space-y-4">
        @csrf

        <h2 class="text-center text-4xl font-bold">Welcome Back</h2>
        <p class="text-gray-500 mb-6 text-center">Sign in to continue managing your studio.</p>

        <x-input 
            label="Username/Email" 
            name="usn-email" 
            placeholder="Username/Email" 
        />
        @error('usn-email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-input 
            type="password" 
            label="Password" 
            name="password" 
            placeholder="Password" 
        />
        @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="flex items-center space-x-2">
            <input id="remember" type="checkbox" name="remember" class="rounded text-blue-600" />
            <label for="remember" class="text-sm">Remember Me</label>
        </div>

        <x-button type="submit" variant="primary" style="fill" class="w-full justify-center items-center">
            Log In
        </x-button>

        <p class="text-sm text-gray-500 mt-4 text-center">
            Don’t have an account? <a href="{{ route('signup') }}" class="text-blue-600">Sign Up</a>
        </p>
    </form>
</div>
@endsection

@if (session('error'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-init="setTimeout(() => show = false, 8000)"
        class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-start justify-between space-x-4 w-[300px]"
        x-transition
    >
        <span>{{ session('error') }}</span>
        <button 
            @click="show = false" 
            class="text-white text-lg font-bold leading-none focus:outline-none hover:text-gray-200"
        >
            &times;
        </button>
    </div>
@endif

@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-init="setTimeout(() => show = false, 8000)"
        class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-start justify-between space-x-4 w-[300px]"
        x-transition
    >
        <span>{{ session('success') }}</span>
        <button 
            @click="show = false" 
            class="text-white text-lg font-bold leading-none focus:outline-none hover:text-gray-200"
        >
            &times;
        </button>
    </div>
@endif

