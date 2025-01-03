<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\PublisherFactory;

class Publisher extends Model
{
    use HasFactory;
    use SoftDeletes;

    private ?string $name;
    private ?string $description;
    private ?string $contact_name;
    private ?string $contact_email;
    private ?string $contact_phone_number;
    private ?string $address_street_1;
    private ?string $address_street_2;
    private ?string $address_city;
    private ?string $address_region;
    private ?int $address_country_id;
    private ?string $address_country;
    private ?string $address_postal_zip;
    private int $network_id;

    protected $fillable = [
        'name', 'description', 'contact_name', 'contact_email', 'contact_phone_number',
        'address_street_1', 'address_street_2', 'address_city', 'address_region',
        'address_country_id', 'address_postal_zip', 'network_id'
    ];

    public function network(): BelongsTo
    {
        return $this->belongsTo(Network::class);
    }

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class);
    }

    /**
    * This method definition is redundant due to the conventions used by laravel,
    * but wil be kept for reference purposes.
    */
    protected static function newFactory()
    {
        return PublisherFactory::new();
    }
}