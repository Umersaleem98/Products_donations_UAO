<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        // Step 1: Base validation
        $request->validate([
            'role'     => 'required|in:admin,donor,beneficiary',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Step 2: Additional validation for beneficiary
        if ($request->role === 'beneficiary') {
            $request->validate([
                'qalam_id' => 'required'
            ]);
        }

        // Step 3: Build query dynamically
        $query = User::where('email', $request->email)
            ->where('role', $request->role);

        if ($request->role === 'beneficiary') {
            $query->where('qalam_id', $request->qalam_id);
        }

        $user = $query->first();

        // Step 4: Check user existence + password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Invalid credentials'
            ])->withInput();
        }

        // Step 5: Login user
        Auth::login($user);

        // Step 6: Redirect to single dashboard
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
