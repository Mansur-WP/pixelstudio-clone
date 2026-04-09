@extends('layouts.app')
@section('title', 'Payments History')
@section('content')
<div class="space-y-12 pb-20">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">Payments & Invoices</h1>
            <p class="text-slate-400 font-medium mt-1">View and manage all studio payments</p>
        </div>
        <div class="h-14 w-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100 italic font-black">
            $
        </div>
    </div>

    @if(session('success'))
        <div class="px-6 py-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 animate-in fade-in slide-in-from-top-4">
            <div class="h-10 w-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 font-black">✓</div>
            <span class="font-bold text-emerald-800 uppercase tracking-wide text-xs">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Payment Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Paid Invoices</p>
            <p class="text-3xl font-outfit font-black text-slate-900 leading-none">{{ $invoices->where('status', 'paid')->count() }}</p>
        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Unpaid Total</p>
            <p class="text-3xl font-outfit font-black text-rose-600 leading-none">₦{{ number_format($invoices->where('status', 'unpaid')->sum('amount'), 2) }}</p>
        </div>
        <div class="bg-indigo-950 p-8 rounded-[2rem] shadow-2xl shadow-indigo-900/20 text-white group">
            <p class="text-[10px] font-black text-indigo-300 uppercase tracking-widest mb-2">Total Gross</p>
            <p class="text-3xl font-outfit font-black text-white leading-none">₦{{ number_format($invoices->sum('amount'), 2) }}</p>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Client</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Amount</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Due Date</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Created Date</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($invoices as $invoice)
                        <tr class="group hover:bg-slate-50/60 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 bg-slate-100 rounded-lg flex items-center justify-center font-black text-slate-400 text-xs border border-slate-200">
                                        {{ substr($invoice->client->name ?? 'C', 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $invoice->client->name ?? 'Anonymous Client' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-black text-slate-900 tracking-tight">₦{{ number_format($invoice->amount, 2) }}</td>
                            <td class="px-8 py-6">
                                @if($invoice->status === 'paid')
                                    <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-emerald-100">
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-rose-100">
                                        Unpaid
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-slate-500 italic">
                                {{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') : 'Immediate' }}
                            </td>
                            <td class="px-8 py-6 text-sm font-bold text-slate-400">{{ $invoice->created_at->format('M d, Y') }}</td>
                            <td class="px-8 py-6 text-right">
                                @if($invoice->status === 'unpaid')
                                    <form method="POST" action="{{ route('admin.invoices.mark-paid', $invoice->id) }}">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-100 active:scale-95">
                                            Mark Paid
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] font-bold text-slate-300 uppercase italic tracking-tighter">Verified</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center opacity-30">
                                    <span class="text-4xl mb-4">💸</span>
                                    <p class="text-sm font-black uppercase tracking-[0.2em]">No financial data records</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($invoices->hasPages())
            <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
