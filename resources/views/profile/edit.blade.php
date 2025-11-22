@extends('layouts.app')

@section('title', 'Edit Profile - ' . $user->username)

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">

    <h1 class="text-3xl font-bold mb-2">Edit Profile</h1>
    <p class="text-gray-500 mb-8">Update your personal information here.</p>

    <form action="{{ route('profile.update', $user->username) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        {{-- Avatar section --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 flex gap-6 items-center">
            <div>
                @php
                    $fallback = '/mnt/data/5d85c432-fbf6-4842-8c36-56bce4aa8ce9.png';
                    $avatar = $user->profile_picture
                        ? asset('storage/' . $user->profile_picture)
                        : $fallback;
                @endphp

                <img id="avatarPreview" src="{{ $avatar }}"
                     class="w-40 h-40 rounded-full object-cover border-4 border-gray-200 shadow">
            </div>

            <div>
                <label class="block font-semibold mb-2">Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*"
                       class="mt-1 block w-full text-sm" onchange="previewAvatar(event)">
                <p class="text-xs text-gray-500 mt-2">PNG, JPG, Max 2MB</p>
            </div>
        </div>

        {{-- Info fields --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

            <div>
                <label class="font-semibold">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

            <div>
                <label class="font-semibold">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

            <div>
                <label class="font-semibold">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

            <div>
                <label class="font-semibold">Birth Date</label>
                <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}"
                       class="mt-1 w-full px-4 py-2 rounded-xl border focus:ring">
            </div>

        </div>

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit"
                class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold shadow-lg">
                Save Changes
            </button>
        </div>

    </form>
</div>

<script>
function previewAvatar(event) {
    const img = document.getElementById('avatarPreview');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script>
@endsection
