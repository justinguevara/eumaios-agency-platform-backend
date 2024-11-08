<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campaign extends Model
{
    private string $name;
    private ?string $description;
    private string $conversion_type;

    // TODO review
    /**
     */
     /*
    public function advertiser(): HasOne
    {
        return $this->hasOne(Advertiser::class);
    }
    */

    /**
     */
     /*
    public function network(): HasOne
    {
        return $this->hasOne(Network::class);
    }
    */
}
