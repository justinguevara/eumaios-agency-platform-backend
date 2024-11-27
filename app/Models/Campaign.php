<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Campaign extends Model
{
    use HasFactory;

    private string $name;
    private ?string $description;
    private string $conversion_type; // TODO
    private int $advertiser_id;

    protected $fillable = [
        'name', 'description', 'conversion_type', 'advertiser_id', 
    ];

    public function advertiser(): BelongsTo
    {
        return $this->belongsTo(Advertiser::class);
    }

    public function publishers(): BelongsToMany
    {
        return $this->belongsToMany(Publisher::class);
    }
}
