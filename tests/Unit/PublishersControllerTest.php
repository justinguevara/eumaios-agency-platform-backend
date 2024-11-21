<?php

namespace Tests\Unit;

use \Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\Http\Controllers\PublishersController;
use \App\Models\Publisher;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Response;

use PHPUnit\Framework\Attributes\Test;

class PublishersControllerTest extends TestCase
{
    use RefreshDatabase;

    private ?PublishersController $controller;

    #[Test]
    public function index()
    {
        Publisher::factory()->create(['name' => 'P1']);
        Publisher::factory()->create(['name' => 'P2']);
        $publishers = Publisher::all()->toArray();

        $response = $this->controller->index();
        
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['publishers' => $publishers], $response->getData(true));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new PublishersController();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    
        $this->controller = null;
    }
}