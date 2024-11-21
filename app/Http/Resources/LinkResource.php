<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'original_url' => $this->original_url,
            'short_code' => $this->short_code,
            'user_id' => $this->user_id,
            'clicks' => LinkClickResource::collection($this->whenLoaded('clicks')),
        ];
    }
}
