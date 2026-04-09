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
                    <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Secure Recovery</span>
                </div>
                <h1 class="text-6xl font-outfit font-black text-white leading-none tracking-tighter">
                    Don't worry, <br><span class="text-indigo-500 underline decoration-indigo-500/30 underline-offset-8">We've got you.</span>
                </h1>
                <p class="text-lg text-slate-300 font-medium leading-relaxed">
                    Simply enter your email address and we will send you a security code to reset your password. It only takes a minute to get back to your work.
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section (Right) -->
    <div class="w-full lg:w-2/5 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white relative">
        <div class="w-full max-sm:max-w-xs lg:max-w-sm">
            <div class="mb-12">
                <div class="h-12 w-12 bg-slate-950 rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-indigo-500/10">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-3xl font-outfit font-black text-slate-900 tracking-tight">Reset <span class="text-indigo-600">Password</span></h2>
                <p class="text-slate-500 mt-2 font-medium">We'll send a code to your email</p>
            </div>

            @if(session('status'))
                <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl">
                    <p class="text-emerald-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Success
                    </p>
                    <p class="text-emerald-600/70 text-xs mt-1 font-medium">{{ session('status') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl animate-shake">
                    <p class="text-rose-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        Error
                    </p>
                    <p class="text-rose-600/70 text-xs mt-1 font-medium italic">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/auth/request-otp" class="space-y-6">
                @csrf
                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Your Email</label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </span>
                        <input type="email" name="email" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="e.g. you@studio.com" required autofocus>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full h-16 bg-slate-950 hover:bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all transform hover:-translate-y-1 active:scale-95 shadow-2xl shadow-slate-200 flex items-center justify-center gap-3 group">
                        Send Code
                        <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <a href="/login" class="w-full h-14 bg-white border border-slate-100 text-slate-400 hover:text-slate-900 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] transition-all flex items-center justify-center gap-3 group">
                        <svg class="h-3 w-3 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to Login
                    </a>
                </div>
            </form>

            <div class="mt-12 pt-12 border-t border-slate-100 text-center">
                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest leading-none">© 2026 PixelStudio</span>
            </div>
        </div>
    </div>
</div>
@endsection
