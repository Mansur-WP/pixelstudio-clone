@extends('layouts.guest')
@section('content')
    <h2 class="text-xl font-semibold mb-4 text-center">Verify OTP</h2>
    @if($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="/auth/verify-otp" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">6 Digit OTP</label>
            <input type="text" name="code" maxlength="6" class="w-full border rounded px-3 py-2 mt-1" required autofocus>
        </div>
        <input type="hidden" name="email" value="{{ old('email') }}">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Verify OTP</button>
    </form>
@endsection
