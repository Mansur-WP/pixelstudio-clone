@extends('layouts.guest')
@section('content')
    <h2 class="text-xl font-semibold mb-4 text-center text-indigo-700">Platform Admin Login</h2>
    @if($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="/platform/login" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2 mt-1" required autofocus>
        </div>
        <div>
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1" required>
        </div>
        <button type="submit" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-2 rounded">Sign in</button>
    </form>
@endsection
