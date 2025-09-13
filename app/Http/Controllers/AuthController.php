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
        return view('Auth.signup');
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

        // $user = User::create([
        //     'username'   => $validated['username'],
        //     'email'      => $validated['email'],
        //     'password'   => Hash::make($validated['password']),
        //     'first_name' => $validated['first_name'] ?? null,
        //     'last_name'  => $validated['last_name'] ?? null,
        //     'phone'      => $validated['phone'] ?? null,
        //     'birth_date' => $validated['birth_date'] ?? null,
        //     'position'   => $validated['position'] ?? null,
        //     'gender'     => $validated['gender'] ?? null,
        // ]);

        // Auth::login($user);

        return redirect()->route('landing')->with('success', 'Account created successfully!');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('landing'))
                ->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email');
    }
}
