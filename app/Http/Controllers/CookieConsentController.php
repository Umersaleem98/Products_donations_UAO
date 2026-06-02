<?php

namespace App\Http\Controllers;

use App\Models\VisitorTracker;
use Illuminate\Http\Request;

class CookieConsentController extends Controller
{
    public function accept(Request $request)
    {
        $ip = $request->ip();

        $browser = $request->header('User-Agent');

        VisitorTracker::where('ip_address', $ip)
            ->update([
                'cookie_accepted' => true
            ]);

        session()->forget('show_cookie_popup');

        return response()->json([
            'status' => 'success'
        ]);
    }
}
