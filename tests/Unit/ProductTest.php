<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class ProductTest extends TestCase
{
    public function testListProducts() {
        $response = $this->json('GET', '/api/products');
        $response->assertStatus(200);
    }

    public function testSingleProduct() {
        $response = $this->json('GET', '/api/products/1');

        $response->assertStatus(200)
                ->assertJson(["amount" => 0,
                              "name" => "Papas a la francesa",
                              "price" => 65]);
    }

    public function testCreateProduct() {
        $data = [
                "name" => "Hot Dogs " . rand(),
                "price" => "75.00",
                "amount" => "0"
        ];

        $response = $this->json('POST', '/api/products', $data);

        $response->assertStatus(200)
                ->assertJson($data);
    }
}
