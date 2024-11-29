<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversion extends Model
{
    use HasFactory;

    private string $conversion_type;
    private int $campaign_id;

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
