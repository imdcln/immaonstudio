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

<div class="bg-white px-12 py-8 w-full lg:w-[65%] flex justify-center items-center">
    <form 
        action="{{ route('signup.post') }}" 
        method="POST" 
        class="w-full space-y-4" 
        x-data="{
            step: 1,
            form: {
                username: '',
                email: '',
                password: ''
            },
            validateStep1() {
                const emailValid = /^[^@]+@[^@]+\.[^@]+$/.test(this.form.email);
                return (
                    this.form.username.trim() !== '' &&
                    emailValid &&
                    this.form.password.trim().length >= 6
                );
            }
        }"
    >
        @csrf

        <!-- Step 1 -->
        <div class="w-full space-y-2" x-show="step === 1" x-transition>
            <h2 class="text-center text-4xl font-bold">Get Started</h2>
            <p class="text-gray-500 mb-6 text-center">Join now and manage your studio schedule</p>

            <x-input label="Username" name="username" placeholder="Username" x-model="form.username" required />
            <x-input type="email" label="Email" name="email" placeholder="Email Address" x-model="form.email" required />
            <x-input type="password" label="Password" name="password" placeholder="Password" x-model="form.password" required />

            <div class="flex items-center space-x-2 mt-1">
                <input id="remember" type="checkbox" class="rounded text-blue-600" />
                <label for="remember" class="text-sm">Remember Me</label>
            </div>

            <p class="text-sm mb-1">
                By signing up, you are creating an account and you agree to our 
                <a href="#" class="text-blue-600">Terms</a> and 
                <a href="#" class="text-blue-600">Global Privacy Statement</a>.
            </p>

            <!-- Fixed Next Button -->
            <x-button 
                type="button" 
                variant="primary" 
                class="w-full justify-center items-center"
                @click="
                    if (validateStep1()) {
                        step = 2;
                    } else {
                        alert('Please fill out all fields correctly before continuing.\n\nRequirements:\n- Username required\n- Valid email format\n- Password min. 6 characters');
                    }
                "
            >
                Next
            </x-button>

            <p class="text-sm text-gray-500 mt-4 text-center">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-600">Sign In</a>
            </p>
        </div>

        <!-- Step 2 -->
        <div class="w-full space-y-2" x-show="step === 2" x-transition>
            <h2 class="text-center text-4xl font-bold">Personalize Account</h2>
            <p class="text-gray-500 mb-6 text-center">Please provide us your personal information to set up your account.</p>

            <div class="grid grid-cols-2 gap-4">
                <x-input label="First Name" name="first_name" placeholder="First Name" />
                <x-input label="Last Name" name="last_name" placeholder="Last Name" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-input label="Phone Number" name="phone" placeholder="+62 999-9999-9999" />
                <x-input type="date" label="Birth Date" name="birth_date" />
            </div>
            <x-input label="Position" name="position" placeholder="Position" />

            <div>
                <span class="text-sm font-medium text-gray-700">Gender</span>
                <div class="flex space-x-4 my-1">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="male" class="text-blue-600">
                        <span>Male</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="female" class="text-blue-600">
                        <span>Female</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="other" class="text-blue-600">
                        <span>Rather Not Say</span>
                    </label>
                </div>
            </div>

            <div class="flex space-x-4">
                <x-button type="button" variant="secondary" class="w-full justify-center items-center" @click="step = 1">
                    ← Back
                </x-button>

                <x-button type="submit" variant="primary" class="w-full justify-center items-center">
                    Sign Up
                </x-button>
            </div>

            <p class="text-s text-gray-400">
                *Skipping this step will not grant you the permission to request a reservation.
            </p>

            <a href="{{ route('landing') }}" class="text-sm text-gray-500 hover:text-blue-600 flex items-center justify-end">
                Skip This Step* →
            </a>
        </div>
    </form>
</div>
@endsection
