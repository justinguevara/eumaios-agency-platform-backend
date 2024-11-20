<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Network;

class NetworkTest extends TestCase
{
    use RefreshDatabase;

    public function testNetworkPublishers(): void
    {
        $network = Network::factory()->make();
        $publishers = $network->publishers();
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($publishers));
    }

    public function testNetworkAdvertisers(): void
    {
        $network = Network::factory()->make();
        $publishers = $network->publishers();
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($publishers));
    }
}
