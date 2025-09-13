@extends('layouts.auth')

@section('content')
<div class="bg-white px-12 py-8 w-full lg:w-[65%] flex justify-center items-center">
    <form action="{{ route('login.post') }}" method="POST" class="w-full space-y-4">
        @csrf

        <h2 class="text-center text-4xl font-bold">Welcome Back</h2>
        <p class="text-gray-500 mb-6 text-center">Sign in to continue managing your studio</p>

        <x-input 
            label="Username/Email" 
            name="usn-email" 
            placeholder="Username/Email" 
        />
        @error('email')
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
