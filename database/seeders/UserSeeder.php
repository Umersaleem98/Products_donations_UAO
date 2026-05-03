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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // DONOR
        User::create([
            'name' => 'Donor User',
            'email' => 'donor@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'donor',
        ]);

        // BENEFICIARY
        User::create([
            'name' => 'Beneficiary User',
            'email' => 'beneficiary@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'beneficiary',
            'qalam_id' => '12345',
        ]);
    }
}
