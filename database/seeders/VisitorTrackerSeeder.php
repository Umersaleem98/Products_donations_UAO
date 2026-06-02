<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisitorTracker;
use Carbon\Carbon;

class VisitorTrackerSeeder extends Seeder
{
    public function run(): void
    {
        $browsers = ['Chrome', 'Firefox', 'Edge', 'Safari'];
        $platforms = ['Windows', 'Linux', 'Mac', 'Android', 'iOS'];

        for ($i = 1; $i <= 50; $i++) {

            $ip = '192.168.' . rand(0, 255) . '.' . rand(1, 255);
            $browser = $browsers[array_rand($browsers)];

            VisitorTracker::updateOrCreate(
                [
                    'ip_address' => $ip,
                    'browser' => $browser,
                ],
                [
                    'user_agent' => 'Test Agent ' . $i,
                    'platform' => $platforms[array_rand($platforms)],
                    'cookie_accepted' => rand(0, 1),
                    'visited_at' => Carbon::now()->subDays(rand(0, 60)),
                    'created_at' => Carbon::now()->subDays(rand(0, 60)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 60)),
                ]
            );
        }
    }
}