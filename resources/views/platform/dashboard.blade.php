@extends('layouts.platform')
@section('title', 'Platform Overview')
@section('content')
<div class="space-y-12 pb-20">
    <!-- Stat Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center group hover:-translate-y-1 transition-all duration-300">
            <div class="h-14 w-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mr-5 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <span class="text-2xl">🏢</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Studios</p>
                <p class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['total_studios'] }}</p>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex items-center group hover:-translate-y-1 transition-all duration-300">
            <div class="h-14 w-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mr-5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <span class="text-2xl">✅</span>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Active Studios</p>
                <p class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['active_studios'] }}</p>
            </div>
        </div>

        <div class="bg-indigo-950 p-8 rounded-[2rem] shadow-2xl shadow-indigo-900/40 flex items-center text-white group hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 h-32 w-32 bg-white/5 rounded-full blur-2xl"></div>
            <div class="h-14 w-14 bg-white/10 rounded-2xl flex items-center justify-center text-white mr-5 backdrop-blur-md">
                <span class="text-2xl">👤</span>
            </div>
            <div class="relative">
                <p class="text-[10px] font-black text-indigo-300 uppercase tracking-widest mb-1">Total Users</p>
                <p class="text-3xl font-outfit font-black text-white leading-none">{{ $stats['total_users'] }}</p>
            </div>
        </div>
    </div>

    <!-- Secondary Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white/60 p-6 rounded-[1.5rem] border border-slate-100 flex items-center gap-4">
            <div class="h-10 w-10 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600">⏳</div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pending Requests</span>
                <p class="text-xl font-black text-slate-800">{{ $stats['pending_upgrades'] }}</p>
            </div>
        </div>
        <div class="bg-white/60 p-6 rounded-[1.5rem] border border-slate-100 flex items-center gap-4">
            <div class="h-10 w-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">💎</div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pro Studios</span>
                <p class="text-xl font-black text-slate-800">{{ $stats['pro_studios'] }}</p>
            </div>
        </div>
        <div class="bg-white/60 p-6 rounded-[1.5rem] border border-slate-100 flex items-center gap-4">
            <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-600">🆓</div>
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Free Studios</span>
                <p class="text-xl font-black text-slate-800">{{ $stats['free_studios'] }}</p>
            </div>
        </div>
    </div>

    <!-- Two Column Module -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Onboarding -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/30 border border-slate-100 overflow-hidden">
            <div class="px-10 py-8 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Recent Studios</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Latest onboarded studios</p>
                </div>
                <a href="/platform/studios" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:underline">View All</a>
            </div>
            <div class="p-4">
                @forelse($recent_studios as $studio)
                    <div class="flex items-center justify-between p-6 hover:bg-slate-50 rounded-3xl transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-slate-100 transition-colors group-hover:bg-white flex items-center justify-center font-black text-slate-400 border border-slate-200">
                                {{ substr($studio->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $studio->name }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ ucfirst($studio->plan) }}</span>
                                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                    <span class="text-[9px] font-black uppercase tracking-widest {{ $studio->is_active ? 'text-emerald-500' : 'text-slate-400' }}">
                                        {{ $studio->is_active ? 'Online' : 'Dormant' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-indigo-600 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 italic">No studio signals detected.</div>
                @endforelse
            </div>
        </div>

        <!-- Pending Actions -->
        <div class="bg-indigo-950 rounded-[2.5rem] shadow-2xl shadow-indigo-900/40 overflow-hidden text-white relative">
            <div class="absolute -right-20 -bottom-20 h-64 w-64 bg-indigo-500/10 rounded-full blur-[80px]"></div>
            <div class="px-10 py-8 border-b border-white/5 bg-white/5 backdrop-blur-sm flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-outfit font-black text-white tracking-tight">Upgrade Requests</h2>
                    <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest mt-1">Pending approval requests</p>
                </div>
                <a href="/platform/upgrade-requests" class="text-[10px] font-black text-indigo-300 uppercase tracking-widest hover:text-white transition-colors">View All</a>
            </div>
            <div class="p-4 relative z-10">
                @forelse($pending_upgrades as $upgrade)
                    <div class="flex items-center justify-between p-6 hover:bg-white/5 rounded-3xl transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center font-black text-white border border-white/10">
                                {{ substr($upgrade->studio->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-base font-bold text-white group-hover:text-indigo-300 transition-colors">{{ $upgrade->studio->name ?? 'Unknown' }}</div>
                                <div class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest mt-1">Requesting {{ $upgrade->plan_requested }} Tier</div>
                            </div>
                        </div>
                        <div class="text-indigo-400 group-hover:text-white transition-colors translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                @empty
                    <div class="py-20 flex flex-col items-center justify-center opacity-40">
                        <span class="text-4xl mb-4">✨</span>
                        <p class="text-sm font-bold uppercase tracking-widest italic">All queues cleared</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
