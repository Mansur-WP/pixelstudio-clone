<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create($id) {
        $client = \App\Models\Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        return view('staff.clients.upload', compact('client'));
    }
    public function store(Request $request, $id) {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        $client = \App\Models\Client::where('studio_id', auth()->user()->studio_id)->findOrFail($id);
        $studioId = auth()->user()->studio_id;
        $uploaded = 0;

        // Check if client has a gallery, if not create one
        $gallery = \App\Models\Gallery::where('client_id', $client->id)->where('studio_id', $studioId)->first();
        if (!$gallery) {
            $gallery = \App\Models\Gallery::create([
                'studio_id' => $studioId,
                'client_id' => $client->id,
                'token' => \App\Models\Gallery::generateToken(40),
            ]);
        }

        foreach ($request->file('photos') as $photo) {
            $filename = uniqid() . '_' . $photo->getClientOriginalName();
            $path = $photo->storeAs("photos/{$studioId}/{$id}", $filename, 'public');
            \App\Models\Photo::create([
                'studio_id' => $studioId,
                'client_id' => $id,
                'filename' => $filename,
                'path' => $path,
                'size' => $photo->getSize(),
                'uploaded_by' => auth()->id(),
            ]);
            $uploaded++;
        }
        \App\Models\ActivityLog::create([
            'studio_id' => $studioId,
            'user_id' => auth()->id(),
            'action' => 'photos_uploaded',
            'description' => "Uploaded {$uploaded} photo(s) for client: {$client->name}",
        ]);
        return redirect()->route('staff.clients.show', $id)->with('success', "{$uploaded} photo(s) uploaded successfully!");
    }
}
