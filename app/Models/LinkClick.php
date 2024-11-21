<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LinkClick extends Model
{
    protected $fillable = [
        'link_id',
        'ip',
        'user_agent',
        'clicked_at',
    ];

    public function link() : BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
