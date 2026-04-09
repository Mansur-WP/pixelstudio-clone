<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function show($token)
    {
        $gallery = Gallery::where('token', $token)->with(['client', 'client.photos'])->firstOrFail();
        return view('public.client-gallery', [
            'gallery' => $gallery,
            'client' => $gallery->client,
            'photos' => $gallery->client->photos,
        ]);
    }
}
