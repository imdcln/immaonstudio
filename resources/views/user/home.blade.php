@extends('layouts.app')

@section('content')
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <x-button variant="tertiary" style="fill" type="submit">
        Logout
        <x-slot:icon>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </x-slot:icon>
    </x-button>
</form>
@endsection