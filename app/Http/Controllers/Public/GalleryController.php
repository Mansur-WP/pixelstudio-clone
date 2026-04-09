<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Studio;

class GalleryController extends Controller
{
    public function show($token)
    {
        $gallery = \App\Models\Gallery::where('token', $token)
            ->with(['client', 'client.photos'])
            ->firstOrFail();
        $studio = \App\Models\Studio::find($gallery->studio_id);
        $photos = $gallery->client->photos;
        return view('public.gallery', compact('gallery', 'photos', 'studio'));
    }
}
