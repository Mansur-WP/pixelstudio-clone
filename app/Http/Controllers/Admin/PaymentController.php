<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\ActivityLog;

class PaymentController extends Controller
{
    public function index() {
        $studioId = auth()->user()->studio_id;
        $invoices = Invoice::where('studio_id', $studioId)
            ->with('client')
            ->latest()
            ->paginate(10);
        return view('admin.payments.index', compact('invoices'));
    }

    public function markPaid($id) {
        $invoice = Invoice::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $invoice->update(['status' => 'paid']);
        Payment::create([
            'studio_id' => auth()->user()->studio_id,
            'invoice_id' => $invoice->id,
            'amount' => $invoice->amount,
            'method' => 'manual',
            'paid_at' => now(),
        ]);
        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'invoice_paid',
            'description' => "Marked invoice #{$invoice->id} as paid for client: {$invoice->client->name}",
        ]);
        return back()->with('success', 'Invoice marked as paid!');
    }
}
