<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display login form
    |--------------------------------------------------------------------------
    */

    public function showLoginForm(): View
    {
        return view('pages.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Process login request
    |--------------------------------------------------------------------------
    */

    public function login(
        Request $request
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Login validation
        |--------------------------------------------------------------------------
        */

        $validationRules = [
            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'donor',
                    'beneficiary',
                ]),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
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
        | Qalam ID is required only for beneficiaries
        |--------------------------------------------------------------------------
        */

        if ($request->input('role') === 'beneficiary') {
            $validationRules['qalam_id'] = [
                'required',
                'string',
                'max:100',
            ];
        }

        $validated = $request->validate(
            $validationRules,
            [
                'role.required' =>
                    'Please select your account role.',

                'role.in' =>
                    'The selected role is invalid.',

                'email.required' =>
                    'Please enter your email address.',

                'email.email' =>
                    'Please enter a valid email address.',

                'password.required' =>
                    'Please enter your password.',

                'qalam_id.required' =>
                    'Qalam ID is required for beneficiary login.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Find user using email and selected role
        |--------------------------------------------------------------------------
        */

        $userQuery = User::query()
            ->where('email', $validated['email'])
            ->where('role', $validated['role']);

        /*
        |--------------------------------------------------------------------------
        | Check Qalam ID for beneficiary
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
        | Verify user and password
        |--------------------------------------------------------------------------
        |
        | Account status is checked only after verifying the password. This
        | prevents unauthorized people from checking another user's status.
        |
        */

        if (
            ! $user
            || ! Hash::check(
                $validated['password'],
                $user->password
            )
        ) {
            return back()
                ->withErrors([
                    'login' =>
                        'The provided login information is incorrect.',
                ])
                ->withInput(
                    $request->except([
                        'password',
                        'remember',
                    ])
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent suspended users from logging in
        |--------------------------------------------------------------------------
        */

        if ($user->account_status === 'suspended') {
            Log::warning(
                'Suspended user attempted to log in.',
                [
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'ip_address' => $request->ip(),
                ]
            );

            return back()
                ->withErrors([
                    'login' =>
                        'Your account has been suspended. Please contact the administrator.',
                ])
                ->with(
                    'account_status',
                    'suspended'
                )
                ->withInput(
                    $request->except([
                        'password',
                        'remember',
                    ])
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent blocked users from logging in
        |--------------------------------------------------------------------------
        */

        if ($user->account_status === 'blocked') {
            Log::warning(
                'Blocked user attempted to log in.',
                [
                    'user_id' => $user->id,
                    'role' => $user->role,
                    'ip_address' => $request->ip(),
                ]
            );

            return back()
                ->withErrors([
                    'login' =>
                        'Your account has been blocked. Please contact the administrator.',
                ])
                ->with(
                    'account_status',
                    'blocked'
                )
                ->withInput(
                    $request->except([
                        'password',
                        'remember',
                    ])
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Reject any unknown account status
        |--------------------------------------------------------------------------
        */

        if ($user->account_status !== 'active') {
            Log::warning(
                'User with an invalid account status attempted to log in.',
                [
                    'user_id' => $user->id,
                    'account_status' =>
                        $user->account_status,

                    'ip_address' => $request->ip(),
                ]
            );

            return back()
                ->withErrors([
                    'login' =>
                        'Your account is currently unavailable. Please contact the administrator.',
                ])
                ->withInput(
                    $request->except([
                        'password',
                        'remember',
                    ])
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Log in active user
        |--------------------------------------------------------------------------
        */

        Auth::login(
            $user,
            $request->boolean('remember')
        );

        /*
        | Regenerate the session ID to prevent session fixation.
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Redirect authenticated user
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->intended(route('dashboard'))
            ->with(
                'success',
                'Welcome back, ' . $user->name . '!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Log out user
    |--------------------------------------------------------------------------
    */

    public function logout(
        Request $request
    ): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}
