@extends('layouts.guest')
@section('content')
    <h2 class="text-xl font-semibold mb-4 text-center">Forgot Password</h2>
    @if(session('status'))
        <div class="mb-4 text-green-600 text-sm">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="/auth/request-otp" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2 mt-1" required autofocus>
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Send OTP</button>
    </form>
@endsection
