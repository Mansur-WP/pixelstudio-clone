<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PlatformActivityController extends Controller
{
    public function index() {
        $activities = ActivityLog::with(['user', 'studio'])
            ->latest()
            ->paginate(30);
        return view('platform.activity.index', compact('activities'));
    }
}
