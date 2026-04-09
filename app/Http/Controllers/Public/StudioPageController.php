<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studio;

class StudioPageController extends Controller
{
    public function show($slug)
    {
        $studio = \App\Models\Studio::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('public.studio', compact('studio'));
    }
}
