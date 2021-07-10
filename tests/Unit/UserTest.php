<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class UserTest extends TestCase
{
    public function testAllUsers()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

    public function testSingleUser() {
        $response = $this->json('GET', '/api/users/1');
        $response->assertStatus(200)
                ->assertJson(['name' => 'Ruben Cortes',
                              'email' => 'ruben@gmail.com',
                              'id' => 1]);
    }

    public function testCreateUser() {
        $data = [
            "name" => "Alonso " . rand(),
            "email" => "alonso".  rand() . "@gmail.com"
        ];

        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200)
                 ->assertJson($data);
    }
}
