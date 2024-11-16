<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertiser extends Model
{
    use SoftDeletes;

    private string $name;
    private ?string $description;
    private ?string $contact_name;
    private ?string $contact_email;
    private ?string $contact_phone_number;
    private ?string $address_street_1;
    private ?string $address_street_2;
    private ?string $address_city;
    private ?string $address_region;
    private ?string $address_country_id;
    private ?string $address_postal_code;
    private int $network_id;

    protected $fillable = [
        'name', 'description', 'contact_name', 'contact_email', 'contact_phone_number',
        'address_street_1', 'address_street_2', 'address_city', 'address_region',
        'address_country_id', 'address_postal_code', 'network_id'
    ];

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }
}
