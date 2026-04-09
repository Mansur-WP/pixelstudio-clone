@extends('layouts.platform')
@section('title', 'Manage Studios')
@section('content')
<div class="space-y-10 pb-20">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">Studios <span class="text-indigo-600">Inventory</span></h1>
            <p class="text-slate-400 font-medium mt-1">Management center for all active photography workspaces</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="relative group hidden md:block w-72">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search signals..." class="block w-full pl-10 pr-4 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium text-slate-600 text-sm">
            </div>
            <a href="{{ route('platform.studios.create') }}" class="h-14 px-8 bg-indigo-600 hover:bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all transform hover:-translate-y-1 active:scale-95 shadow-xl shadow-indigo-100 flex items-center justify-center">
                <svg class="h-4 w-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Initialize New Studio
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-300">
            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <span class="font-bold text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Studio Name</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Plan & Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Stats</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Created</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($studios as $studio)
                        <tr class="group hover:bg-slate-50/80 transition-all duration-200">
                            <td class="px-8 py-6 text-sm">
                                <div class="flex items-center gap-4">
                                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-50 to-white border border-indigo-100 flex items-center justify-center text-indigo-600 font-extrabold text-xl shadow-sm relative overflow-hidden">
                                        {{ substr($studio->name, 0, 1) }}
                                        <div class="absolute inset-0 bg-indigo-500/5 group-hover:bg-indigo-500/0 transition-colors"></div>
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $studio->name }}</div>
                                        <div class="text-[11px] text-slate-400 font-mono mt-0.5">{{ $studio->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        @if($studio->plan === 'pro')
                                            <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 text-[10px] font-black uppercase tracking-widest rounded-lg border border-purple-200">
                                                <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.946-2.567 9.29-6.433 11.771l-.567.364-.567-.364A11.946 11.946 0 013.567 7.001c0-.68.056-1.35.166-2.001zM10 14a4 4 0 100-8 4 4 0 000 8z" clip-rule="evenodd"></path></svg>
                                                Pro Plan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-lg border border-slate-200">
                                                Free Plan
                                            </span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($studio->is_active)
                                            <span class="flex items-center text-[11px] font-bold text-emerald-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="flex items-center text-[11px] font-bold text-slate-400">
                                                <span class="h-1.5 w-1.5 rounded-full bg-slate-300 mr-2"></span>
                                                Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-6">
                                    <div class="flex flex-col">
                                        <span class="text-lg font-outfit font-black text-slate-900 leading-none">{{ $studio->clients_count }}</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter mt-1">Clients</span>
                                    </div>
                                    <div class="h-8 w-px bg-slate-100"></div>
                                    <div class="flex flex-col">
                                        <span class="text-lg font-outfit font-black text-slate-900 leading-none">{{ $studio->users_count }}</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter mt-1">Staff</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700">{{ $studio->created_at->format('M d, Y') }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">{{ $studio->created_at->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('platform.studios.show', $studio->id) }}" class="flex items-center justify-center h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm" title="View Details">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>

                                    <form action="{{ route('platform.studios.toggle-plan', $studio->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="flex items-center justify-center h-10 w-10 bg-purple-50 text-purple-600 hover:bg-purple-600 rounded-xl hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm" title="Switch Plan">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('platform.studios.toggle', $studio->id) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="flex items-center justify-center h-10 w-10 {{ $studio->is_active ? 'bg-orange-50 text-orange-600 hover:bg-orange-600' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600' }} rounded-xl hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm" title="{{ $studio->is_active ? 'Deactivate' : 'Activate' }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('platform.studios.destroy', $studio->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this studio? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center h-10 w-10 bg-rose-50 text-rose-600 hover:bg-rose-600 rounded-xl hover:text-white transition-all transform hover:scale-110 active:scale-95 shadow-sm">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-slate-50/50 backdrop-blur-sm -z-10"></div>
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="h-24 w-24 bg-white rounded-3xl shadow-xl flex items-center justify-center text-4xl mb-6 transform -rotate-6 border border-slate-100">📡</div>
                                    <h3 class="text-2xl font-outfit font-extrabold text-slate-800">No signals detected</h3>
                                    <p class="text-slate-400 font-medium mt-2 max-w-sm">The platform is currently optimized but has no onboarded studios to monitor.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($studios->hasPages())
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                {{ $studios->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
