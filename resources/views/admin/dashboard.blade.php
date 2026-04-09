@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="space-y-12 pb-20">
    <!-- Stat Hero -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Revenue Card -->
        <article class="bg-indigo-950 p-8 rounded-[2.5rem] shadow-2xl shadow-indigo-950/20 text-white relative overflow-hidden group">
            <div class="absolute -right-10 -top-10 h-32 w-32 bg-white/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-500"></div>
            <div class="flex items-center gap-4 mb-8">
                <div class="h-12 w-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md">
                    <span class="text-2xl">₦</span>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300">Total Studio Revenue</span>
            </div>
            <div class="space-y-1">
                <p class="text-4xl font-outfit font-black tracking-tighter">{{ number_format($stats['total_revenue'], 2) }}</p>
                <div class="flex items-center gap-2 text-[11px] font-bold text-emerald-400">
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span>Performance Tracking</span>
                </div>
            </div>
        </article>

        <!-- Personnel & Units -->
        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all">
            <div class="flex items-center gap-3 mb-8">
                <div class="h-10 w-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Staff</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['total_staff'] }}</p>
                    <p class="text-[11px] font-bold text-slate-400 mt-2">Active Staff Members</p>
                </div>
                <div class="h-12 w-20 flex items-end gap-1 opacity-20">
                    <div class="h-4 w-2 bg-purple-600 rounded-sm"></div>
                    <div class="h-8 w-2 bg-purple-600 rounded-sm"></div>
                    <div class="h-6 w-2 bg-purple-600 rounded-sm"></div>
                    <div class="h-10 w-2 bg-purple-600 rounded-sm"></div>
                </div>
            </div>
        </article>

        <!-- Portfolio Assets -->
        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all">
            <div class="flex items-center gap-3 mb-8">
                <div class="h-10 w-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Photos</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ number_format($stats['total_photos']) }}</p>
                    <p class="text-[11px] font-bold text-slate-400 mt-2">Captured photos</p>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl">
                    <span class="text-xs font-black text-amber-600 tracking-tighter">LIVE POOL</span>
                </div>
            </div>
        </article>
    </div>

    <!-- Secondary Insights -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Client Expansion -->
        <section class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/30 border border-slate-100 overflow-hidden relative">
            <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <div>
                    <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Recent Clients</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Newly added clients</p>
                </div>
            </div>
            <div class="p-4">
                @forelse($recent_clients as $client)
                    <div class="flex items-center justify-between p-5 hover:bg-slate-50 rounded-[1.5rem] transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center font-black text-slate-400 text-xs border border-slate-200 group-hover:bg-white transition-colors">
                                {{ substr($client->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-bold text-slate-900 leading-none mb-1">{{ $client->name }}</div>
                                <div class="text-[10px] font-medium text-slate-400">{{ $client->email }}</div>
                            </div>
                        </div>
                        <div class="text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">{{ $client->created_at->format('M d, Y') }}</div>
                    </div>
                @empty
                    <div class="py-20 text-center opacity-40">No signals detected.</div>
                @endforelse
            </div>
        </section>

        <!-- Audit Chronicle -->
        <section class="bg-white rounded-[2.5rem] shadow-2xl shadow-purple-100/30 border border-slate-100 overflow-hidden relative">
            <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <div>
                    <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Activity Log</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Latest actions feed</p>
                </div>
                <div class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                </div>
            </div>
            <div class="p-4">
                @forelse($recent_activity as $activity)
                    <div class="flex flex-col p-5 hover:bg-slate-50 rounded-[1.5rem] transition-all border border-transparent hover:border-slate-100">
                        <div class="flex items-center justify-between mb-2">
                             <span class="px-2 py-0.5 bg-indigo-50 text-indigo-700 text-[9px] font-black uppercase tracking-widest rounded-md border border-indigo-100">
                                {{ $activity->action }}
                            </span>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-tighter">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-slate-600 font-medium leading-relaxed">{{ $activity->description }}</p>
                    </div>
                @empty
                    <div class="py-20 text-center opacity-40 italic font-medium">Clear transmission. No signals.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
