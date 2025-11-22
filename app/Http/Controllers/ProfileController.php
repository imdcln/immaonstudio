<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show public/profile page for the given user or current auth user.
     *
     * Route in your web.php already uses:
     * Route::prefix('profile')->group(function () {
     *     Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile');
     * });
     */
    public function index(User $user)
    {
        // If route binding gives a user, show them, otherwise fallback to auth user
        $user = $user ?? Auth::user();

        // Eager load relations (adjust relation names if different)
        $user->load(['role', 'class', 'gender', 'reservations.details', 'reservations.status']);

        // Prepare reservations flattened with their detail row (if multiple details, we pick first for listing)
        $reservations = $user->reservations()->with('details')->orderByDesc('created_at')->get();

        return view('profile.index', compact('user', 'reservations'));
    }

    /**
     * Optional: delete reservation (called from profile action button).
     * Add a route for this if you want delete capability.
     */
    public function destroyReservation(Request $request, User $user, Reservation $reservation)
    {
        // $this->authorize('delete', $reservation);

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

        // update user base info
        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
        ]);

        // handle profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->update(['profile_picture' => $path]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
