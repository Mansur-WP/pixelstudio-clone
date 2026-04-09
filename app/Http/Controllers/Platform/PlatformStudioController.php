<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PlatformStudioController extends Controller
{
    public function index() {
        $studios = Studio::withCount(['clients', 'users'])
            ->latest()
            ->paginate(10);
        return view('platform.studios.index', compact('studios'));
    }

    public function create() {
        return view('platform.studios.create');
    }

    public function show($id) {
        $studio = Studio::withCount(['clients', 'users'])
            ->with(['users', 'clients'])
            ->findOrFail($id);
        return view('platform.studios.show', compact('studio'));
    }

    public function destroy($id) {
        Studio::findOrFail($id)->delete();
        return redirect()->route('platform.studios')->with('success', 'Studio deleted!');
    }

    public function store(Request $request) {
        $request->validate([
            'studio_name' => 'required|string|max:255',
            'studio_slug' => 'required|string|unique:studios,slug|alpha_dash',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|min:6',
            'plan' => 'required|in:free,pro',
        ]);

        // Create the studio
        $studio = Studio::create([
            'name' => $request->studio_name,
            'slug' => $request->studio_slug,
            'plan' => $request->plan,
            'is_active' => true,
        ]);

        // Create the studio admin user
        User::create([
            'studio_id' => $studio->id,
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Log the activity
        ActivityLog::create([
            'studio_id' => $studio->id,
            'user_id' => auth()->id(),
            'action' => 'studio_created',
            'description' => "Platform admin created new studio: {$studio->name}",
        ]);

        return redirect()->route('platform.studios')->with('success', "Studio '{$studio->name}' created successfully with admin account!");
    }

    public function toggleStatus($id) {
        $studio = Studio::findOrFail($id);
        $studio->update(['is_active' => !$studio->is_active]);
        return back()->with('success', 'Studio status updated!');
    }

    public function togglePlan($id) {
        $studio = Studio::findOrFail($id);
        $newPlan = $studio->plan === 'free' ? 'pro' : 'free';
        $studio->update(['plan' => $newPlan]);
        return back()->with('success', "Studio plan switched to {$newPlan}!");
    }
}
