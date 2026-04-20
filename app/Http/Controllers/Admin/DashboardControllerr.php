<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardControllerr extends Controller
{
     public function index()
{
    $user = auth()->user();

    $role = $user->role;

    $data = [
        'user' => $user,
        'role' => $role,
        'roleLabel' => $this->getRoleLabel($role),
    ];

    $data = match($role) {
        'admin' => $this->getAdminData($data),
        'beneficiary' => $this->getBeneficiaryData($data),
        'donor' => $this->getDonorData($data),
        default => $data,
    };

    return view('dashboard', $data);
}

    private function getRoleLabel(string $role): string
    {
        return match($role) {
            'admin' => 'Administrator',
            'beneficiary' => 'Beneficiary',
            'donor' => 'Donor',
            default => 'User',
        };
    }

   private function getAdminData(array $data): array
{
    return array_merge($data, [
        'stats' => [
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_revenue' => Product::sum('price'),
        ],
    ]);
}

    private function getBeneficiaryData(array $data): array
    {
        return array_merge($data, [
            'my_requests' => [
                'total' => 5,
                'pending' => 2,
                'approved' => 3,
            ],
            'available_donations' => 15,
            'profile_completion' => 75,
        ]);
    }

    private function getDonorData(array $data): array
    {
        return array_merge($data, [
            'donation_stats' => [
                'total_donated' => '$1,250',
                'donations_count' => 8,
                'beneficiaries_helped' => 12,
            ],
            'impact_score' => 85,
        ]);
    }
    
}
