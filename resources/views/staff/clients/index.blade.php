@extends('layouts.app')
@section('title', 'Clients')
@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
	<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
		<h1 class="text-2xl font-bold">Clients</h1>
        <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
            <form action="{{ route('staff.clients') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or phone..." 
                       class="px-4 py-2 border rounded-lg text-sm w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold hover:bg-gray-800 transition-colors">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('staff.clients') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-200 transition-colors">
                        Clear
                    </a>
                @endif
            </form>
            <a href="{{ route('staff.clients.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold shadow-sm transition-colors text-sm">
                <span class="mr-2">➕</span> Add Client
            </a>
        </div>
	</div>

	@if(session('success'))
		<div class="mb-6 p-4 rounded-lg bg-green-50 text-green-800 border border-green-100 font-medium">
			{{ session('success') }}
		</div>
	@endif

    @if(request('search'))
        <div class="mb-6 text-sm text-gray-600">
            <span class="font-bold">{{ $clients->total() }}</span> results for "<span class="font-bold">{{ request('search') }}</span>"
        </div>
    @endif

	@if($clients->count())
		<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
			<table class="min-w-full divide-y divide-gray-100">
				<thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
					<tr>
						<th class="px-6 py-4 text-left">Client Info</th>
						<th class="px-6 py-4 text-left">Order Status</th>
						<th class="px-6 py-4 text-left">Payment</th>
						<th class="px-6 py-4 text-left">Date Added</th>
						<th class="px-6 py-4 text-right">Actions</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-100 italic-none">
					@foreach($clients as $client)
						<tr class="hover:bg-gray-50 transition-colors">
							<td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $client->name }}</div>
                                <div class="text-xs text-gray-500">{{ $client->email }} | {{ $client->phone }}</div>
                            </td>
							<td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'editing' => 'bg-blue-100 text-blue-800',
                                        'ready' => 'bg-purple-100 text-purple-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                    ];
                                    $color = $statusColors[$client->order_status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $color }}">
                                    {{ ucfirst($client->order_status) }}
                                </span>
                            </td>
							<td class="px-6 py-4">
                                @if($client->payment_status === 'paid')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Paid</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold">Pending</span>
                                @endif
                            </td>
							<td class="px-6 py-4 text-sm text-gray-500">{{ $client->created_at->format('M d, Y') }}</td>
							<td class="px-6 py-4 text-right">
								<a href="{{ route('staff.clients.show', $client->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded hover:bg-indigo-100 text-xs font-bold transition-colors">View Details</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="mt-8">{{ $clients->links() }}</div>
	@else
		<div class="text-gray-500 text-center py-16">
			<span class="text-3xl">👤</span>
			<div class="mt-2">No clients found.</div>
		</div>
	@endif
</div>
@endsection
