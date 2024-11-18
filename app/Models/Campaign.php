<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 
class Campaign extends Model
{
    private string $name;
    private ?string $description;
    private string $conversion_type; // TODO
    private int $advertiser_id;
    private int $network_id;

    protected $fillable = [
        'name', 'description', 'conversion_type', 'advertiser_id', 
        'network_id'
    ];

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class);
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class);
    }
}
