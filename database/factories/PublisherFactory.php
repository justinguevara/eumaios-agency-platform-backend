<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    protected $model = Publisher::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => null,
            'contact_name' => null,
            'contact_email' => null,
            'contact_phone_number' => null,
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_region' => null,
            'address_country_id' => null,
            'address_postal_zip' => null,
            'network_id' => null,
            'deleted_at' => null,
        ];
    }
}
