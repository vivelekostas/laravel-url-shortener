<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LinkClickResource extends JsonResource
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
            'link_id' => $this->link_id,
            'ip' => $this->ip,
            'user_agent' => $this->user_agent,
            'clicked_at' => $this->clicked_at,
        ];
    }
}
