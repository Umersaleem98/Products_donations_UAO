<?php

namespace Database\Seeders;

use App\Models\BeneficiaryProfile;
use App\Models\DonorProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // ADMIN
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // DONOR
        $donor = User::create([
            'name' => 'Donor User',
            'email' => 'donor@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'donor'
        ]);

        DonorProfile::create([
            'user_id' => $donor->id,
            'organization' => 'Helping Org',
            'phone' => '03001234567'
        ]);

        // BENEFICIARY
        $beneficiary = User::create([
            'name' => 'Beneficiary User',
            'email' => 'beneficiary@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'beneficiary'
        ]);

        BeneficiaryProfile::create([
            'user_id' => $beneficiary->id,
            'cnic' => '12345-1234567-1',
            'address' => 'Rawalpindi'
        ]);
    }
}
