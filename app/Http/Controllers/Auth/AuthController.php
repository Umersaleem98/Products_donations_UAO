<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BeneficiaryProfile;
use App\Models\DonorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        // Create profile based on role
        if ($user->role === 'beneficiary') {
            BeneficiaryProfile::create(['user_id' => $user->id]);
        }

        if ($user->role === 'donor') {
            DonorProfile::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()->route('dashboard'); // ✅ ONLY ONE DASHBOARD
    }

    return back()->withErrors([
        'email' => 'Invalid email or password.',
    ])->onlyInput('email');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
