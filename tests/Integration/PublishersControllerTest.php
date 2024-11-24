<?php

namespace Tests\Integration;

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
        $publishers = Publisher::factory()
            ->count(5)
            ->create();
        $publishers = $publishers->toArray();
        $response = $this->controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(
            ['publishers' => $publishers],
            $response->getData(true)
        );
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