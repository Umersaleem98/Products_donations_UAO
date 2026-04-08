<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardControllerr extends Controller
{
     public function index()
    {
       $user = auth()->user();
        $role = $user->role;
        
        // Common data for all roles
        $data = [
            'user' => $user,
            'role' => $role,
            'roleLabel' => $this->getRoleLabel($role),
        ];

        // Role-specific data
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
                'total_beneficiaries' => User::where('role', 'beneficiary')->count(),
                'total_donors' => User::where('role', 'donor')->count(),
                'pending_requests' => 12,
            ],
            'recent_users' => User::latest()->take(5)->get(),
            'recent_activities' => [
                ['action' => 'New user registered', 'time' => '2 minutes ago', 'type' => 'user'],
                ['action' => 'Donation received', 'time' => '15 minutes ago', 'type' => 'donation'],
                ['action' => 'Beneficiary request approved', 'time' => '1 hour ago', 'type' => 'request'],
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
