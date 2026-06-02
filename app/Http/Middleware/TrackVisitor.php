<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorTracker;
use Jenssegers\Agent\Agent;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $agent = new Agent();

        $browser = $agent->browser();
        $platform = $agent->platform();
        $userAgent = $request->header('User-Agent');

        $visitor = VisitorTracker::where('ip_address', $ip)
            ->where('browser', $browser)
            ->first();

        if (!$visitor) {
            VisitorTracker::create([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'browser' => $browser,
                'platform' => $platform,
                'cookie_accepted' => false,
                'visited_at' => now(),
            ]);

            // Mark request so frontend shows popup
            session(['show_cookie_popup' => true]);
        } else {
            session(['show_cookie_popup' => !$visitor->cookie_accepted]);
        }

        return $next($request);
    }
}