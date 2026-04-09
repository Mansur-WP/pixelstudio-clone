@extends('layouts.platform')
@section('title', 'Manage Upgrades')
@section('content')
<div class="space-y-10 pb-20">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">Support Tickets</h1>
            <p class="text-slate-400 font-medium mt-1">Manage studio plan upgrade requests</p>
        </div>
        <div class="h-14 w-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
    </div>

    @if(session('success'))
        <div class="px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4">
            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 font-black">✓</div>
            <span class="font-bold text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Studio</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Requested Plan</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($requests as $request)
                        <tr class="group hover:bg-slate-50/60 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-xl bg-slate-100 flex items-center justify-center font-black text-slate-500 border border-slate-200 shadow-sm">
                                        {{ substr($request->studio->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $request->studio->name ?? 'Unknown Studio' }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 italic">Base Tier: {{ ucfirst($request->studio->plan ?? 'free') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-4 py-1.5 bg-indigo-900 text-white text-[10px] font-black uppercase tracking-[0.1em] rounded-xl shadow-lg shadow-indigo-200">
                                    {{ $request->plan_requested }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                @if($request->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                                        <span class="text-[11px] font-black text-amber-600 uppercase tracking-widest">Pending</span>
                                    </div>
                                @elseif($request->status === 'confirmed')
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                        <span class="text-[11px] font-black text-emerald-600 uppercase tracking-widest">Approved</span>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                                        <span class="text-[11px] font-black text-rose-600 uppercase tracking-widest">Rejected</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700">{{ $request->created_at->diffForHumans() }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">{{ $request->created_at->format('M d, H:i') }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($request->status === 'pending')
                                    <div class="flex justify-end gap-3 translate-x-2 opacity-0 group-hover:opacity-100 transition-all group-hover:translate-x-0">
                                        <form action="{{ route('platform.upgrades.confirm', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="h-10 px-5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-200 active:scale-95">
                                                Confirm
                                            </button>
                                        </form>
                                        <form action="{{ route('platform.upgrades.reject', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="h-10 px-5 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-rose-200 active:scale-95">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-[11px] font-bold text-slate-300 italic">No Actions Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-slate-50 rounded-3xl flex items-center justify-center text-4xl mb-6 shadow-sm border border-slate-100">📥</div>
                                    <h3 class="text-xl font-outfit font-black text-slate-800">Clear Transmission</h3>
                                    <p class="text-slate-400 font-medium mt-2">All studio escalation requests have been processed.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($requests->hasPages())
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
