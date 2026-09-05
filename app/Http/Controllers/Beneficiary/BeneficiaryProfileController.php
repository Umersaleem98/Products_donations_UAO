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
    /**
     * Show Beneficiary Profile Page
     */
    public function index()
    {
        $user = Auth::user();

        // Load beneficiary profile
        $user->load('beneficiaryProfile');

        return view(
            'pages.beneficiary.profile.index',
            compact('user')
        );
    }


    /**
     * Update Beneficiary Profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | User Information
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],


            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            'gender' => [
                'required',
                'in:male,female,other',
            ],


            /*
            |--------------------------------------------------------------------------
            | Academic Information
            |--------------------------------------------------------------------------
            */

            'institution' => [
                'required',
                'string',
                'max:255',
            ],

            'degree_level' => [
                'required',
                'in:UG,PG,PhD',
            ],

            'degree_program' => [
                'nullable',
                'string',
                'max:255',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'semester' => [
                'nullable',
                'string',
                'max:50',
            ],

            'cgpa' => [
                'nullable',
                'numeric',
                'min:0',
                'max:4',
            ],

            'enrollment_year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],


            /*
            |--------------------------------------------------------------------------
            | Family / Financial Information
            |--------------------------------------------------------------------------
            */

            'father_status' => [
                'required',
                'string',
                'max:255',
            ],

            'guardian_profession' => [
                'nullable',
                'string',
                'max:255',
            ],

            'monthly_income' => [
                'nullable',
                'numeric',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Location Information
            |--------------------------------------------------------------------------
            */

            'province' => [
                'required',
                'string',
                'max:255',
            ],

            'domicile' => [
                'nullable',
                'string',
                'max:255',
            ],

            'home_address' => [
                'required',
                'string',
                'max:1000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Profile Image
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],


            /*
            |--------------------------------------------------------------------------
            | Password
            |--------------------------------------------------------------------------
            */

            'current_password' => [
                'nullable',
                'required_with:password',
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Calculate Graduation Year
        |--------------------------------------------------------------------------
        |
        | UG  = Enrollment Year + 4
        | PG  = Enrollment Year + 2
        | PhD = Enrollment Year + 2
        |
        */

        $degreeDuration = match ($request->degree_level) {
            'UG' => 4,
            'PG' => 2,
            'PhD' => 2,
            default => 0,
        };


        $graduationYear = null;

        if (
            $request->filled('enrollment_year') &&
            $degreeDuration > 0
        ) {
            $graduationYear =
                (int) $request->enrollment_year + $degreeDuration;
        }


        /*
        |--------------------------------------------------------------------------
        | Profile Image Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $uploadPath =
                public_path('admins/asset/profilephoto');


            /*
            |--------------------------------------------------------------------------
            | Create Directory
            |--------------------------------------------------------------------------
            */

            if (!File::exists($uploadPath)) {

                File::makeDirectory(
                    $uploadPath,
                    0777,
                    true
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */

            if (!empty($user->image)) {

                $oldImage =
                    $uploadPath . '/' . $user->image;


                if (File::exists($oldImage)) {

                    File::delete($oldImage);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Generate Unique Filename
            |--------------------------------------------------------------------------
            */

            $filename =
                time()
                . '_'
                . Str::random(10)
                . '.'
                . $request
                    ->file('image')
                    ->getClientOriginalExtension();


            /*
            |--------------------------------------------------------------------------
            | Move Uploaded Image
            |--------------------------------------------------------------------------
            */

            $request
                ->file('image')
                ->move(
                    $uploadPath,
                    $filename
                );


            /*
            |--------------------------------------------------------------------------
            | Save Filename
            |--------------------------------------------------------------------------
            */

            $user->image = $filename;

        }


        /*
        |--------------------------------------------------------------------------
        | Update User Data
        |--------------------------------------------------------------------------
        */

        $user->name =
            $request->name;

        $user->email =
            $request->email;

        $user->phone =
            $request->phone;


        /*
        |--------------------------------------------------------------------------
        | Password Update
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            if (
                !Hash::check(
                    $request->current_password,
                    $user->password
                )
            ) {

                return back()
                    ->withErrors([
                        'current_password' =>
                            'Current password is incorrect.',
                    ])
                    ->withInput();

            }


            $user->password =
                Hash::make(
                    $request->password
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Save User
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | Update Or Create Beneficiary Profile
        |--------------------------------------------------------------------------
        */

        $user
            ->beneficiaryProfile()
            ->updateOrCreate(

                [
                    'user_id' => $user->id,
                ],

                [

                    /*
                    |--------------------------------------------------------------------------
                    | Personal Information
                    |--------------------------------------------------------------------------
                    */

                    'gender' =>
                        $request->gender,


                    /*
                    |--------------------------------------------------------------------------
                    | Academic Information
                    |--------------------------------------------------------------------------
                    */

                    'institution' =>
                        $request->institution,

                    'degree_level' =>
                        $request->degree_level,

                    'degree_program' =>
                        $request->degree_program,

                    'department' =>
                        $request->department,

                    'semester' =>
                        $request->semester,

                    'cgpa' =>
                        $request->cgpa,

                    'enrollment_year' =>
                        $request->enrollment_year,

                    'graduation_year' =>
                        $graduationYear,


                    /*
                    |--------------------------------------------------------------------------
                    | Family / Financial Information
                    |--------------------------------------------------------------------------
                    */

                    'father_status' =>
                        $request->father_status,

                    'guardian_profession' =>
                        $request->guardian_profession,

                    'monthly_income' =>
                        $request->monthly_income,


                    /*
                    |--------------------------------------------------------------------------
                    | Location Information
                    |--------------------------------------------------------------------------
                    */

                    'province' =>
                        $request->province,

                    'domicile' =>
                        $request->domicile,

                    'home_address' =>
                        $request->home_address,

                ]
            );


        /*
        |--------------------------------------------------------------------------
        | Success Response
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->back()
            ->with(
                'success',
                'Profile updated successfully.'
            );
    }
}