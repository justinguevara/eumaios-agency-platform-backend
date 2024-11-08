<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Network extends Model
{
    private string $name;
    private string $status;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function publishers(): HasMany
    {
        // networks.id -> publishers.network_id 
        return $this->hasMany(Publisher::class);
    }
}
