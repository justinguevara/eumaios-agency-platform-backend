<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    private string $name;
    private ?string $description;
    private string $conversion_type;
    private int $advertiser_id;

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(Advertiser::class);
    }
}
