@extends('layouts.app')
@section('title', 'Staff Management')
@section('content')
<div class="space-y-12 pb-20">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">Staff Members</h1>
            <p class="text-slate-400 font-medium mt-1">Manage and authorized studio staff members</p>
        </div>
    </div>

    @if(session('success'))
        <div class="px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4">
            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 font-black">✓</div>
            <span class="font-bold text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Add Staff Card -->
    <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 relative overflow-hidden group">
        <div class="absolute -top-10 -right-10 h-32 w-32 bg-indigo-50 rounded-full blur-3xl group-hover:bg-indigo-100 transition-colors"></div>
        <h2 class="text-xs font-black text-indigo-400 uppercase tracking-[0.2em] mb-8 relative">Add New Staff Member</h2>
        
        <form method="POST" action="{{ route('admin.staff.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end relative">
            @csrf
            <div class="md:col-span-1">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                <input type="text" name="name" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700" placeholder="Name" required>
            </div>
            <div class="md:col-span-1">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                <input type="email" name="email" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700" placeholder="Email" required>
            </div>
            <div class="md:col-span-1">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                <input type="password" name="password" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-700" placeholder="Password" required>
            </div>
            <div class="md:col-span-1">
                <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-lg shadow-indigo-200 transition-all active:scale-95">
                    Add Staff
                </button>
            </div>
        </form>
    </div>

    <!-- Staff Fleet Table -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Name</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Added Date</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($staff as $user)
                        <tr class="group hover:bg-slate-50/60 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-slate-100 to-indigo-50 flex items-center justify-center font-black text-indigo-400 text-sm border border-slate-200 shadow-sm transition-colors group-hover:bg-white">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-slate-400">{{ $user->email }}</td>
                            <td class="px-8 py-6">
                                @if($user->is_active)
                                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-emerald-100">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-rose-100">
                                        Revoked
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-slate-700">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all">
                                    <form method="POST" action="{{ route('admin.staff.status', $user->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="h-9 w-9 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Toggle Access">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.staff.destroy', $user->id) }}" onsubmit="return confirm('Delete this staff member? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-9 w-9 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Delete">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center opacity-40 font-bold uppercase tracking-[0.2em] text-xs">No active personnel detected</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
