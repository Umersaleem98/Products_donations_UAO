<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthControllerr extends Controller
{
    public function Loginscreen()
    {
        return view("pages.auth.login");
    }
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $credentials['email'])->first();

    // User not found
    if (!$user) {
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Check active status
    if (!$user->is_active) {
        return back()->withErrors([
            'email' => 'Your account has been deactivated. Please contact support.',
        ])->onlyInput('email');
    }

    // Attempt login
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ ROLE-BASED REDIRECT (NO 403 ISSUE)
        return match ($user->role) {
            'admin' => redirect()->route('dashboard'),
            'donor' => redirect()->route('dashboard'),
            'beneficiary' => redirect()->route('dashboard'),
            default => redirect()->route('dashboard'),
        };
    }

    // Invalid credentials
    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ])->onlyInput('email');
}
    public function Regiserscreen()
    {
        return view("pages.auth.register");
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:beneficiary,donor'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        Auth::login($user);

        // Redirect to unified dashboard
        return redirect()->route('dashboard');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
