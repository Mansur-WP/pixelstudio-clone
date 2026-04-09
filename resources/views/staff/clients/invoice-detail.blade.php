@extends('layouts.app')

@section('title', 'Invoice ' . $invoice->invoice_number)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Action Buttons (Hidden on Print) -->
    <div class="flex justify-between items-center mb-6 print:hidden">
        <a href="{{ route('staff.clients.show', $client->id) }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Client
        </a>
        <div class="flex gap-3">
            @if($invoice->status !== 'paid' && auth()->user()->role === 'admin')
                <form action="{{ route('admin.invoices.mark-paid', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this invoice as paid?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                        Mark as Paid
                    </button>
                </form>
            @endif
            <a href="{{ route('staff.invoice.download', [$client->id, $invoice->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                Download PDF
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print Invoice
            </button>
        </div>
    </div>

    <!-- Invoice Card -->
    <div class="bg-white shadow-sm border rounded-xl overflow-hidden print:shadow-none print:border-none">
        <div class="p-8 sm:p-12">
            <!-- Header -->
            <div class="flex justify-between items-start mb-12">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1 tracking-tight">INVOICE</h1>
                    <p class="text-gray-500 font-medium">{{ $invoice->invoice_number }}</p>
                    <p class="text-gray-500 text-sm mt-1">Date: {{ $invoice->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-right">
                    @if($studio->logo_path)
                        <img src="{{ asset('storage/' . $studio->logo_path) }}" alt="{{ $studio->name }}" class="h-16 w-auto ml-auto mb-2">
                    @endif
                    <h2 class="text-xl font-bold text-gray-900">{{ $studio->name }}</h2>
                    <p class="text-gray-500 text-sm">Studio Management System</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-12 mb-12">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Bill To</h3>
                    <p class="text-lg font-bold text-gray-900">{{ $client->client_name }}</p>
                    <p class="text-gray-600 mt-1">{{ $client->phone }}</p>
                    @if($client->email)
                        <p class="text-gray-600">{{ $client->email }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Payment Status</h3>
                    <div class="mt-1">
                        @if($invoice->status === 'paid')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                PAID
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                UNPAID
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="mb-12">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 font-bold text-gray-900 uppercase text-xs tracking-wider">Description</th>
                            <th class="py-4 text-right font-bold text-gray-900 uppercase text-xs tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="py-6 text-gray-700">
                                <p class="font-medium text-gray-900">{{ $invoice->description ?? 'Studio Services' }}</p>
                                <p class="text-xs text-gray-500 mt-1">Photo Format: {{ $client->photo_format }} | Quantity: {{ $client->quantity }}</p>
                            </td>
                            <td class="py-6 text-right text-lg font-medium text-gray-900">₦{{ number_format($invoice->amount, 2) }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="py-4 text-right text-gray-500 font-medium">Agreed Price</td>
                            <td class="py-4 text-right text-gray-900 font-bold">₦{{ number_format($client->price, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-4 text-right text-gray-500 font-medium">Deposit Paid</td>
                            <td class="py-4 text-right text-gray-900 font-bold">₦{{ number_format($client->deposit, 2) }}</td>
                        </tr>
                        @php $balance = $client->price - $client->deposit; @endphp
                        <tr class="border-t-2 border-gray-900">
                            <td class="py-6 text-right text-gray-900 font-black uppercase tracking-wider">Balance Due</td>
                            <td class="py-6 text-right text-2xl font-black {{ $balance > 0 ? 'text-red-600' : 'text-gray-900' }}">
                                ₦{{ number_format($balance, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Footer -->
            <div class="border-t pt-8 text-center text-gray-400 text-xs">
                <p>Thank you for choosing {{ $studio->name }} for your creative needs.</p>
                <p class="mt-1">This is a system-generated invoice.</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    body { background: white !important; }
    .print\:hidden { display: none !important; }
    .print\:shadow-none { box-shadow: none !important; }
    .print\:border-none { border: none !important; }
    main { padding: 0 !important; }
    body, html { h-auto !important; overflow: visible !important; }
    aside { display: none !important; }
    header { display: none !important; }
}
</style>
@endsection
