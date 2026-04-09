<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class PlatformDashboardController extends Controller
{
    public function index() {
        $stats = [
            'total_studios' => \App\Models\Studio::count(),
            'active_studios' => \App\Models\Studio::where('is_active', true)->count(),
            'total_users' => \App\Models\User::whereIn('role', ['admin', 'staff'])->count(),
            'pending_upgrades' => \App\Models\UpgradeRequest::where('status', 'pending')->count(),
            'pro_studios' => \App\Models\Studio::where('plan', 'pro')->count(),
            'free_studios' => \App\Models\Studio::where('plan', 'free')->count(),
        ];
        $recent_studios = \App\Models\Studio::latest()->take(5)->get();
        $pending_upgrades = \App\Models\UpgradeRequest::where('status', 'pending')->with('studio')->latest()->take(5)->get();
        return view('platform.dashboard', compact('stats', 'recent_studios', 'pending_upgrades'));
    }
}
