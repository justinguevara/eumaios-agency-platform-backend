<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->sentences(3, true),
            'conversion_type' => 'test', //@todo placeholder value
        ];
    }
}
