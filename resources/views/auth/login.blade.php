@extends('layouts.guest')
@section('content')
<div class="flex min-h-screen bg-white">
    <!-- Image Section (Left) -->
    <div class="hidden lg:flex lg:w-3/5 relative overflow-hidden">
        <img src="{{ asset('assets/login-bg.png') }}" alt="Studio Interface" class="absolute inset-0 w-full h-full object-cover grayscale-[0.2] brightness-75">
        <div class="absolute inset-0 bg-gradient-to-tr from-slate-950 via-slate-950/40 to-transparent"></div>
        
        <div class="relative z-10 flex flex-col justify-end p-20 w-full">
            <div class="space-y-6 max-w-xl">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-1 bg-indigo-500 rounded-full"></div>
                    <span class="text-indigo-400 font-bold uppercase tracking-[0.3em] text-[10px]">Command Center Access</span>
                </div>
                <h1 class="text-6xl font-outfit font-black text-white leading-none tracking-tighter">
                    Streamline Your <br><span class="text-indigo-500 underline decoration-indigo-500/30 underline-offset-8">Creative Force.</span>
                </h1>
                <p class="text-lg text-slate-300 font-medium leading-relaxed">
                    PixelStudio provides high-performance infrastructure for world-class photography boutiques. Manage clients, capture moments, and scale your vision.
                </p>
            </div>
            
            <div class="mt-20 flex items-center gap-6 text-slate-400">
                <div class="flex -space-x-4 overflow-hidden">
                    <img src="{{ asset('assets/kao-logo.png') }}" class="inline-block h-14 w-14 rounded-full ring-4 ring-slate-900 bg-slate-800 object-cover" title="Kelechi Amadi-Obi">
                    <div class="inline-block h-14 w-14 rounded-full ring-4 ring-slate-900 bg-indigo-600 flex items-center justify-center font-bold text-[11px] text-white tracking-tighter ring-offset-2 ring-offset-slate-900" title="George Okoro Photography">GOP</div>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-sm font-black text-white tracking-wide">Trusted by Industry Titans</span>
                    <span class="text-[10px] font-medium text-slate-500 uppercase tracking-[0.2em]">Tubeless • Balancy</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section (Right) -->
    <div class="w-full lg:w-2/5 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white relative">
        <div class="w-full max-w-sm">
            <div class="mb-12">
                <div class="h-12 w-12 bg-slate-950 rounded-2xl flex items-center justify-center mb-6 shadow-2xl shadow-indigo-500/10">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                </div>
                <h2 class="text-3xl font-outfit font-black text-slate-900 tracking-tight">Access Your <span class="text-indigo-600">Portal</span></h2>
                <p class="text-slate-500 mt-2 font-medium">Authenticate to enter the command center</p>
            </div>

            @if($errors->any())
                <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-xl animate-shake">
                    <p class="text-rose-700 text-sm font-bold flex items-center gap-2">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                        Authentication Failed
                    </p>
                    <p class="text-rose-600/70 text-xs mt-1 font-medium italic">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf
                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Email Address</label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                        </span>
                        <input type="email" name="email" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="e.g. admin@studio.com" required autofocus value="{{ old('email') }}">
                    </div>
                </div>

                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <div class="flex items-center justify-between ml-1">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Security Key</label>
                        <a href="/forgot-password" class="text-[10px] font-black uppercase tracking-widest text-indigo-500 hover:text-slate-900 transition-colors">Recover?</a>
                    </div>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </span>
                        <input type="password" name="password" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="space-y-1.5 focus-within:translate-x-1 transition-transform">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Workspace ID <span class="normal-case font-medium lowercase italic text-slate-300 ml-1">(Optional for Platform)</span></label>
                    <div class="group relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </span>
                        <input type="text" name="studio_slug" class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700 placeholder-slate-300" placeholder="e.g. amazing-studio" value="{{ old('studio_slug') }}">
                    </div>
                </div>

                <button type="submit" class="w-full h-16 bg-slate-950 hover:bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all transform hover:-translate-y-1 active:scale-95 shadow-2xl shadow-slate-200 mt-4 flex items-center justify-center gap-3 group">
                    Enter Dashboard
                    <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>

            <div class="mt-12 pt-12 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none">© 2026 PixelStudio</span>
                <div class="flex gap-4">
                    <a href="#" class="text-slate-300 hover:text-indigo-500 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg>
                    </a>
                    <a href="#" class="text-slate-300 hover:text-indigo-500 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.012 3.855.06 1.061.044 1.781.209 2.415.456.655.253 1.21.593 1.76 1.145.552.552.892 1.107 1.145 1.761.247.633.412 1.354.456 2.415.047 1.071.059 1.425.059 3.855 0 2.43-.012 2.784-.06 3.855-.044 1.061-.209 1.781-.456 2.415-.253.655-.593 1.21-1.145 1.76-.552.552-1.107.892-1.761 1.145-.633.247-1.354.412-2.415.456-1.071.047-1.425.059-3.855.059-2.43 0-2.784-.012-3.855-.06-1.061-.044-1.781-.209-2.415-.456-.655-.253-1.21-.593-1.76-1.145-.552-.552-.892-1.107-1.145-1.761-.247-.633-.412-1.354-.456-2.415-.047-1.071-.059-1.425-.059-3.855 0-2.43.012-2.784.06-3.855.044-1.061.209-1.781.456-2.415.253-.655.593-1.21 1.145-1.76.552-.552 1.107-.892 1.761-1.145.633-.247 1.354-.412 2.415-.456 1.071-.047 1.425-.059 3.855-.059zm-1.14 1.14c-2.43 0-2.784.012-3.855.06-1.061.044-1.781.209-2.415.456-.655.253-1.21.593-1.76 1.145-.552.552-.892 1.107-1.145 1.761-.247.633-.412 1.354-.456 2.415-.047 1.071-.059 1.425-.059 3.855 0 2.43.012 2.784.06 3.855.044 1.061.209 1.781.456 2.415.253.655.593 1.21 1.145 1.76.552.552 1.107.892 1.761 1.145.633.247 1.354.412 2.415.456 1.071.047 1.425.059 3.855.059 2.43 0 2.784-.012 3.855-.06 1.061-.044 1.781-.209 2.415-.456.655-.253 1.21-.593 1.76-1.145.552-.552.892-1.107 1.145-1.761.247-6.33.412-1.354.456-2.415.047-1.071.059-1.425.059-3.855x"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
