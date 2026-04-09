<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Studio;
use App\Models\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function create($id) {
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        return view('staff.clients.invoice', compact('client'));
    }
    public function store(Request $request, $id) {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $invoice = Invoice::create([
            'studio_id' => auth()->user()->studio_id,
            'client_id' => $id,
            'amount' => $request->amount,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'unpaid',
        ]);
        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'invoice_created',
            'description' => "Created invoice of {$request->amount} for client: {$client->name}",
        ]);
        return redirect()->route('staff.clients.show', $id)->with('success', 'Invoice created successfully!');
    }

    public function show($clientId, $invoiceId) {
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($clientId);
        $invoice = Invoice::where('studio_id', auth()->user()->studio_id)->findOrFail($invoiceId);
        $studio = Studio::find(auth()->user()->studio_id);
        return view('staff.clients.invoice-detail', compact('client', 'invoice', 'studio'));
    }

    public function downloadPdf($clientId, $invoiceId) {
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($clientId);
        $invoice = Invoice::where('studio_id', auth()->user()->studio_id)->findOrFail($invoiceId);
        $studio = Studio::find(auth()->user()->studio_id);
        
        $pdf = Pdf::loadView('staff.clients.invoice-detail', compact('client', 'invoice', 'studio'));
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }

    public function toggleStatus(Request $request, $clientId, $invoiceId) {
        $invoice = Invoice::where('studio_id', auth()->user()->studio_id)->findOrFail($invoiceId);
        $newStatus = $invoice->status === 'paid' ? 'unpaid' : 'paid';
        $invoice->update(['status' => $newStatus]);

        if ($newStatus === 'paid') {
            Payment::create([
                'studio_id' => auth()->user()->studio_id,
                'invoice_id' => $invoice->id,
                'amount' => $invoice->amount,
                'method' => 'manual',
                'paid_at' => now(),
            ]);
        } else {
            // Remove associated payment if marking as unpaid
            Payment::where('invoice_id', $invoice->id)->delete();
        }

        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'invoice_status_updated',
            'description' => "Changed invoice #{$invoice->id} status to {$newStatus} for client ID: {$clientId}",
        ]);

        return back()->with('success', "Invoice marked as {$newStatus}!");
    }
}
