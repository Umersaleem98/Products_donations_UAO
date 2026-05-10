<?php

namespace App\Http\Controllers\Beneficiary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class BeneficiaryProfileController extends Controller
{
      // SHOW PROFILE PAGE
    public function index()
    {
        $user = Auth::user();

        // LOAD BENEFICIARY PROFILE
        $user->load('beneficiaryProfile');

        return view('pages.beneficiary.profile.index', compact('user'));
    }


    // UPDATE PROFILE
    public function update(Request $request)
    {
        $user = Auth::user();

        // VALIDATION
        $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email,' . $user->id,

            // BENEFICIARY PROFILE
            'institution' => 'nullable|string|max:255',

            'father_status' => 'nullable|string|max:255',

            'guardian_profession' => 'nullable|string|max:255',

            'monthly_income' => 'nullable|numeric',

            'province' => 'nullable|string|max:255',

            'domicile' => 'nullable|string|max:255',

            'home_address' => 'nullable|string|max:1000',

            // IMAGE
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            // PASSWORD
            'current_password' => 'nullable|required_with:password',

            'password' => 'nullable|min:6|confirmed',

        ]);


        // IMAGE UPLOAD
        if ($request->hasFile('image')) {

            $uploadPath = public_path('admin/asset/profilephoto');

            // CREATE FOLDER
            if (!File::exists($uploadPath)) {

                File::makeDirectory($uploadPath, 0777, true);

            }

            // DELETE OLD IMAGE
            if ($user->image) {

                $oldImage = $uploadPath . '/' . $user->image;

                if (File::exists($oldImage)) {

                    File::delete($oldImage);

                }
            }

            // NEW IMAGE NAME
            $filename = time() . '_' . Str::random(10) . '.' .
                        $request->image->getClientOriginalExtension();

            // MOVE IMAGE
            $request->image->move($uploadPath, $filename);

            // SAVE IMAGE NAME
            $user->image = $filename;
        }


        // UPDATE USER
        $user->name = $request->name;

        $user->email = $request->email;


        // PASSWORD UPDATE
        if ($request->filled('password')) {

            if (!Hash::check($request->current_password, $user->password)) {

                return back()->withErrors([

                    'current_password' => 'Current password is incorrect',

                ]);
            }

            $user->password = Hash::make($request->password);
        }

        $user->save();


        // UPDATE BENEFICIARY PROFILE
        $user->beneficiaryProfile()->updateOrCreate(

            [
                'user_id' => $user->id
            ],

            [

                'institution' => $request->institution,

                'father_status' => $request->father_status,

                'guardian_profession' => $request->guardian_profession,

                'monthly_income' => $request->monthly_income,

                'province' => $request->province,

                'domicile' => $request->domicile,

                'home_address' => $request->home_address,

            ]

        );

        return back()->with('success', 'Profile updated successfully.');
    }
}
