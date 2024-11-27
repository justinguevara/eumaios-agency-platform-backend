<?php

namespace Database\Factories;

use App\Models\Advertiser;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertiserFactory extends Factory
{
    protected $model = Advertiser::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentences(3, true),
            'contact_name' => $this->faker->name,
            'contact_email' => $this->faker->safeEmail,             
            'contact_phone_number' => $this->faker->phoneNumber,
            'address_street_1' => $this->faker->streetAddress,
            'address_street_2' => $this->faker->secondaryAddress,
            'address_city' => $this->faker->city,
            'address_region' => $this->faker->state,
            'address_country_id' => null,
            'address_postal_zip' => $this->faker->postcode,
            'network_id' => null,
        ];
    }
}
