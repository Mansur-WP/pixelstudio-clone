<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Platform Admin') | PixelStudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .glass-panel { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="h-full text-slate-900 antialiased">
    <div class="flex h-screen overflow-hidden bg-[#f8fafc]">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:w-[280px] md:flex-col bg-indigo-950 text-white relative z-20 shadow-2xl">
            <div class="flex flex-col h-full">
                <!-- Brand -->
                <div class="h-20 flex items-center px-8 border-b border-white/5 bg-indigo-950/50 backdrop-blur-sm">
                    <div class="h-10 w-10 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg transform rotate-3 mr-4">
                        <span class="text-xl font-black text-white italic">P</span>
                    </div>
                    <span class="font-outfit font-extrabold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-indigo-300">PixelStudio</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-8 space-y-1.5 overflow-y-auto custom-scrollbar">
                    <div class="px-4 mb-4 text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] opacity-60">Main Menu</div>
                    
                    <a href="/platform" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>

                    <a href="/platform/studios" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform/studios*') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="text-sm font-semibold">All Studios</span>
                    </a>

                    <a href="/platform/upgrade-requests" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform/upgrade-requests*') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span class="text-sm font-semibold">Plan Requests</span>
                    </a>

                    <div class="px-4 mt-8 mb-4 text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] opacity-60">Operations</div>

                    <a href="/platform/analytics" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform/analytics*') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span class="text-sm font-semibold">Analytics</span>
                    </a>

                    <a href="/platform/activity" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform/activity*') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-semibold">Activity Logs</span>
                    </a>

                    <div class="px-4 mt-8 mb-4 text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] opacity-60">Settings</div>

                    <a href="/platform/settings" class="group flex items-center px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->is('platform/settings*') ? 'bg-white/10 text-white shadow-soft' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                        <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm font-semibold">Settings</span>
                    </a>
                </nav>

                <!-- Footer -->
                <div class="p-6 border-t border-white/5 bg-black/10">
                    <div class="flex items-center p-3 bg-white/5 rounded-2xl">
                        <div class="h-10 w-10 rounded-xl bg-indigo-500 flex items-center justify-center font-bold text-lg text-white mr-3">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 truncate">
                            <div class="text-sm font-bold truncate">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-indigo-300 font-bold uppercase tracking-tight">Root Admin</div>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="p-2 text-indigo-300 hover:text-white transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
            <!-- Top Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-100 flex items-center justify-between px-10 relative z-10">
                <div class="flex items-center gap-4">
                    <button class="md:hidden p-2 text-slate-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="text-2xl font-outfit font-extrabold text-slate-800 tracking-tight">@yield('title')</h2>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex items-center px-4 py-2 bg-slate-50 border border-slate-100 rounded-2xl text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        <span class="mr-2">Environment:</span>
                        <span class="text-indigo-600">Mainnet Live</span>
                    </div>
                </div>
            </header>

            <!-- Scrollable Page Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-10 custom-scrollbar relative">
                <!-- Decoration -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-50/50 blur-[100px] -z-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-50/50 blur-[100px] -z-10 rounded-full"></div>

                @yield('content')
            </main>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(0,0,0,0.1); }
        .shadow-soft { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    </style>
</body>
</html>
