<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Studio Admin') | PixelStudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .glass-sidebar { background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(16px); }
        .lux-card { background: white; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.01); }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="h-full text-slate-900 antialiased overflow-hidden">
    <div class="flex h-screen overflow-hidden bg-[#f8fafc]">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:w-72 md:flex-col glass-sidebar text-white relative z-20 shadow-2xl">
            <div class="flex flex-col h-full">
                <!-- Brand -->
                <div class="h-20 flex items-center px-8 border-b border-white/5 bg-slate-900/50">
                    <div class="h-10 w-10 bg-gradient-to-tr from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg transform rotate-3 mr-4">
                        <span class="text-xl font-black text-white italic">P</span>
                    </div>
                    <span class="font-outfit font-extrabold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">PixelStudio</span>
                </div>

                <!-- Role Badge -->
                <div class="px-8 mt-8 mb-4">
                    <div class="inline-flex items-center px-3 py-1 bg-white/5 rounded-full border border-white/10">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 mr-2 animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-300">
                            {{ auth()->check() ? auth()->user()->role : 'Terminal' }} Environment
                        </span>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto custom-scrollbar">
                    @php
                        $role = auth()->check() ? auth()->user()->role : 'guest';
                    @endphp

                    @if($role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.staff') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.staff') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Staff Management</span>
                        </a>
                        <a href="{{ route('admin.payments') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.payments') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Payments</span>
                        </a>
                        <a href="{{ route('admin.activity') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.activity') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Activity Logs</span>
                        </a>
                        <a href="{{ route('admin.settings') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('admin.settings') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Settings</span>
                        </a>
                    @elseif($role === 'staff')
                        <a href="{{ route('staff.dashboard') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('staff.dashboard') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Dashboard</span>
                        </a>
                        <a href="{{ route('staff.clients') }}" class="group flex items-center px-5 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('staff.clients*') ? 'bg-white/10 text-white shadow-lg' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="h-5 w-5 mr-3 opacity-70 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="text-sm font-semibold tracking-wide">Clients List</span>
                        </a>
                    @endif
                </nav>

                <!-- Footer Profile -->
                <div class="p-6 mt-auto border-t border-white/5 bg-black/20">
                    <div class="flex items-center p-3.5 bg-white/5 rounded-2xl border border-white/5">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center font-bold text-lg text-white mr-3 shadow-lg">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex-1 truncate">
                            <div class="text-sm font-bold truncate text-white leading-none mb-1">{{ auth()->user()->name ?? 'Operator' }}</div>
                            <div class="text-[9px] text-slate-400 font-black uppercase tracking-widest">{{ auth()->user()->role ?? 'ACCESS' }}</div>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-400 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Body -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
            <!-- Glass Header -->
            <header class="h-20 bg-white/70 backdrop-blur-xl border-b border-slate-200/50 flex items-center justify-between px-10 relative z-10 shrink-0">
                <div class="flex items-center gap-4">
                    <button class="md:hidden p-2 text-slate-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h1 class="text-2xl font-outfit font-extrabold text-slate-800 tracking-tight">@yield('title')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Notifications/Time/Search placeholders -->
                </div>
            </header>

            <!-- Page Container -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#f8fafc] p-10 custom-scrollbar relative">
                <!-- Visual Background Elements -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-500/5 blur-[120px] -z-10 rounded-full"></div>
                <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-500/5 blur-[120px] -z-10 rounded-full"></div>

                <div class="relative z-10">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
