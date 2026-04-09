@extends('layouts.guest')
@section('content')
    <h2 class="text-xl font-semibold mb-4 text-center">Reset Password</h2>
    @if($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="/auth/reset-password" class="space-y-4">
        @csrf
        <input type="hidden" name="email" value="{{ request('email') }}">
        <input type="hidden" name="code" value="{{ request('code') }}">
        <div>
            <label class="block text-gray-700">New Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <div>
            <label class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Reset Password</button>
    </form>
@endsection
