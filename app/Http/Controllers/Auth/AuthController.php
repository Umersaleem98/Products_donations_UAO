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
    /*
    |--------------------------------------------------------------------------
    | Validate Login Information
    |--------------------------------------------------------------------------
    */

    $validationRules = [
        'role' => [
            'required',
            'in:admin,donor,beneficiary',
        ],

        'email' => [
            'required',
            'email',
        ],

        'password' => [
            'required',
            'string',
            'min:6',
        ],

        'remember' => [
            'nullable',
            'boolean',
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | Qalam ID Is Required Only for Beneficiaries
    |--------------------------------------------------------------------------
    */

    if ($request->role === 'beneficiary') {
        $validationRules['qalam_id'] = [
            'required',
        ];
    }


    $validated = $request->validate($validationRules);


    /*
    |--------------------------------------------------------------------------
    | Find User by Email and Selected Role
    |--------------------------------------------------------------------------
    */

    $userQuery = User::query()
        ->where('email', $validated['email'])
        ->where('role', $validated['role']);


    /*
    |--------------------------------------------------------------------------
    | Check Qalam ID for Beneficiary
    |--------------------------------------------------------------------------
    */

    if ($validated['role'] === 'beneficiary') {
        $userQuery->where(
            'qalam_id',
            $validated['qalam_id']
        );
    }


    $user = $userQuery->first();


    /*
    |--------------------------------------------------------------------------
    | Validate Password
    |--------------------------------------------------------------------------
    */

    if (
        !$user ||
        !Hash::check(
            $validated['password'],
            $user->password
        )
    ) {
        return back()
            ->withErrors([
                'login' => 'The provided login information is incorrect.',
            ])
            ->withInput(
                $request->except('password')
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Log In User
    |--------------------------------------------------------------------------
    */

    Auth::login(
        $user,
        $request->boolean('remember')
    );

    $request->session()->regenerate();


    /*
    |--------------------------------------------------------------------------
    | Redirect to Dashboard
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->intended(route('dashboard'));
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
