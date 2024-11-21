<?php

namespace App\Services;

use App\Models\Link;
use App\Models\LinkClick;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class LinkService
{
    public function shorten($data): Link
    {
        $shortCode = Str::random(6);

        return Link::create([
            'original_url' => $data['original_url'],
            'short_code' => $shortCode,
            'user_id' => auth()->id(),
        ]);
    }

    public function getUserLinks(): Collection
    {
        return auth()->user()->links()->with('clicks')->get();
    }

    public function getOriginalUrl($shortCode): string
    {
        $link = Link::where('short_code', $shortCode)->firstOrFail();

        LinkClick::create([
            'link_id' => $link->id,
            'ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'clicked_at' => now(),
        ]);

        return $link->original_url;
    }
}
