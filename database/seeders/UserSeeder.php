<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // =========================
        // DONORS
        // =========================
        $donors = [
            [
                'name' => 'Ali Donor',
                'email' => 'ali.donor@gmail.com',
            ],
            [
                'name' => 'Sara Donor',
                'email' => 'sara.donor@gmail.com',
            ],
            [
                'name' => 'Ahmed Donor',
                'email' => 'ahmed.donor@gmail.com',
            ],
            [
                'name' => 'Zain Donor',
                'email' => 'zain.donor@gmail.com',
            ],
            [
                'name' => 'Hassan Donor',
                'email' => 'hassan.donor@gmail.com',
            ],
        ];

        foreach ($donors as $donor) {
            User::create([
                'name' => $donor['name'],
                'email' => $donor['email'],
                'password' => Hash::make('12345678'),
                'role' => 'donor',
            ]);
        }

        // =========================
        // BENEFICIARIES
        // =========================
        $beneficiaries = [
            [
                'name' => 'Ali Beneficiary',
                'email' => 'ali.beneficiary@gmail.com',
                'qalam_id' => '1001',
            ],
            [
                'name' => 'Sara Beneficiary',
                'email' => 'sara.beneficiary@gmail.com',
                'qalam_id' => '1002',
            ],
            [
                'name' => 'Usman Beneficiary',
                'email' => 'usman.beneficiary@gmail.com',
                'qalam_id' => '1003',
            ],
            [
                'name' => 'Ayesha Beneficiary',
                'email' => 'ayesha.beneficiary@gmail.com',
                'qalam_id' => '1004',
            ],
            [
                'name' => 'Bilal Beneficiary',
                'email' => 'bilal.beneficiary@gmail.com',
                'qalam_id' => '1005',
            ],
        ];

        foreach ($beneficiaries as $beneficiary) {
            User::create([
                'name' => $beneficiary['name'],
                'email' => $beneficiary['email'],
                'password' => Hash::make('12345678'),
                'role' => 'beneficiary',
                'qalam_id' => $beneficiary['qalam_id'],
            ]);
        }
    }
}
