<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DonorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Eager load donor profile
        $user->load('donorProfile');

        return view('pages.donor.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'organization' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // ✅ IMAGE UPLOAD (DIRECT PUBLIC PATH)
        if ($request->hasFile('image')) {

            $uploadPath = public_path('admin/asset/profilephoto');

            // create folder if not exists
            if (! File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            // ❌ delete old image if exists
            if ($user->image) {
                $oldImage = $uploadPath.'/'.$user->image;

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            // ✅ generate unique filename
            $filename = time().'_'.Str::random(10).'.'.$request->image->getClientOriginalExtension();

            // ✅ move file to public folder
            $request->image->move($uploadPath, $filename);

            // ✅ save ONLY filename
            $user->image = $filename;
        }

        // ✅ UPDATE USER INFO
        $user->name = $request->name;
        $user->email = $request->email;

        // ✅ PASSWORD UPDATE (secure)
        if ($request->filled('password')) {

            if (! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect',
                ]);
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();

        // ✅ DONOR PROFILE UPDATE
        $user->donorProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'organization' => $request->organization,
                'phone' => $request->phone,
            ]
        );

        return back()->with('success', 'Profile updated successfully.');
    }
}
