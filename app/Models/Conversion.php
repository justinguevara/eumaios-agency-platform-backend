<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversion extends Model
{
    private string $conversion_type;

    // TODO review
    /**
     */
     /*
    public function campaign(): HasOne
    {
        return $this->hasOne(Campaign::class);
    }
    */
}
