@extends('layouts.app')

@section('title', 'Profile - ' . ($user->username ?? 'Profile'))

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-extrabold">Profile</h1>
    <p class="text-gray-500 mt-2 mb-8">View all your profile details here.</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: avatar & role --}}
        <div class="col-span-1 bg-white rounded-2xl border border-gray-200 p-6 flex flex-col items-center">
            <div class="text-center mb-3">
                <h2 class="text-2xl font-bold">{{ $user->username }}</h2>
                <p class="text-blue-500 mt-1">{{ optional($user->role)->name ?? 'Member' }}</p>
            </div>

            <div class="w-56 h-56 rounded-full p-4 bg-gray-100 flex items-center justify-center shadow-inner">
                @php
                    // test fallback image in local container:
                    $fallback = '/mnt/data/5d85c432-fbf6-4842-8c36-56bce4aa8ce9.png';
                    $avatar = $user->profile_picture ? asset('storage/' . $user->profile_picture) : $fallback;
                @endphp

                <img src="{{ $avatar }}" alt="avatar" class="w-full h-full object-cover rounded-full border-8 border-gray-200" />
            </div>

            <div class="mt-6 w-full text-center">
                <a href="{{ route('profile.edit', $user->username ?? $user->id) ?? '#' }}"
                   class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-full font-semibold shadow">
                   Edit Profile
                </a>
            </div>
        </div>

        {{-- Right: details (span 2 cols) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <h3 class="text-xl font-semibold">Bio & other details</h3>
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-y-4 gap-x-8 text-gray-700">
                    <div>
                        <div class="text-sm text-gray-400">Role</div>
                        <div class="py-2">{{ optional($user->role)->name ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Phone Number</div>
                        <div class="py-2">{{ $user->phone_number ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Username</div>
                        <div class="py-2">{{ $user->username }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Class</div>
                        <div class="py-2">{{ optional($user->class)->class ?? optional($user->class)->name ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">First Name</div>
                        <div class="py-2">{{ $user->first_name ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Gender</div>
                        <div class="py-2">{{ optional($user->gender)->gender ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Last Name</div>
                        <div class="py-2">{{ $user->last_name ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Birth Date</div>
                        <div class="py-2">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('jS F Y') : '-' }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Email</div>
                        <div class="py-2">{{ $user->email }}</div>
                    </div>

                    <div>
                        <div class="text-sm text-gray-400">Password</div>
                        <div class="py-2">•••••••• <a href="{{ route('profile.edit', $user->username ?? $user->id) }}" class="ml-2 inline-block text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path d="M2.05 12a9.969 9.969 0 0119.9 0"/>
                            </svg>
                        </a></div>
                    </div>
                </div>
            </div>

            {{-- Reservations table --}}
            <div class="mt-6 bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">My Reservations</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="text-left text-sm text-gray-500">
                                <th class="py-3 pr-6">ID</th>
                                <th class="py-3 pr-6">Reservation Date</th>
                                <th class="py-3 pr-6">Start Time</th>
                                <th class="py-3 pr-6">End Time</th>
                                <th class="py-3 pr-6">Total Participant</th>
                                <th class="py-3 pr-6">Status</th>
                                <th class="py-3 pr-6">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($reservations as $r)
                                {{-- pick first detail row to display (if multiple details exist) --}}
                                @php $d = $r->details->first(); @endphp
                                <tr class="text-sm text-gray-700">
                                    <td class="py-4">{{ $r->id }}</td>
                                    <td class="py-4">{{ $d ? \Carbon\Carbon::parse($d->reservation_date)->format('l, jS F Y') : '-' }}</td>
                                    <td class="py-4">{{ $d ? \Carbon\Carbon::parse($d->start)->format('H:i') : '-' }}</td>
                                    <td class="py-4">{{ $d ? \Carbon\Carbon::parse($d->end)->format('H:i') : '-' }}</td>
                                    <td class="py-4">{{ $r->total_participant ?? '-' }}</td>
                                    <td class="py-4">
                                        @php $status = optional($r->status)->name ?? $r->status; @endphp
                                        @if($status === 'pending' || strtolower($status) === 'pending')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">Pending</span>
                                        @elseif($status === 'accepted' || strtolower($status) === 'accepted')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Accepted</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-red-100 text-red-700">Declined</span>
                                        @endif
                                    </td>
                                    <td class="py-4">
                                        <form method="POST" action="{{ route('profile.reservation.delete', [$user->username ?? $user->id, $r->id]) }}" onsubmit="return confirm('Delete this reservation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-full bg-red-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 6h18"/><path d="M8 6v-1a2 2 0 012-2h4a2 2 0 012 2v1"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="py-6 text-center text-gray-500">No reservations yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection