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
        // BASIC KPI
        // =========================

        $today = VisitorTracker::whereDate('created_at', today())->count();
        $yesterday = VisitorTracker::whereDate('created_at', today()->subDay())->count();

        $week = VisitorTracker::where('created_at', '>=', now()->startOfWeek())->count();
        $lastWeek = VisitorTracker::whereBetween('created_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->count();

        $month = VisitorTracker::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonth = VisitorTracker::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $year = VisitorTracker::whereYear('created_at', now()->year)->count();

        $lastYear = VisitorTracker::whereYear('created_at', now()->subYear()->year)->count();

        $total = VisitorTracker::count();

        // =========================
        // HELPER: % CHANGE
        // =========================

        $percent = function ($current, $previous) {
            if ($previous == 0) return 100;
            return round((($current - $previous) / $previous) * 100, 2);
        };

        // =========================
        // DAILY (30 DAYS)
        // =========================

        $daily = VisitorTracker::select(
            DB::raw('DATE(created_at) as label'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('label')
        ->orderBy('label')
        ->get();

        // =========================
        // WEEKLY (8 WEEKS)
        // =========================

        $weekly = VisitorTracker::select(
            DB::raw('YEARWEEK(created_at,1) as label'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subWeeks(8))
        ->groupBy('label')
        ->orderBy('label')
        ->get();

        // =========================
        // MONTHLY (12 MONTHS)
        // =========================

        $monthly = VisitorTracker::select(
            DB::raw('DATE_FORMAT(created_at,"%Y-%m") as label'),
            DB::raw('COUNT(*) as total')
        )
        ->where('created_at', '>=', now()->subMonths(12))
        ->groupBy('label')
        ->orderBy('label')
        ->get();

        // =========================
        // YEARLY
        // =========================

        $yearly = VisitorTracker::select(
            DB::raw('YEAR(created_at) as label'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('label')
        ->orderBy('label')
        ->get();

        // =========================
        // BROWSER + PLATFORM
        // =========================

        $browser = VisitorTracker::select('browser', DB::raw('COUNT(*) as total'))
            ->groupBy('browser')->get();

        $platform = VisitorTracker::select('platform', DB::raw('COUNT(*) as total'))
            ->groupBy('platform')->get();

        // =========================
        // RECENT
        // =========================

        $recent = VisitorTracker::latest()->paginate(10);

        return view('pages.admin.reports.index', [
            // KPIs
            'today' => $today,
            'yesterday' => $yesterday,
            'week' => $week,
            'lastWeek' => $lastWeek,
            'month' => $month,
            'lastMonth' => $lastMonth,
            'year' => $year,
            'lastYear' => $lastYear,
            'total' => $total,

            // % changes
            'todayGrowth' => $percent($today, $yesterday),
            'weekGrowth' => $percent($week, $lastWeek),
            'monthGrowth' => $percent($month, $lastMonth),
            'yearGrowth' => $percent($year, $lastYear),

            // charts
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly,
            'yearly' => $yearly,

            // stats
            'browser' => $browser,
            'platform' => $platform,

            'recent' => $recent,
        ]);
    }
}
