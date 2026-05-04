<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ===== ADMIN DASHBOARD =====
        if ($user->role === 'admin') {

            $totalUsers          = User::count();
            $totalDonors         = User::where('role', 'donor')->count();
            $totalBeneficiaries  = User::where('role', 'beneficiary')->count();

            $totalProducts       = Product::count();
            $totalCategories     = Category::count();

            // Requests (using your improved 2-stage model)
            $totalRequests       = ProductRequest::count();
            $pendingAdmin        = ProductRequest::where('admin_status', 'pending')->count();
            $approvedByAdmin     = ProductRequest::where('admin_status', 'approved')->count();
            $rejectedByAdmin     = ProductRequest::where('admin_status', 'rejected')->count();

            $pendingDonor        = ProductRequest::where('admin_status', 'approved')
                                        ->where('donor_status', 'pending')->count();
            $acceptedByDonor     = ProductRequest::where('donor_status', 'accepted')->count();
            $rejectedByDonor     = ProductRequest::where('donor_status', 'rejected')->count();

            return view('dashboard', compact(
                'user',
                'totalUsers',
                'totalDonors',
                'totalBeneficiaries',
                'totalProducts',
                'totalCategories',
                'totalRequests',
                'pendingAdmin',
                'approvedByAdmin',
                'rejectedByAdmin',
                'pendingDonor',
                'acceptedByDonor',
                'rejectedByDonor'
            ));
        }

        // ===== DONOR DASHBOARD =====
        if ($user->role === 'donor') {

            $myProducts      = Product::where('user_id', $user->id)->count();

            $incomingRequests = ProductRequest::where('donor_id', $user->id)
                ->where('admin_status', 'approved')
                ->count();

            $pendingRequests = ProductRequest::where('donor_id', $user->id)
                ->where('admin_status', 'approved')
                ->where('donor_status', 'pending')
                ->count();

            $acceptedRequests = ProductRequest::where('donor_id', $user->id)
                ->where('donor_status', 'accepted')
                ->count();

            return view('dashboard', compact(
                'user',
                'myProducts',
                'incomingRequests',
                'pendingRequests',
                'acceptedRequests'
            ));
        }

        // ===== BENEFICIARY DASHBOARD =====
        if ($user->role === 'beneficiary') {

            $myRequests = ProductRequest::where('beneficiary_id', $user->id)->count();

            $pending = ProductRequest::where('beneficiary_id', $user->id)
                ->where('admin_status', 'pending')
                ->count();

            $approved = ProductRequest::where('beneficiary_id', $user->id)
                ->where('admin_status', 'approved')
                ->count();

            $accepted = ProductRequest::where('beneficiary_id', $user->id)
                ->where('donor_status', 'accepted')
                ->count();

            return view('dashboard', compact(
                'user',
                'myRequests',
                'pending',
                'approved',
                'accepted'
            ));
        }
    }
}