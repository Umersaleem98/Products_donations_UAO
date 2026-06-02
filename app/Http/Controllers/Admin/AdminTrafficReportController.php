<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorTracker;
use Illuminate\Support\Facades\DB;

class AdminTrafficReportController extends Controller
{
    public function index()
    {
        // =========================
        // BASIC STATS (KPI CARDS)
        // =========================

        $todayVisitors = VisitorTracker::whereDate('created_at', today())->count();

        $weekVisitors = VisitorTracker::where('created_at', '>=', now()->subDays(7))->count();

        $monthVisitors = VisitorTracker::whereMonth('created_at', now()->month)->count();

        $yearVisitors = VisitorTracker::whereYear('created_at', now()->year)->count();

        $previousYearVisitors = VisitorTracker::whereYear('created_at', now()->subYear()->year)->count();

        $totalVisitors = VisitorTracker::count();

        // =========================
        // DAILY TRAFFIC (LAST 30 DAYS)
        // =========================

        $dailyTraffic = VisitorTracker::select(
                DB::raw('DATE(created_at) as day'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // =========================
        // BROWSER STATS
        // =========================

        $browserStats = VisitorTracker::select(
                'browser',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('browser')
            ->orderByDesc('total')
            ->get();

        // =========================
        // RECENT VISITORS
        // =========================

        $recentVisitors = VisitorTracker::latest()
            ->take(12)
            ->get();

        // =========================
        // RETURN VIEW
        // =========================

        return view('pages.admin.reports.index', compact(
            'todayVisitors',
            'weekVisitors',
            'monthVisitors',
            'yearVisitors',
            'previousYearVisitors',
            'totalVisitors',
            'dailyTraffic',
            'browserStats',
            'recentVisitors'
        ));
    }
}