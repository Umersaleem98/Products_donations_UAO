<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\DonorTermAcceptance;
use App\Models\Product;
use App\Models\ProductRequest;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


public function index()
{
    $user = Auth::user();

    // ================= ADMIN DASHBOARD =================
    if ($user->role === 'admin') {

        $totalUsers = User::count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalBeneficiaries = User::where('role', 'beneficiary')->count();

        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $totalRequests = ProductRequest::count();

        $pendingAdmin = ProductRequest::where('admin_status', 'pending')->count();
        $approvedByAdmin = ProductRequest::where('admin_status', 'approved')->count();
        $rejectedByAdmin = ProductRequest::where('admin_status', 'rejected')->count();

        $pendingDonor = ProductRequest::where('admin_status', 'approved')
            ->where('donor_status', 'pending')
            ->count();

        $acceptedByDonor = ProductRequest::where('donor_status', 'accepted')->count();
        $rejectedByDonor = ProductRequest::where('donor_status', 'rejected')->count();

        $usersChart = [$totalDonors, $totalBeneficiaries];

        $requestChart = [$pendingAdmin, $approvedByAdmin, $rejectedByAdmin];

        $donorDecisionChart = [$acceptedByDonor, $rejectedByDonor, $pendingDonor];

        $monthlyRequests = ProductRequest::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        $requestMonths = [];
        $requestCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            $requestMonths[] = Carbon::create()->month($i)->format('M');
            $requestCounts[] = $monthlyRequests[$i] ?? 0;
        }

        $recentUsers = User::latest()->take(10)->get();

        $recentProducts = Product::with('user')->latest()->take(10)->get();

        $recentRequests = ProductRequest::with(['beneficiary', 'donor', 'product'])
            ->latest()
            ->take(10)
            ->get();

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
            'rejectedByDonor',
            'usersChart',
            'requestChart',
            'donorDecisionChart',
            'requestMonths',
            'requestCounts',
            'recentUsers',
            'recentProducts',
            'recentRequests'
        ));
    }

    // ================= DONOR DASHBOARD =================
   if ($user->role === 'donor') {

    $profile = $user->donorProfile;

    // ================= PROFILE COMPLETION =================
    $fields = [
        $user->name,
        $user->email,
        $profile?->image,
        $profile?->organization,
        $profile?->designation,
        $profile?->country,
        $profile?->address,
    ];

    $totalFields = count($fields);
    $filledFields = 0;

    foreach ($fields as $field) {
        if (!empty($field)) {
            $filledFields++;
        }
    }

    $profileCompletion = round(($filledFields / $totalFields) * 100);

    // ================= STATS =================
    $myProducts = Product::where('user_id', $user->id)->count();

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
        'acceptedRequests',
        'profileCompletion'
    ));
}

    // ================= BENEFICIARY DASHBOARD =================

    if ($user->role === 'beneficiary') {

        $profile = $user->beneficiaryProfile;

        // ✅ PROFILE COMPLETION CALCULATION
        $fields = [
            $user->name,
            $user->email,
            $profile?->image,
            $profile?->institution,
            $profile?->father_status,
            $profile?->province,
            $profile?->home_address,
        ];

        $totalFields = count($fields);
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($field)) {
                $filledFields++;
            }
        }

        $profileCompletion = round(($filledFields / $totalFields) * 100);

        // ================= STATS =================
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
            'accepted',
            'profileCompletion'
        ));
    }
}

    public function acceptTerms()
    {
        $donorId = Auth::id();

        // Check if already accepted
        $acceptance = DonorTermAcceptance::where('donor_id', $donorId)->first();

        if (! $acceptance) {

            DonorTermAcceptance::create([
                'donor_id' => $donorId,
                'accepted' => 1,
                'accepted_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Terms accepted successfully.');
    }
}
