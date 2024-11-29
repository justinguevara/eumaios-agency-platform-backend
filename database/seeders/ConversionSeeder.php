<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conversion;
use App\Models\Campaign;

class ConversionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $campaigns = Campaign::take(10)
            ->get();

        for ($i = 0; $i < 3; $i++) {
            $campaign = $campaigns->random();
            Conversion::factory()
                ->count(rand(100, 200))
                ->for($campaign)
                ->create();
        }
    }
}