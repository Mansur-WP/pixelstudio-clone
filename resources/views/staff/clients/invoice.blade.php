@extends('layouts.app')
@section('title', 'Create Invoice for ' . $client->name)
@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Create Invoice for {{ $client->name }}</h1>
    <form method="POST" action="{{ route('staff.invoice.store', $client->id) }}" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Amount <span class="text-red-500">*</span></label>
            <input type="number" name="amount" step="0.01" min="0" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required value="{{ old('amount') }}">
            @error('amount')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('description') }}</textarea>
            @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-gray-700">Due Date</label>
            <input type="date" name="due_date" class="mt-1 block w-full border-gray-300 rounded shadow-sm" value="{{ old('due_date') }}">
            @error('due_date')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('staff.clients.show', $client->id) }}" class="text-gray-600 hover:underline">Back</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold">Create Invoice</button>
        </div>
    </form>
</div>
@endsection
