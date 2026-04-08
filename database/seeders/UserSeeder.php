<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'phone' => '03000000000',
                'address' => 'Admin Address',
                'is_active' => true,
            ]
        );

        // Donor
        User::updateOrCreate(
            ['email' => 'donor@example.com'],
            [
                'name' => 'Donor User',
                'email' => 'donor@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'donor',
                'phone' => '03111111111',
                'address' => 'Donor Address',
                'is_active' => true,
            ]
        );

        // Beneficiary
        User::updateOrCreate(
            ['email' => 'beneficiary@gmail.com'],
            [
                'name' => 'Beneficiary User',
                'email' => 'beneficiary@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'beneficiary',
                'phone' => '03222222222',
                'address' => 'Beneficiary Address',
                'is_active' => true,
            ]
        );
    }
}
