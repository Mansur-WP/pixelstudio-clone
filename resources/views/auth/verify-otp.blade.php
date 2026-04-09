@extends('layouts.guest')
@section('content')
<div class="flex min-h-screen bg-white">
    <!-- Image Section (Left) -->
    <div class="hidden lg:flex lg:w-3/5 relative overflow-hidden">
        <img src="{{ asset('assets/login-bg.png') }}" alt="Studio Background" class="absolute inset-0 w-full h-full object-cover grayscale-[0.2] brightness-75">
        <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-slate-950/40 to-transparent"></div>
        
        <div class="relative z-10 flex flex-col justify-end p-20 w-full">
            <div class="space-y-6 max-w-xl">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-1 bg-indigo-500 rounded-full"></div>
                    <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Security Check</span>
                </div>
                <h1 class="text-6xl font-outfit font-black text-white leading-none tracking-tighter">
                    Check your <br><span class="text-indigo-500 underline decoration-indigo-500/30 underline-offset-8">Inbox.</span>
                </h1>
                <p class="text-lg text-slate-300 font-medium leading-relaxed">
                    We sent a 6-digit code to your email. Please type the code below to prove it's really you. This helps keep your account safe.
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section (Right) -->
    <div class="w-full lg:w-2/5 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white relative">
        <div class="w-full max-sm:max-w-xs lg:max-w-sm">
            <div class="mb-12">
                <div class="h-12 w-12 bg-slate-950 rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-indigo-500/10">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 21.248a11.955 11.955 0 01-9.618-13.264A11.955 11.955 0 0112 2.752a11.955 11.955 0 019.618 5.232z"></path></svg>
                </div>
                <h2 class="text-3xl font-outfit font-black text-slate-900 tracking-tight">Enter your <span class="text-indigo-600">Code</span></h2>
                <p class="text-slate-500 mt-2 font-medium italic">Sent to: {{ old('email', request('email')) }}</p>
            </div>

            @if($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl animate-shake">
                    <p class="text-rose-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        Wrong Code
                    </p>
                    <p class="text-rose-600/70 text-xs mt-1 font-medium italic">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/auth/verify-otp" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', request('email')) }}">
                
                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">6-Digit Security Code</label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                        </span>
                        <input type="text" name="code" maxlength="6" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-outfit text-2xl font-black text-center tracking-[0.5em] text-slate-700 placeholder-slate-200" placeholder="000000" required autofocus>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full h-16 bg-slate-950 hover:bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all transform hover:-translate-y-1 active:scale-95 shadow-2xl shadow-slate-200 flex items-center justify-center gap-3 group">
                        Confirm Code
                        <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">
                        Didn't get it? <a href="/forgot-password" class="text-indigo-600 hover:text-slate-900">Send again</a>
                    </p>
                </div>
            </form>

            <div class="mt-12 pt-12 border-t border-slate-100 text-center">
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest leading-none">© 2026 PixelStudio</span>
            </div>
        </div>
    </div>
</div>
@endsection
