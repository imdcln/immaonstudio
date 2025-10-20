<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function signupPost(Request $request)
    {
        $validated = $request->validate([
            'username'   => 'required|string|max:255|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',

            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'phone'      => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'position'   => 'nullable|string|max:255',
            'gender'     => 'nullable|in:male,female,other',
        ]);

        return redirect()->route('landing')->with('success', 'Account created successfully!');
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

    return redirect()->route('landing')->with('success', 'You have been logged out.');
}

}
