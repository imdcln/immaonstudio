<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $user = $user ?? Auth::user();

        $user->load(['role', 'class', 'gender']);

        $reservations = Reservation::with(['details', 'status'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('profile.index', compact('user', 'reservations'));
    }

    public function destroyReservation(Request $request, User $user, Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'Reservation deleted.');
    }

    public function edit(User $user)
    {
        $user->load(['role', 'class', 'gender']);
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'username'   => 'required|string|max:50|unique:users,username,' . $user->id,
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:30',
            'birth_date' => 'nullable|date',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture' => $path]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
