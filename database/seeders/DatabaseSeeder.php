<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Network;
use App\Models\Advertiser;
use App\Models\Campaign;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Network::factory()
            ->count(2)
            ->create();

        $networks = Network::factory()
            ->count(2)
            ->has(
                Advertiser::factory()
                    ->count(5)
                    ->has(
                        Campaign::factory()
                            ->count(5)
                    )
            )
            ->has(
                Advertiser::factory()
                    ->trashed()
                    ->count(2)
                    ->has(
                        Campaign::factory()
                            ->count(2)
                    )
            )
            ->has(
                Advertiser::factory()
                    ->count(5)
            )
            ->has(
                Publisher::factory()
                    ->count(50)
            )
            ->has(
                Publisher::factory()
                    ->trashed()
                    ->count(5)
            )
            ->create();

        $main_network_id = $networks[0]->id;
        $second_network_id = $networks[1]->id;

        // create publishers that are associated with a campaign
        $main_network_advertisers = Advertiser::where('network_id', $main_network_id)->get();
        $advertiser_ids = array_map( 
            function ($advertiser) {
                return $advertiser['id'];
            },
            $main_network_advertisers->toArray()
        );

        Publisher::factory()
            ->state([
                'network_id' => $main_network_id
            ])
            ->count(5)
            ->has(
                Campaign::factory()
                    ->count(2)
                    ->sequence(
                        function (Sequence $sequence) use ($advertiser_ids) {
                            $key = array_rand($advertiser_ids);
                            return ['advertiser_id' => $advertiser_ids[$key]];
                        }
                    )
            )
            ->create();

        // @todo review - https://stackoverflow.com/questions/44628406/why-is-it-strongly-recommended-not-to-use-the-env-helper-when-caching-config
        User::factory()
            ->state([
                'email' => env('TEST_USER_USERNAME', fake()->unique()->safeEmail()),
                'password' => Hash::make(env('TEST_USER_PASSWORD', Str::random(8))),
                'network_id' => $main_network_id
            ])
            ->create();

        // @todo think about unique constraints
        User::factory()
            ->state([
                'network_id' => $second_network_id
            ])
            ->count(10)
            ->create();
    }
}