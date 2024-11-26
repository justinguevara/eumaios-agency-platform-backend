<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Network;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // @todo review - https://stackoverflow.com/questions/44628406/why-is-it-strongly-recommended-not-to-use-the-env-helper-when-caching-config
        User::factory()
            ->state([
                'email' => env('TEST_USER_USERNAME', fake()->unique()->safeEmail()),
                'password' => Hash::make(env('TEST_USER_PASSWORD', Str::random(8))),
            ])
            ->create();

        // @todo think about unique constraints
        User::factory()
            ->count(10)
            ->create();

        Publisher::factory()
            ->count(50)
            ->create();

        Publisher::factory()
            ->trashed()
            ->count(5)
            ->create();

        Network::factory()
            ->count(3)
            ->create();
    }
}