<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function index()
    {
        // Example stats (optional)
        $totalUsers = User::count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalBeneficiaries = User::where('role', 'beneficiary')->count();

        return view('dashboard', compact(
            'totalUsers',
            'totalDonors',
            'totalBeneficiaries'
        ));
    }
}
