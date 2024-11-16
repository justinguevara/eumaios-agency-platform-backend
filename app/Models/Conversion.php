<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversion extends Model
{
    private string $conversion_type;
    private int $campaign_id;

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
