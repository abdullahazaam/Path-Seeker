<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if ($request->has('first_name') && !$request->has('name')) {
            $request->merge([
                'name' => trim($request->input('first_name') . ' ' . $request->input('last_name'))
            ]);
        }

        $validated = $request->validate([
            'first_name' => 'nullable|string|max:120',
            'last_name' => 'nullable|string|max:120',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:student,graduate,professional',
            'education_level' => 'nullable|string|max:255',
            'interests' => 'nullable|string|max:500',
        ]);

        $fullName = !empty($validated['name']) 
            ? $validated['name'] 
            : trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? ''));

        $user = User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'education_level' => $validated['education_level'] ?? null,
            'interests' => $validated['interests'] ?? null,
        ]);

        // Create UserProfile record
        UserProfile::create([
            'user_id' => $user->id,
            'education_level' => $validated['education_level'] ?? null,
            'interests' => $validated['interests'] ?? null,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to your Career Passport, ' . $user->name . '.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
