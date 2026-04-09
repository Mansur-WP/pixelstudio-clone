@extends('layouts.platform')
@section('title', 'Studio Details')
@section('content')
<div class="space-y-10 pb-20">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-4">
            <a href="{{ route('platform.studios') }}" class="group inline-flex items-center text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-indigo-600 transition-colors">
                <svg class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Studios
            </a>
            <div class="flex items-center gap-6">
                <div class="h-20 w-20 rounded-[2rem] bg-indigo-950 flex items-center justify-center text-white text-3xl font-black shadow-2xl shadow-indigo-200">
                    {{ substr($studio->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-4xl font-outfit font-black text-slate-900 tracking-tighter">{{ $studio->name }}</h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="px-3 py-1 bg-slate-100 rounded-lg text-[10px] font-black text-slate-500 uppercase tracking-widest border border-slate-200">ID: PS-{{ str_pad($studio->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span class="px-3 py-1 bg-indigo-50 rounded-lg text-[10px] font-black text-indigo-600 uppercase tracking-widest border border-indigo-100">{{ ucfirst($studio->plan) }} Plan</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <form action="{{ route('platform.studios.toggle', $studio->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-8 py-4 {{ $studio->is_active ? 'bg-rose-50 text-rose-600 hover:bg-rose-600' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600' }} hover:text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all active:scale-95 shadow-sm">
                    {{ $studio->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Telemetry Deck -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <article class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Portfolio Size</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $studio->clients_count }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Clients onboarded</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Staff</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $studio->users_count }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Staff members</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Current Plan</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none capitalize">{{ $studio->plan }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Subscription</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 {{ $studio->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} rounded-2xl flex items-center justify-center mb-6 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $studio->is_active ? 'Active' : 'Inactive' }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Current state</span>
                </div>
            </div>
        </article>
    </div>

    <!-- Details Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Personnel Module -->
        <section class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/30 border border-slate-50 overflow-hidden">
            <div class="px-10 py-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Staff Members</h2>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Authorized studio staff</p>
                </div>
                <div class="h-32 w-32 bg-indigo-50/50 rounded-full blur-3xl absolute -right-10 -top-10"></div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/20">
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Name</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Access</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($studio->users as $u)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-9 w-9 rounded-xl bg-slate-100 flex items-center justify-center text-xs font-black text-slate-500 border border-slate-200 group-hover:bg-white transition-colors">
                                            {{ substr($u->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-900 leading-none mb-1">{{ $u->name }}</div>
                                            <div class="text-[10px] text-slate-400 font-medium">{{ $u->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest {{ $u->role === 'admin' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-slate-50 text-slate-600 border border-slate-100' }}">
                                        {{ $u->role }} Access
                                    </span>
                                </td>
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full {{ $u->is_active ? 'bg-emerald-500 shadow-lg shadow-emerald-200' : 'bg-slate-300' }}"></span>
                                        <span class="text-[11px] font-bold text-slate-500">{{ $u->is_active ? 'Linked' : 'Offline' }}</span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Portfolio Segment -->
        <section class="bg-white rounded-[2.5rem] shadow-2xl shadow-purple-100/30 border border-slate-50 overflow-hidden">
            <div class="px-10 py-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Recent Clients</h2>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Latest clients for this studio</p>
                </div>
                <div class="h-32 w-32 bg-purple-50/50 rounded-full blur-3xl absolute -right-10 -top-10"></div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/20">
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Client</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($studio->clients->take(8) as $c)
                            <tr class="group hover:bg-slate-50/40 transition-colors">
                                <td class="px-10 py-6">
                                    <div class="text-sm font-bold text-slate-900 mb-1 leading-none group-hover:text-purple-600 transition-colors">{{ $c->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $c->phone }}</div>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ str_replace('_', ' ', $c->order_status) }}
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <div class="text-[11px] font-bold text-slate-500">{{ $c->created_at->format('d M') }}</div>
                                    <div class="text-[9px] text-slate-300 font-medium uppercase tracking-tighter">{{ $c->created_at->diffForHumans() }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
