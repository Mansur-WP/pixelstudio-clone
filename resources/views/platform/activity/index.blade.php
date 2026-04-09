@extends('layouts.platform')
@section('title', 'Activity Logs')
@section('content')
<div class="space-y-10 pb-20">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">System Logs</h1>
            <p class="text-slate-400 font-medium mt-1">History of all platform management actions</p>
        </div>
        <div class="hidden sm:flex items-center gap-3">
            <span class="flex h-3 w-3 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
            </span>
            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Live Monitoring Active</span>
        </div>
    </div>

    <!-- Activity Stream -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Operator</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Action</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Description</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">User</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($activities as $activity)
                        <tr class="group hover:bg-slate-50/80 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-slate-900 flex items-center justify-center text-[10px] font-black text-white shadow-lg">
                                        {{ substr($activity->studio?->name ?? 'SYS', 0, 3) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-800">{{ $activity->studio?->name ?? 'Platform Core' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-widest rounded-lg border border-indigo-100">
                                    {{ str_replace('_', ' ', $activity->action) }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm text-slate-500 font-medium leading-relaxed max-w-md">
                                    {{ $activity->description }}
                                </p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-indigo-100 to-purple-100 flex items-center justify-center text-[11px] font-extrabold text-indigo-600 border border-white shadow-sm">
                                        {{ substr($activity->user?->name ?? 'S', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700">{{ $activity->user?->name ?? 'System' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700">{{ $activity->created_at->diffForHumans() }}</span>
                                    <span class="text-[10px] text-slate-400 font-medium">{{ $activity->created_at->format('H:i:s T') }}</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center italic text-slate-400 font-medium">
                                The audit feed is currently quiet. Check back as operations resume.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($activities->hasPages())
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
