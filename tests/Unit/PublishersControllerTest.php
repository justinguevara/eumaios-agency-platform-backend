<?php

namespace Tests\Unit;

use \Tests\TestCase;
use \App\Http\Controllers\PublishersController;
use \App\Models\Publisher;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Http\Response;

class PublishersControllerTest extends TestCase
{
    public function testPublishersControllerIndex()
    {
        Publisher::factory()->create(['name' => 'P1']);
        Publisher::factory()->create(['name' => 'P2']);
        $publishers = Publisher::all()->toArray();

        $controller = new PublishersController();
        $response = $controller->index();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['publishers' => $publishers], $response->getData(true));
    }
}