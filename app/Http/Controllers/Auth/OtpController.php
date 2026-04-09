<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\OtpCode;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function showVerifyOtp()
    {
        return view('auth.verify-otp');
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function requestOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }
        $otp = random_int(100000, 999999);
        OtpCode::create([
            'email' => $user->email,
            'code' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
        ]);
        // You should implement a real mail here
        // Mail::to($user->email)->send(new OtpMail($otp));
        return back()->with('status', 'OTP sent to your email.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
        ]);
        $otp = OtpCode::where('email', $request->email)
            ->where('code', $request->code)
            ->whereNull('used_at')
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if (!$otp) {
            return back()->withErrors(['code' => 'Invalid or expired OTP.']);
        }
        return redirect('/reset-password?email=' . urlencode($request->email) . '&code=' . urlencode($request->code));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        $otp = OtpCode::where('email', $request->email)
            ->where('code', $request->code)
            ->whereNull('used_at')
            ->where('expires_at', '>', Carbon::now())
            ->first();
        if (!$otp) {
            return back()->withErrors(['code' => 'Invalid or expired OTP.']);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found.']);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        $otp->used_at = Carbon::now();
        $otp->save();
        return redirect('/login')->with('status', 'Password reset successful.');
    }
}
