<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class UpgradeRequestController extends Controller
{
    public function index() {
        $requests = \App\Models\UpgradeRequest::with('studio')
            ->latest()->paginate(10);
        return view('platform.upgrade-requests.index', compact('requests'));
    }

    public function confirm($id) {
        $upgradeRequest = \App\Models\UpgradeRequest::findOrFail($id);
        $upgradeRequest->update(['status' => 'confirmed', 'reviewed_at' => now()]);
        $upgradeRequest->studio->update(['plan' => $upgradeRequest->plan_requested]);
        return back()->with('success', 'Upgrade confirmed!');
    }

    public function reject($id) {
        $upgradeRequest = \App\Models\UpgradeRequest::findOrFail($id);
        $upgradeRequest->update(['status' => 'rejected', 'reviewed_at' => now()]);
        return back()->with('success', 'Upgrade request rejected!');
    }
}
