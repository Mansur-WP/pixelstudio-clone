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
                    <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Account Security</span>
                </div>
                <h1 class="text-6xl font-outfit font-black text-white leading-none tracking-tighter">
                    Choose a new <br><span class="text-indigo-500 underline decoration-indigo-500/30 underline-offset-8">Password.</span>
                </h1>
                <p class="text-lg text-slate-300 font-medium leading-relaxed">
                    Make sure to pick a password that is hard to guess but easy for you to remember. Once you save it, you can sign in to your studio.
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section (Right) -->
    <div class="w-full lg:w-2/5 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white relative">
        <div class="w-full max-sm:max-w-xs lg:max-w-sm">
            <div class="mb-12">
                <div class="h-12 w-12 bg-slate-950 rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-indigo-500/10">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <h2 class="text-3xl font-outfit font-black text-slate-900 tracking-tight">Security <span class="text-indigo-600">Update</span></h2>
                <p class="text-slate-500 mt-2 font-medium">Create your new password below</p>
            </div>

            @if($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl animate-shake">
                    <p class="text-rose-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        Update Failed
                    </p>
                    <p class="text-rose-600/70 text-xs mt-1 font-medium italic">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/auth/reset-password" class="space-y-6">
                @csrf
                <input type="hidden" name="email" value="{{ request('email') }}">
                <input type="hidden" name="code" value="{{ request('code') }}">
                
                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">New Password</label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="Minimum 8 characters" required>
                    </div>
                </div>

                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Confirm Password</label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password_confirmation" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="Type it again" required>
                    </div>
                </div>

                <button type="submit" class="w-full h-16 bg-slate-950 hover:bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all transform hover:-translate-y-1 active:scale-95 shadow-2xl shadow-slate-200 mt-4 flex items-center justify-center gap-3 group">
                    Save and Sign In
                    <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </form>

            <div class="mt-12 pt-12 border-t border-slate-100 text-center">
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest leading-none">© 2026 PixelStudio</span>
            </div>
        </div>
    </div>
</div>
@endsection
