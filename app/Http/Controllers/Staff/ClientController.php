<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\Invoice;
use App\Models\ActivityLog;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    // index — list all clients for this studio
    public function index(Request $request) {
        $query = Client::where('studio_id', auth()->user()->studio_id);
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('client_name', 'like', '%'.$request->search.'%')
                  ->orWhere('phone', 'like', '%'.$request->search.'%');
            });
        }
        $clients = $query->latest()->paginate(10);
        return view('staff.clients.index', compact('clients'));
    }

    // create — show form
    public function create() {
        return view('staff.clients.create');
    }

    // store — save new client
    public function store(Request $request) {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'photo_format' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
        ]);
        $client = Client::create([
            'studio_id' => auth()->user()->studio_id,
            'client_name' => $request->client_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'photo_format' => $request->photo_format,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'deposit' => $request->deposit,
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
            'created_by_id' => auth()->id(),
        ]);
        Gallery::create([
            'studio_id' => auth()->user()->studio_id,
            'client_id' => $client->id,
        ]);
        Invoice::create([
            'studio_id' => auth()->user()->studio_id,
            'client_id' => $client->id,
            'amount' => $client->price,
            'description' => "Creation for {$client->photo_format} package",
            'status' => 'unpaid',
            'due_date' => now()->addDays(7),
        ]);
        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'client_created',
            'description' => 'Created client: ' . $client->name,
        ]);
        return redirect()->route('staff.clients')->with('success', 'Client created successfully!');
    }

    // show — view client detail
    public function show($id) {
        $client = Client::where('studio_id', auth()->user()->studio_id)
            ->with(['photos', 'invoices'])->findOrFail($id);
        return view('staff.clients.show', compact('client'));
    }

    public function updateOrderStatus(Request $request, $id) {
        $request->validate(['order_status' => 'required|in:pending,editing,ready,delivered']);
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $client->update(['order_status' => $request->order_status]);
        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'order_status_updated',
            'description' => "Updated order status to {$request->order_status} for client: {$client->name}",
        ]);
        return back()->with('success', 'Order status updated!');
    }

    public function updateDeposit(Request $request, $id) {
        $request->validate(['deposit' => 'required|numeric|min:0']);
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $client->update(['deposit' => $request->deposit]);
        if ($client->deposit >= $client->price) {
            $client->update(['payment_status' => 'paid']);
        }
        ActivityLog::create([
            'studio_id' => auth()->user()->studio_id,
            'user_id' => auth()->id(),
            'action' => 'deposit_updated',
            'description' => "Updated deposit to ₦{$request->deposit} for client: {$client->name}",
        ]);
        return back()->with('success', 'Deposit updated!');
    }

    public function generateGallery($id) {
        $client = Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $gallery = Gallery::firstOrCreate([
            'client_id' => $client->id,
            'studio_id' => auth()->user()->studio_id,
        ]);
        $gallery->update(['token' => Str::random(32)]);
        return back()->with('success', 'Gallery link generated!');
    }
}
