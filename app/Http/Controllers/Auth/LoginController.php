<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    // Alias for showLoginForm for route compatibility
    public function showLogin()
    {
        return $this->showLoginForm();
    }

    // ...existing code...
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showPlatformLoginForm()
    {
        return view('auth.platform-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'studio_slug' => 'nullable|string',
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if (!$user || !\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        if ($user->role === 'platform') {
            // Platform admin: ignore studio_slug, login directly
            \Illuminate\Support\Facades\Auth::login($user);
            return redirect('/platform');
        } else {
            // Studio admin or staff: require studio_slug
            if (empty($credentials['studio_slug'])) {
                return back()->withErrors(['studio_slug' => 'Studio slug is required for studio admin/staff.']);
            }
            $studio = \App\Models\Studio::where('slug', $credentials['studio_slug'])->first();
            if (!$studio) {
                return back()->withErrors(['studio_slug' => 'Invalid studio.']);
            }
            if ($user->studio_id != $studio->id) {
                return back()->withErrors(['studio_slug' => 'Invalid studio.']);
            }
            \Illuminate\Support\Facades\Auth::login($user);
            if ($user->role === 'admin') {
                return redirect('/admin');
            } elseif ($user->role === 'staff') {
                return redirect('/staff');
            }
            \Illuminate\Support\Facades\Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized role.']);
        }
    }

    public function platformLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $credentials['email'])->where('role', 'platform')->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
        Auth::login($user);
        return redirect('/platform');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
