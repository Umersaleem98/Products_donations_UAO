<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin data
        if ($user->role === 'admin') {
            $totalUsers = User::count();
            $totalDonors = User::where('role', 'donor')->count();
            $totalBeneficiaries = User::where('role', 'beneficiary')->count();

            return view('dashboard', compact(
                'user',
                'totalUsers',
                'totalDonors',
                'totalBeneficiaries'
            ));
        }

        // Donor data
        if ($user->role === 'donor') {
            return view('dashboard', compact('user'));
        }

        // Beneficiary data
        if ($user->role === 'beneficiary') {
            return view('dashboard', compact('user'));
        }
    }
}
