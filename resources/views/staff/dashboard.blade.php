@extends('layouts.app')
@section('title', 'Staff Dashboard')
@section('content')
<div class="space-y-12 pb-20">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-outfit font-black text-slate-800 tracking-tighter">Staff <span class="text-indigo-600">Command</span></h1>
            <p class="text-slate-400 font-medium mt-1">Ready for today's photography sessions?</p>
        </div>
        <a href="{{ route('staff.clients.create') }}" class="inline-flex items-center px-8 py-4 bg-indigo-600 hover:bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95">
            <svg class="h-4 w-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Add New Client
        </a>
    </div>

    <!-- Stats Matrix -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-2xl shadow-indigo-100/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Clients</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['total_clients'] }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Active users</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-2xl shadow-indigo-100/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Photos</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['total_photos'] }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Gallery assets</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-2xl shadow-indigo-100/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Invoices</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $stats['total_invoices'] }}</span>
                    <span class="text-xs font-bold text-slate-400 mb-1">Created records</span>
                </div>
            </div>
        </article>

        <article class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-2xl shadow-rose-100/50 flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
            <div class="h-12 w-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600 mb-6 group-hover:bg-rose-600 group-hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mb-1">Unpaid Balance</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-outfit font-black text-rose-600 leading-none">{{ $stats['unpaid_invoices'] }}</span>
                    <span class="text-xs font-bold text-rose-400 mb-1">Pending payments</span>
                </div>
            </div>
        </article>
    </div>

    <!-- Recent Clients Table -->
    <section class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/30 border border-slate-100 overflow-hidden">
        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
            <div>
                <h2 class="text-xl font-outfit font-black text-slate-800 tracking-tight">Recent Clients</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Newly onboarded clients</p>
            </div>
            <a href="{{ route('staff.clients') }}" class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-800 transition-colors">View All &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            @if($recent_clients->count())
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/20">
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Client Name</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Address</th>
                            <th class="px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($recent_clients as $client)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-10 py-6">
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $client->name }}</span>
                                </td>
                                <td class="px-10 py-6">
                                    <span class="text-sm text-slate-500 font-medium">{{ $client->email }}</span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <a href="/staff/clients/{{ $client->id }}" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all text-xs font-black uppercase tracking-widest shadow-sm">View Profile</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="py-20 flex flex-col items-center">
                    <div class="h-20 w-20 bg-slate-50 rounded-3xl flex items-center justify-center text-4xl mb-4 grayscale">👥</div>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">No clients found</p>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
