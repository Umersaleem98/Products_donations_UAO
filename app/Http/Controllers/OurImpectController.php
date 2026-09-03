<?php

namespace App\Http\Controllers;

use App\Models\User;

class OurImpectController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Overall Users
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();


        /*
        |--------------------------------------------------------------------------
        | Users by Role
        |--------------------------------------------------------------------------
        */

        $totalDonors = User::where(
            'role',
            'donor'
        )->count();


        $totalBeneficiaries = User::where(
            'role',
            'beneficiary'
        )->count();


        $totalAdmins = User::where(
            'role',
            'admin'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Active Accounts
        |--------------------------------------------------------------------------
        */

        $activeUsers = User::where(
            'account_status',
            'active'
        )->count();


        $activeDonors = User::where(
            'role',
            'donor'
        )
        ->where(
            'account_status',
            'active'
        )
        ->count();


        $activeBeneficiaries = User::where(
            'role',
            'beneficiary'
        )
        ->where(
            'account_status',
            'active'
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | Verified Accounts
        |--------------------------------------------------------------------------
        */

        $verifiedUsers = User::whereNotNull(
            'email_verified_at'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.home.ourimpact.index',
            compact(
                'totalUsers',
                'totalDonors',
                'totalBeneficiaries',
                'totalAdmins',
                'activeUsers',
                'activeDonors',
                'activeBeneficiaries',
                'verifiedUsers'
            )
        );
    }
}