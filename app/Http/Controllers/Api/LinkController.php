<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShortLinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use App\Models\LinkClick;
use App\Services\LinkService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function __construct(private LinkService $linkService) {}

    public function shorten(StoreShortLinkRequest $request)
    {
        $data = $request->validated();

        $link = $this->linkService->shorten($data);

        return new LinkResource($link);
    }

    public function userLinks()
    {
        $links = $this->linkService->getUserLinks();

        return LinkResource::collection($links);
    }

    public function redirect($shortCode)
    {
        $originalUrl = $this->linkService->getOriginalUrl($shortCode);

        return redirect($originalUrl);
    }
}
