<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class OrderTest extends TestCase
{
    public function testListOrders() {
        $response = $this->json('GET', '/api/orders');

        $response->assertStatus(200);
    }
}
