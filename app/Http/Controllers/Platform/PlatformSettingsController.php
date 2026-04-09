<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlatformSettingsController extends Controller
{
    public function index() {
        $user = auth()->user();
        $total_studios = Studio::count();
        $total_users = User::count();
        return view('platform.settings.index', compact('user', 'total_studios', 'total_users'));
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->update(['name' => $request->name, 'email' => $request->email]);

        if ($request->current_password && $request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $user->update(['password' => Hash::make($request->new_password)]);
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
