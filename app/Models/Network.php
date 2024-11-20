<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model
{
    use HasFactory;

    private string $name;
    private string $status;

    protected $fillable = [
        'name',
    ];

    public function publishers(): HasMany
    {
        // networks.id -> publishers.network_id 
        return $this->hasMany(Publisher::class);
    }

    public function advertisers(): HasMany
    {
        // networks.id -> publishers.network_id 
        return $this->hasMany(Advertiser::class);
    }
}
