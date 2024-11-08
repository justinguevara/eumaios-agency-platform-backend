<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    private ?string $address_country;
    private ?string $address_postal_code;

    protected $attributes = [
    ];

    // TODO review
    /**
     */
     /*
    public function network(): HasOne
    {
        return $this->hasOne(Network::class);
    }
    */
}
