<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index() {
        $studio = Studio::find(auth()->user()->studio_id);
        $user = auth()->user();
        return view('admin.settings.index', compact('studio', 'user'));
    }

    public function update(Request $request) {
        $request->validate([
            'studio_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $studio = Studio::find(auth()->user()->studio_id);
        $studio->update(['name' => $request->studio_name]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $studio->update(['logo_path' => $path]);
        }

        $user = auth()->user();
        $user->update(['name' => $request->name, 'email' => $request->email]);

        if ($request->current_password && $request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->update(['password' => Hash::make($request->new_password)]);
        }

        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'settings_updated',
            'description' => 'Studio settings updated',
        ]);

        return back()->with('success', 'Settings saved successfully!');
    }
}
