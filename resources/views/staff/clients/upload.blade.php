@extends('layouts.app')
@section('title', 'Upload Photos for ' . $client->name)
@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Upload Photos for {{ $client->name }}</h1>
    <form method="POST" action="{{ route('staff.photos.store', $client->id) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-4">
        @csrf
        <div x-data="{ files: [] }" class="space-y-2">
            <label class="block text-gray-700 mb-2">Photos <span class="text-red-500">*</span></label>
            <div x-on:drop.prevent="files = [...$event.dataTransfer.files]" x-on:dragover.prevent class="flex flex-col items-center justify-center border-2 border-dashed border-indigo-400 rounded p-6 cursor-pointer bg-indigo-50 hover:bg-indigo-100" x-on:click="$refs.fileInput.click()">
                <input type="file" name="photos[]" x-ref="fileInput" multiple accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden" x-on:change="files = [...$refs.fileInput.files]">
                <span class="text-indigo-600 font-semibold">Drag & drop or click to select photos</span>
                <span class="text-xs text-gray-500 mt-2">Max file size: 5MB per photo</span>
            </div>
            <template x-if="files.length">
                <div class="mt-4 grid grid-cols-2 gap-2">
                    <template x-for="file in files" :key="file.name">
                        <div class="flex flex-col items-center">
                            <img :src="URL.createObjectURL(file)" class="w-24 h-24 object-cover rounded mb-1 border">
                            <span class="text-xs text-gray-700" x-text="file.name"></span>
                        </div>
                    </template>
                </div>
            </template>
            @error('photos')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
            @error('photos.*')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('staff.clients.show', $client->id) }}" class="text-gray-600 hover:underline">Back</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-semibold">Upload Photos</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
