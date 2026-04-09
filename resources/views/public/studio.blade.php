@extends('layouts.guest')
@section('content')
<div class="max-w-lg mx-auto py-10">
    <div class="flex flex-col items-center mb-6">
        @if($studio->logo_path)
            <img src="{{ asset('storage/' . $studio->logo_path) }}" alt="Logo" class="h-20 w-20 rounded-full object-cover mb-2">
        @else
            <span class="inline-block h-20 w-20 bg-gray-200 rounded-full flex items-center justify-center text-4xl text-gray-500 mb-2">
                <i class="fas fa-camera"></i>
            </span>
        @endif
        <div class="font-bold text-2xl mb-1">{{ $studio->name }}</div>
        <span class="px-2 py-1 rounded text-xs font-semibold {{ $studio->plan === 'pro' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
            {{ ucfirst($studio->plan) }}
        </span>
    </div>
    <div class="bg-white rounded shadow p-6 mb-6">
        <h3 class="font-semibold mb-2">Book a session with us</h3>
        <form>
            <textarea class="w-full border rounded px-3 py-2 mb-2" placeholder="Your message"></textarea>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded">Send Message</button>
        </form>
    </div>
    <div class="text-center">
        <a href="/login" class="text-blue-600 hover:underline">Login to your studio</a>
    </div>
</div>
@endsection
