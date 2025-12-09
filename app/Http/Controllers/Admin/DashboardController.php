<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get stats
        $stats = [
            'total_users' => User::count(),
            'total_profiles' => Profile::count(),
            'total_products' => Product::count(),
            'total_categories' => 0, // Placeholder - no Category model exists yet
        ];

        // Get recent users (last 5)
        $recentUsers = User::latest()->take(5)->get();

        // Get recent products (last 5) with profile and user relationships
        $recentProducts = Product::with(['profile.user'])->latest()->take(5)->get();

        // Get monthly user registrations for the last 12 months
        $monthlyRegistrations = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

        // Create array for chart data (12 months)
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M');
            $monthNum = $date->month;
            $yearNum = $date->year;
            
            $chartLabels[] = $monthName;
            
            $registration = $monthlyRegistrations->first(function ($item) use ($monthNum, $yearNum) {
                return $item->month == $monthNum && $item->year == $yearNum;
            });
            
            $chartData[] = $registration ? $registration->count : 0;
        }

        return view('admin.dashboard.dashboard', compact('stats', 'recentUsers', 'recentProducts', 'chartLabels', 'chartData'));
    }
}
