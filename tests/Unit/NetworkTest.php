<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Network;

use PHPUnit\Framework\Attributes\Test;

class NetworkTest extends TestCase
{
    use RefreshDatabase;

    private ?Network $network;

    #[Test]
    public function publishers(): void
    {
        $publishers = $this->network->publishers();
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($publishers));
    }

    #[Test]
    public function advertisers(): void
    {
        $advertisers = $this->network->publishers();
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($advertisers));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->network = Network::factory()->make();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    
        $this->network = null;
    }
}
