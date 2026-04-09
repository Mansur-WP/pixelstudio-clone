@extends('layouts.app')
@section('title', 'Gallery for ' . $client->name)
@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Gallery for {{ $client->name }}</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @forelse($photos as $photo)
            <div class="bg-white rounded shadow p-2 flex flex-col items-center">
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->filename }}" class="w-full h-48 object-cover rounded mb-1">
                <span class="text-xs text-gray-400">{{ $photo->created_at->format('M d, Y') }}</span>
            </div>
        @empty
            <div class="col-span-2 md:col-span-3 text-gray-400">No photos in this gallery.</div>
        @endforelse
    </div>
</div>
@endsection
