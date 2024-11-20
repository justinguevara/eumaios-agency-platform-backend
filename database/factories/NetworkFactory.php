<?php

namespace Database\Factories;

use App\Models\Network;
use Illuminate\Database\Eloquent\Factories\Factory;

class NetworkFactory extends Factory
{
    protected $model = Network::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
