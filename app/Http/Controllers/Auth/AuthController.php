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
        $captchas = [
            'lock' => [
                'question' => 'Select all LOCK images',
                'images' => [
                    ['img' => 'lock1.jpg', 'is_correct' => 1],
                    ['img' => 'car1.jpg',  'is_correct' => 0],
                    ['img' => 'lock2.jpg', 'is_correct' => 1],
                    ['img' => 'house1.jpg','is_correct' => 0],
                ],
            ],
            'car' => [
                'question' => 'Select all CAR images',
                'images' => [
                    ['img' => 'car1.jpg', 'is_correct' => 1],
                    ['img' => 'bike1.jpg', 'is_correct' => 0],
                    ['img' => 'car2.jpg', 'is_correct' => 1],
                    ['img' => 'tree1.jpg','is_correct' => 0],
                ],
            ],
        ];

        $captcha = $captchas[array_rand($captchas)];

        session([
            'captcha_question' => $captcha['question'],
            'captcha_images'   => $captcha['images']
        ]);

        return view('pages.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // -----------------------------
        // 1. Basic validation
        // -----------------------------
        $request->validate([
            'role'     => 'required|in:admin,donor,beneficiary',
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($request->role === 'beneficiary') {
            $request->validate([
                'qalam_id' => 'required'
            ]);
        }

        // -----------------------------
        // 2. CAPTCHA validation
        // -----------------------------
        $images = session('captcha_images', []);
        $selected = $request->captcha_selected ?? [];

        if (empty($images)) {
            return back()->withErrors([
                'captcha' => 'Captcha session expired. Please try again.'
            ]);
        }

        $correctIndexes = [];

        foreach ($images as $key => $img) {
            if ($img['is_correct'] == 1) {
                $correctIndexes[] = $key;
            }
        }

        sort($correctIndexes);
        sort($selected);

        if ($correctIndexes != $selected) {
            return back()->withErrors([
                'captcha' => 'Captcha verification failed.'
            ])->withInput();
        }

        // -----------------------------
        // 3. User lookup
        // -----------------------------
        $query = User::where('email', $request->email)
                     ->where('role', $request->role);

        if ($request->role === 'beneficiary') {
            $query->where('qalam_id', $request->qalam_id);
        }

        $user = $query->first();

        // -----------------------------
        // 4. Password check
        // -----------------------------
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login' => 'Invalid credentials'
            ])->withInput();
        }

        // -----------------------------
        // 5. Login user securely
        // -----------------------------
        Auth::login($user, $request->has('remember'));

        $request->session()->regenerate();

        // -----------------------------
        // 6. Redirect
        // -----------------------------
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
