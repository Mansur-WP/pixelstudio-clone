<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $studioId = auth()->user()->studio_id;
        $stats = [
            'total_clients' => \App\Models\Client::where('studio_id', $studioId)->count(),
            'total_photos' => \App\Models\Photo::where('studio_id', $studioId)->count(),
            'total_invoices' => \App\Models\Invoice::where('studio_id', $studioId)->count(),
            'unpaid_invoices' => \App\Models\Invoice::where('studio_id', $studioId)->where('status', 'unpaid')->count(),
        ];
        $recent_clients = \App\Models\Client::where('studio_id', $studioId)->latest()->take(5)->get();
        return view('staff.dashboard', compact('stats', 'recent_clients'));
    }
}
