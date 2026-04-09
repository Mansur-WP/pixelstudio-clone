<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index() {
        $studioId = auth()->user()->studio_id;
        $stats = [
            'total_clients' => \App\Models\Client::where('studio_id', $studioId)->count(),
            'total_staff' => \App\Models\User::where('studio_id', $studioId)->where('role', 'staff')->count(),
            'total_invoices' => \App\Models\Invoice::where('studio_id', $studioId)->count(),
            'unpaid_invoices' => \App\Models\Invoice::where('studio_id', $studioId)->where('status', 'unpaid')->count(),
            'total_revenue' => \App\Models\Payment::where('studio_id', $studioId)->sum('amount'),
            'total_photos' => \App\Models\Photo::where('studio_id', $studioId)->count(),
        ];
        $recent_activity = \App\Models\ActivityLog::where('studio_id', $studioId)
            ->latest()
            ->take(8)
            ->get();
        $recent_clients = \App\Models\Client::where('studio_id', $studioId)
            ->latest()
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('stats', 'recent_activity', 'recent_clients'));
    }
}
