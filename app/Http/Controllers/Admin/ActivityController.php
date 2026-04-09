<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index() {
        $activities = ActivityLog::where('studio_id', auth()->user()->studio_id)
            ->with('user')
            ->latest()
            ->paginate(20);
        return view('admin.activity.index', compact('activities'));
    }
}
