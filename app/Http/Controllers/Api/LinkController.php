<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\LinkClick;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function shorten(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url|max:255',
        ]);

        $shortCode = Str::random(6);

        $link = Link::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'short_url' => url($link->short_code),
            'original_url' => $request->original_url
        ], 201);
    }

    public function userLinks()
    {
        $links = auth()->user()->links()->with('clicks')->get();

        return response()->json($links);
    }

    public function redirect($shortCode)
    {
        $link = Link::where('short_code', $shortCode)->firstOrFail();

        LinkClick::create([
            'link_id' => $link->id,
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'clicked_at' => now(),
        ]);

        return redirect($link->original_url);
    }
}
