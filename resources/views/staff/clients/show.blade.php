@extends('layouts.app')
@section('title', 'Client Profile')
@section('content')
<div class="space-y-10 pb-20">
    <!-- Profile Header -->
    <div class="bg-white rounded-[3rem] p-8 lg:p-12 border border-slate-50 shadow-2xl shadow-indigo-100/50 relative overflow-hidden">
        <div class="absolute right-0 top-0 h-64 w-64 bg-indigo-50 rounded-full blur-[100px] -mr-32 -mt-32 opacity-50"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div class="flex items-center gap-6">
                <div class="h-20 w-20 rounded-3xl bg-indigo-600 flex items-center justify-center text-white text-3xl font-black shadow-xl shadow-indigo-200">
                    {{ substr($client->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-outfit font-black text-slate-800 tracking-tight">{{ $client->name }}</h1>
                    <div class="flex flex-wrap items-center gap-4 mt-2">
                        <span class="flex items-center text-xs font-bold text-slate-400">
                            <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ $client->email ?? 'No email' }}
                        </span>
                        <span class="flex items-center text-xs font-bold text-slate-400">
                            <svg class="h-3.5 w-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            {{ $client->phone ?? 'No phone' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('staff.photos.create', $client->id) }}" class="h-12 px-6 bg-slate-900 text-white rounded-2xl flex items-center justify-center text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all transform hover:-translate-y-1 active:scale-95 shadow-lg shadow-slate-200">Upload Photos</a>
                <a href="{{ route('staff.invoice.create', $client->id) }}" class="h-12 px-6 bg-indigo-600 text-white rounded-2xl flex items-center justify-center text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 transition-all transform hover:-translate-y-1 active:scale-95 shadow-lg shadow-indigo-100">Create Invoice</a>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Sidebar Controls -->
        <div class="space-y-10">
            <!-- Order Status Card -->
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-50 shadow-2xl shadow-indigo-100/30">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Order Progress</h3>
                <form action="{{ route('staff.clients.order-status', $client->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="relative group">
                        <select name="order_status" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all appearance-none cursor-pointer">
                            <option value="pending" {{ $client->order_status === 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                            <option value="editing" {{ $client->order_status === 'editing' ? 'selected' : '' }}>🎨 Editing</option>
                            <option value="ready" {{ $client->order_status === 'ready' ? 'selected' : '' }}>✅ Ready</option>
                            <option value="delivered" {{ $client->order_status === 'delivered' ? 'selected' : '' }}>📦 Delivered</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-slate-100 hover:bg-indigo-600 hover:text-white text-indigo-600 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all">Update Status</button>
                </form>
            </div>

            <!-- Financials Card -->
            <div class="bg-indigo-950 rounded-[2.5rem] p-8 text-white shadow-2xl shadow-indigo-900/40 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 h-32 w-32 bg-indigo-500 rounded-full blur-[60px] opacity-20"></div>
                
                <h3 class="text-[10px] font-black text-indigo-300/40 uppercase tracking-widest mb-6 relative z-10">Account Balance</h3>
                
                <div class="space-y-6 relative z-10">
                    <div>
                        <p class="text-[10px] font-bold text-indigo-300/60 uppercase tracking-widest mb-1">Remaining Due</p>
                        <p class="text-4xl font-outfit font-black tracking-tighter text-white">₦{{ number_format($client->price - $client->deposit, 2) }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/5">
                        <div>
                            <p class="text-[9px] font-bold text-indigo-300/40 uppercase mb-1">Deposit</p>
                            <p class="text-sm font-bold">₦{{ number_format($client->deposit, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-indigo-300/40 uppercase mb-1">Total</p>
                            <p class="text-sm font-bold">₦{{ number_format($client->price, 2) }}</p>
                        </div>
                    </div>

                    <form action="{{ route('staff.clients.deposit', $client->id) }}" method="POST" class="pt-4 flex gap-2">
                        @csrf
                        <input type="number" name="deposit" step="0.01" value="{{ $client->deposit }}" 
                            class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-2 text-sm font-bold text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        <button type="submit" class="bg-indigo-500 hover:bg-white hover:text-indigo-900 p-2 rounded-xl transition-all">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Gallery Link Generator -->
            <div class="bg-white rounded-[2.5rem] p-8 border border-slate-50 shadow-2xl shadow-indigo-100/30">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Client Access Link</h3>
                    @php
                        $gallery = \App\Models\Gallery::where('client_id', $client->id)->first();
                        $publicUrl = $gallery && $gallery->token ? route('public.gallery', $gallery->token) : null;
                    @endphp
                    @if($publicUrl)
                        <span class="flex items-center text-[10px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Live</span>
                    @endif
                </div>

                @if($publicUrl)
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 flex items-center bg-slate-50 border border-slate-100 rounded-2xl px-6 py-4 group">
                            <input type="text" readonly value="{{ $publicUrl }}" class="bg-transparent border-none outline-none flex-1 text-sm font-bold text-slate-600 font-mono">
                            <button onclick="navigator.clipboard.writeText('{{ $publicUrl }}'); alert('Link copied!');" class="ml-4 text-indigo-600 hover:text-slate-900 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ $publicUrl }}" target="_blank" class="h-14 w-14 bg-amber-500 hover:bg-amber-600 text-white rounded-2xl flex items-center justify-center transition-all shadow-lg shadow-amber-100">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <form action="{{ route('staff.gallery.generate', $client->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="h-14 w-14 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl flex items-center justify-center transition-all">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <form action="{{ route('staff.gallery.generate', $client->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-50 hover:bg-indigo-600 hover:text-white text-indigo-600 py-10 rounded-[2rem] border-2 border-dashed border-indigo-100 flex flex-col items-center justify-center transition-all group">
                            <span class="text-3xl mb-4 group-hover:scale-110 transition-transform">✨</span>
                            <span class="text-xs font-black uppercase tracking-widest">Initialize Public Gallery</span>
                        </button>
                    </form>
                @endif
            </div>

            <!-- Invoices Section -->
            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100/30 border border-slate-100 overflow-hidden">
                <div class="px-10 py-6 border-b border-slate-50 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Invoice Management</h3>
                </div>
                <div>
                    @if($client->invoices->count())
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-slate-50">
                                @foreach($client->invoices as $invoice)
                                    <tr class="group">
                                        <td class="px-10 py-6">
                                            <div class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">₦{{ number_format($invoice->amount, 2) }}</div>
                                            <div class="text-[10px] text-slate-400 font-medium uppercase mt-0.5 tracking-wider">{{ $invoice->created_at->format('M d, Y') }}</div>
                                        </td>
                                        <td class="px-10 py-6">
                                            @if($invoice->status === 'paid')
                                                <span class="inline-block px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-lg bg-emerald-50 text-emerald-600 border border-emerald-100">Paid</span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-lg bg-rose-50 text-rose-600 border border-rose-100">Unpaid</span>
                                            @endif
                                        </td>
                                        <td class="px-10 py-6 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('staff.invoice.toggle-status', [$client->id, $invoice->id]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="h-10 px-4 bg-slate-900 hover:bg-indigo-600 text-white rounded-xl text-[9px] font-black uppercase tracking-widest transition-all shadow-lg shadow-slate-200">
                                                        {{ $invoice->status === 'paid' ? 'Mark Unpaid' : 'Mark Paid' }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('staff.invoice.show', [$client->id, $invoice->id]) }}" class="h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="py-12 text-center">
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">No active invoices</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Visual Assets Grid -->
            <div class="bg-white rounded-[2.5rem] p-10 border border-slate-50 shadow-2xl shadow-indigo-100/30">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest font-outfit">Visual Assets</h3>
                    <span class="text-[10px] font-black text-indigo-600">{{ $client->photos->count() }} Images</span>
                </div>
                
                @if($client->photos->count())
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($client->photos as $photo)
                            <div class="group relative aspect-square rounded-[2rem] overflow-hidden bg-slate-100 shadow-xl shadow-slate-200/50">
                                <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-indigo-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-end p-6">
                                    <span class="text-[8px] font-black text-white/70 uppercase tracking-widest">{{ $photo->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-20 flex flex-col items-center bg-slate-50/50 rounded-[2rem] border border-dashed border-slate-100">
                        <div class="text-4xl mb-4 grayscale opacity-30">🖼️</div>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">No assets uploaded yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
