@extends('layouts.auth')

@section('content')
{{-- Popup notifications --}}
@if (session('error'))
    <script> popup("{{ session('error') }}", "error"); </script>
@endif
@if (session('success'))
    <script> popup("{{ session('success') }}", "success"); </script>
@endif


<x-button 
    variant="tertiary" 
    style="fill" 
    padding="sm" 
    href="{{ route('landing') }}" 
    class="fixed lg:hidden top-10 left-10 z-50"
>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15l-6-6 6-6M3 9h10a6 6 0 010 12h-3" />
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
                password: '',
                password_confirmation: ''
            },
            validateStep1() {
                const emailValid = /^[^@]+@[^@]+\.[^@]+$/.test(this.form.email);
                if (this.form.username.trim() === '') return 'Username is required.';
                if (!emailValid) return 'Please enter a valid email address.';
                if (this.form.password.trim().length < 8) return 'Password must be at least 8 characters.';
                if (this.form.password !== this.form.password_confirmation) return 'Passwords do not match.';
                return null;
            }
        }"
    >
        @csrf

        <!-- STEP 1 -->
        <div class="w-full space-y-2" x-show="step === 1" x-transition>
            <h2 class="text-center text-4xl font-bold">Get Started</h2>
            <p class="text-gray-500 mb-6 text-center">Join now and manage your studio schedule</p>

            <x-input label="Username" name="username" placeholder="Username" x-model="form.username" required />
            <x-input type="email" label="Email" name="email" placeholder="Email Address" x-model="form.email" required />
            <x-input type="password" label="Password" name="password" placeholder="Password (min. 8 characters)" x-model="form.password" required />
            <x-input type="password" label="Confirm Password" name="password_confirmation" placeholder="Confirm Password" x-model="form.password_confirmation" required />

            <div class="flex items-center space-x-2 mt-1">
                <input id="remember" name="remember" type="checkbox" class="rounded text-blue-600" />
                <label for="remember" class="text-sm">Remember Me</label>
            </div>

            <p class="text-sm mb-1">
                By signing up, you agree to our 
                <a href="#" class="text-blue-600">Terms</a> and 
                <a href="#" class="text-blue-600">Privacy Statement</a>.
            </p>

            <x-button 
                type="button" 
                variant="gradient" 
                class="w-full justify-center items-center"
                @click="
                    const err = validateStep1();
                    if (!err) step = 2;
                    else popup(err, 'error');
                "
            >
                Next →
            </x-button>

            <p class="text-sm text-gray-500 mt-4 text-center">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-600">Sign In</a>
            </p>
        </div>

        <!-- STEP 2 -->
        <div class="w-full space-y-2" x-show="step === 2" x-transition>
            <h2 class="text-center text-4xl font-bold">Personalize Account</h2>
            <p class="text-gray-500 mb-6 text-center">Please provide your personal information.</p>

            <div class="grid grid-cols-2 gap-4">
                <x-input label="First Name" name="first_name" placeholder="First Name" />
                <x-input label="Last Name" name="last_name" placeholder="Last Name" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col space-y-1 w-full">
                    <label for="phone_number" class="text-sm font-medium text-gray-700">Phone Number</label>
                    <div class="flex rounded-full border border-gray-300 focus-within:ring-2 focus-within:ring-blue-500 overflow-hidden">
                        <span class="flex items-center px-3 bg-gray-100 text-gray-600 text-sm select-none">+62</span>
                        <input
                            type="tel"
                            id="phone_number"
                            name="phone_number"
                            placeholder="812-3456-7890"
                            class="w-full rounded-r-full border-0 focus:ring-0"
                        />
                    </div>
                </div>
                <x-input type="date" label="Birth Date" name="birth_date" />
            </div>

            <x-input label="Position" name="position" placeholder="Position" />

            {{-- Gender Dropdown --}}
            <div class="flex flex-col space-y-1 w-full">
                <label for="gender" class="text-sm font-medium text-gray-700">Gender</label>
                <select 
                    id="gender"
                    name="gender"
                    class="w-full rounded-full border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="" disabled selected hidden>Select your gender</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->gender }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-4">
                <x-button type="button" variant="secondary" class="w-full" @click="step = 1">
                    ← Back
                </x-button>

                <x-button type="submit" variant="gradient" class="w-full">
                    Sign Up
                </x-button>
            </div>

            <p class="text-s text-gray-400">
                *Skipping this step will not grant you permission to request a reservation.
            </p>

            <!-- Skip button submits with a flag -->
            <button 
                type="submit" 
                name="skip" 
                value="true"
                class="text-sm text-gray-500 hover:text-blue-600 flex items-center justify-end w-full"
            >
                Skip This Step* →
            </button>
        </div>
    </form>
</div>
@endsection