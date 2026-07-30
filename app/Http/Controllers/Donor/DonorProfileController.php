<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DonorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load donor profile
        $user->load('donorProfile');

        return view('pages.donor.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // VALIDATION
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',

            // DONOR PROFILE
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',

            // IMAGE
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // PASSWORD
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',

        ]);

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {

            $uploadPath = public_path('admins/asset/profilephoto');

            // CREATE FOLDER
            if (! File::exists($uploadPath)) {

                File::makeDirectory($uploadPath, 0777, true);

            }

            // DELETE OLD IMAGE
            if ($user->image) {

                $oldImage = $uploadPath.'/'.$user->image;

                if (File::exists($oldImage)) {

                    File::delete($oldImage);

                }
            }

            // NEW FILE NAME
            $filename = time().'_'.Str::random(10).'.'.
                        $request->image->getClientOriginalExtension();

            // MOVE FILE
            $request->image->move($uploadPath, $filename);

            // SAVE FILE NAME
            $user->image = $filename;
        }

        // UPDATE USER
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        // PASSWORD UPDATE
        if ($request->filled('password')) {

            if (! Hash::check($request->current_password, $user->password)) {

                return back()->withErrors([

                    'current_password' => 'Current password is incorrect',

                ]);
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        // UPDATE DONOR PROFILE
        $user->donorProfile()->updateOrCreate(

            [
                'user_id' => $user->id,
            ],

            [
                'organization' => $request->organization,
                'designation' => $request->designation,
                'country' => $request->country,
                'address' => $request->address,
            ]

        );

        return back()->with('success', 'Profile updated successfully.');
    }
}
