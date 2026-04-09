@extends('layouts.app')
@section('title', 'Upload Photos')
@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
	<div class="bg-white rounded-lg shadow p-6">
		<h1 class="text-2xl font-bold mb-4">Upload Photos for Client (ID: {{ $id }})</h1>
		<p class="text-gray-600">Select photos to upload for this client.</p>
	</div>
</div>
@endsection
