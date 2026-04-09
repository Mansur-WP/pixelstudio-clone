@extends('layouts.app')
@section('title', 'Add New Client')
@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
	<h1 class="text-2xl font-bold mb-6">Add New Client</h1>
	<form method="POST" action="{{ route('staff.clients.store') }}" class="bg-white rounded-lg shadow p-6 space-y-4">
		@csrf
		<div>
			<label class="block text-gray-700">Client Name <span class="text-red-500">*</span></label>
			<input type="text" name="client_name" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required value="{{ old('client_name') }}">
			@error('client_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
		</div>
		
		<div class="grid grid-cols-2 gap-4">
			<div>
				<label class="block text-gray-700">Email</label>
				<input type="email" name="email" class="mt-1 block w-full border-gray-300 rounded shadow-sm" value="{{ old('email') }}">
				@error('email')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
			<div>
				<label class="block text-gray-700">Phone</label>
				<input type="text" name="phone" class="mt-1 block w-full border-gray-300 rounded shadow-sm" value="{{ old('phone') }}">
				@error('phone')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
		</div>

		<div class="grid grid-cols-2 gap-4">
			<div>
				<label class="block text-gray-700">Photo Format <span class="text-red-500">*</span></label>
				<select name="photo_format" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
					<option value="Softcopy" {{ old('photo_format') == 'Softcopy' ? 'selected' : '' }}>Softcopy</option>
					<option value="Hardcopy" {{ old('photo_format') == 'Hardcopy' ? 'selected' : '' }}>Hardcopy</option>
					<option value="Both" {{ old('photo_format') == 'Both' ? 'selected' : '' }}>Both</option>
				</select>
				@error('photo_format')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
			<div>
				<label class="block text-gray-700">Quantity <span class="text-red-500">*</span></label>
				<input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
				@error('quantity')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
		</div>

		<div class="grid grid-cols-2 gap-4">
			<div>
				<label class="block text-gray-700">Price <span class="text-red-500">*</span></label>
				<input type="number" step="0.01" name="price" value="{{ old('price', 0) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
				@error('price')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
			<div>
				<label class="block text-gray-700">Deposit <span class="text-red-500">*</span></label>
				<input type="number" step="0.01" name="deposit" value="{{ old('deposit', 0) }}" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
				@error('deposit')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
		</div>

		<div class="grid grid-cols-2 gap-4">
			<div>
				<label class="block text-gray-700">Order Status <span class="text-red-500">*</span></label>
				<select name="order_status" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
					<option value="pending" {{ old('order_status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
					<option value="completed" {{ old('order_status') == 'completed' ? 'selected' : '' }}>Completed</option>
					<option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
				</select>
				@error('order_status')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
			<div>
				<label class="block text-gray-700">Payment Status <span class="text-red-500">*</span></label>
				<select name="payment_status" class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
					<option value="unpaid" {{ old('payment_status', 'unpaid') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
					<option value="partial" {{ old('payment_status') == 'partial' ? 'selected' : '' }}>Partial</option>
					<option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
				</select>
				@error('payment_status')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
			</div>
		</div>

		<div>
			<label class="block text-gray-700">Notes</label>
			<textarea name="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('notes') }}</textarea>
			@error('notes')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
		</div>
		<div class="flex justify-between items-center mt-6">
			<a href="{{ route('staff.clients') }}" class="text-gray-600 hover:underline">Cancel</a>
			<button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-semibold">Save Client</button>
		</div>
	</form>
</div>
@endsection
