<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup()
    {
        $genders = Gender::all();
        return view('auth.signup', compact('genders'));
    }

    public function signupPost(Request $request)
    {
        // STEP 1 validation — required
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // STEP 2 (optional)
        $additionalData = [
            'first_name'   => $request->input('first_name'),
            'last_name'    => $request->input('last_name'),
            'phone_number' => $request->input('phone_number'),
            'birth_date'   => $request->input('birth_date'),
            'position'     => $request->input('position'),
            'gender_id'    => $request->input('gender'),
        ];

        // Filter out null/empty optional fields
        $additionalData = array_filter($additionalData, fn($value) => !is_null($value) && $value !== '');

        // Combine validated + optional
        $data = array_merge($validatedData, [
            'password' => Hash::make($validatedData['password']),
        ], $additionalData);

        // Create user
        $user = User::create($data);

        // Auto login
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'usn-email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('username', $request->input('usn-email'))
                    ->orWhere('email', $request->input('usn-email'))
                    ->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Incorrect password, please try again.');
        }

        Auth::login($user, $request->filled('remember'));

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Welcome back, ' . $user->first_name . '!');
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('landing');
}

}
