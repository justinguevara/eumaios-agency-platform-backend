<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\PublishersController;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Mockery;
use \Illuminate\Http\Response;

class PublishersControllerTest extends TestCase
{
    public function testPublishersControllerIndex()
    {
        $publishers = [
            ['id' => 1, 'name' => 'P1'],
            ['id' => 2, 'name' => 'P2'],
        ];
        $publishers_mock = Mockery::mock('alias:' . Publisher::class);
        $publishers_mock->shouldReceive('all')
            ->once()
            ->andReturn(collect($publishers));

        $controller = new PublishersController();
        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(['publishers' => $publishers], $response->getData(true));
    }
}