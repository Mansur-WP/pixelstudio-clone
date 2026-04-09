<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\Client;
use App\Models\Photo;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PlatformAnalyticsController extends Controller
{
    public function index() {
        $data = [
            'total_studios' => Studio::count(),
            'active_studios' => Studio::where('is_active', true)->count(),
            'total_clients' => Client::count(),
            'total_photos' => Photo::count(),
            'total_invoices' => Invoice::count(),
            'total_revenue' => Payment::sum('amount'),
            'paid_invoices' => Invoice::where('status', 'paid')->count(),
            'unpaid_invoices' => Invoice::where('status', 'unpaid')->count(),
            'pro_studios' => Studio::where('plan', 'pro')->count(),
            'free_studios' => Studio::where('plan', 'free')->count(),
            'studios_per_month' => Studio::selectRaw('strftime("%m", created_at) as month, count(*) as count')
                ->groupBy('month')->get(),
        ];
        return view('platform.analytics.index', compact('data'));
    }
}
