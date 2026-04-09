@extends('layouts.platform')
@section('title', 'Analytics Overview')
@section('content')
<div class="space-y-12 pb-20">
    <!-- Hero Status Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Revenue Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-[2rem] blur opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="h-20 w-20" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM5.884 6.68a1 1 0 10-1.415-1.414l.707-.707a1 1 0 001.415 1.414l-.707.707zm1.18 8.082a1 1 0 001.415 1.414l.707-.707a1 1 0 10-1.415-1.414l-.707.707zm1.18 8.082a1 1 0 001.415 1.414l.707-.707a1 1 0 10-1.415-1.414l-.707.707zm1.18 8.082a1 1 0 001.415 1.414l.707-.707a1 1 0 10-1.415-1.414l-.707.707z"></path></svg>
                </div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-inner">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Platform Revenue</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl font-outfit font-black text-slate-900 tracking-tighter">₦{{ number_format($data['total_revenue'], 2) }}</span>
                    <div class="flex items-center gap-2 mt-3 font-bold text-[11px] text-emerald-600 bg-emerald-50 w-max px-3 py-1 rounded-full">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span>+12.5% vs Last Month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Studios Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-[2rem] blur opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 shadow-inner">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Studios Fleet</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl font-outfit font-black text-slate-900 tracking-tighter">{{ $data['active_studios'] }}<span class="text-slate-200 text-2xl font-light mx-1">/</span>{{ $data['total_studios'] }}</span>
                    <div class="flex items-center gap-2 mt-3 font-bold text-[11px] text-indigo-600 bg-indigo-50 w-max px-3 py-1 rounded-full">
                        <span>{{ round(($data['active_studios']/$data['total_studios'])*100, 1) }}% Active Utilization</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Photos Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-[2rem] blur opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 shadow-inner">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Photos</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl font-outfit font-black text-slate-900 tracking-tighter">{{ number_format($data['total_photos']) }}</span>
                    <div class="flex items-center gap-2 mt-3 font-bold text-[11px] text-purple-600 bg-purple-50 w-max px-3 py-1 rounded-full">
                        <span>All photos uploaded on platform</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clients Card -->
        <div class="relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-500 rounded-[2rem] blur opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <div class="relative bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 shadow-inner">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Platform Users</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-4xl font-outfit font-black text-slate-900 tracking-tighter">{{ number_format($data['total_clients']) }}</span>
                    <div class="flex items-center gap-2 mt-3 font-bold text-[11px] text-amber-600 bg-amber-50 w-max px-3 py-1 rounded-full">
                        <span>Unique Clients Registered</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Visual Data -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Chart Column -->
        <div class="lg:col-span-2 space-y-10">
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-indigo-100/50 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-10">
                    <div class="h-32 w-32 bg-indigo-50/50 rounded-full blur-3xl group-hover:bg-indigo-100/50 transition-colors"></div>
                </div>
                <div class="flex items-center justify-between mb-10 relative">
                    <div>
                        <h2 class="text-2xl font-outfit font-extrabold text-slate-800 tracking-tight">Studios Growth</h2>
                        <p class="text-sm text-slate-400 font-medium mt-1">Monthly new studio signups</p>
                    </div>
                </div>
                <div class="relative min-h-[400px]">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Health & Mix Column -->
        <div class="space-y-10">
            <!-- Plan Mix -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-purple-100/50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center">
                    <span class="h-1.5 w-1.5 rounded-full bg-purple-500 mr-2"></span> Plan Distribution
                </h3>
                <div class="space-y-8">
                    <div class="group">
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <div class="text-sm font-bold text-slate-800 group-hover:text-purple-600 transition-colors">Pro Studios</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Premium accounts</div>
                            </div>
                            <span class="text-2xl font-outfit font-black text-slate-900">{{ $data['pro_studios'] }}</span>
                        </div>
                        <div class="h-3 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100 shadow-inner">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full shadow-lg shadow-purple-200" style="width: {{ $data['total_studios'] > 0 ? ($data['pro_studios']/$data['total_studios'])*100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-end mb-3">
                            <div>
                                <div class="text-sm font-bold text-slate-800 group-hover:text-slate-600 transition-colors">Free Studios</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Basic accounts</div>
                            </div>
                            <span class="text-2xl font-outfit font-black text-slate-900">{{ $data['free_studios'] }}</span>
                        </div>
                        <div class="h-3 w-full bg-slate-50 rounded-full overflow-hidden border border-slate-100 shadow-inner">
                            <div class="h-full bg-slate-200 rounded-full" style="width: {{ $data['total_studios'] > 0 ? ($data['free_studios']/$data['total_studios'])*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-10 p-5 bg-slate-50 rounded-2xl border border-slate-100 flex items-center gap-4">
                    <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center text-xl shadow-sm border border-slate-100">🚀</div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-500 uppercase tracking-tight">Upgrade Potential</p>
                        <p class="text-sm font-bold text-slate-800">{{ $data['free_studios'] }} target accounts</p>
                    </div>
                </div>
            </div>

            <!-- Invoices -->
            <div class="bg-indigo-950 p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-900/40 text-white relative overflow-hidden">
                <div class="absolute -top-10 -right-10 h-40 w-40 bg-white/5 rounded-full blur-2xl"></div>
                <h3 class="text-xs font-black text-indigo-300 uppercase tracking-[0.2em] mb-10 relative">Financial Health</h3>
                
                <div class="grid grid-cols-2 gap-6 relative">
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Settled</p>
                        <p class="text-3xl font-outfit font-black text-white">{{ $data['paid_invoices'] }}</p>
                        <div class="h-1.5 w-full bg-white/10 rounded-full">
                            <div class="h-full bg-emerald-400 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">Pending</p>
                        <p class="text-3xl font-outfit font-black text-white">{{ $data['unpaid_invoices'] }}</p>
                        <div class="h-1.5 w-full bg-white/10 rounded-full">
                            <div class="h-full bg-orange-400 rounded-full" style="width: 25%"></div>
                        </div>
                    </div>
                </div>

                <button class="w-full mt-10 py-4 bg-white/10 hover:bg-white/20 border border-white/10 rounded-2xl text-xs font-bold transition-all backdrop-blur-sm">
                    View Detailed Ledger
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('growthChart').getContext('2d');
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const counts = new Array(12).fill(0);
    
    @foreach($data['studios_per_month'] as $item)
        counts[parseInt('{{ $item->month }}') - 1] = {{ $item->count }};
    @endforeach

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Onboarded Studios',
                data: counts,
                fill: true,
                backgroundColor: gradient,
                borderColor: '#6366f1',
                borderWidth: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#6366f1',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e1b4b',
                    padding: 12,
                    titleFont: { family: 'Outfit', size: 14, weight: 'bold' },
                    bodyFont: { family: 'Instrument Sans', size: 13 },
                    displayColors: false
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                    ticks: { font: { weight: 'bold', size: 11 }, color: '#94a3b8' }
                },
                x: { 
                    grid: { display: false },
                    ticks: { font: { weight: 'bold', size: 11 }, color: '#94a3b8' }
                }
            }
        }
    });
</script>
@endsection
