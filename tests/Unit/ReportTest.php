<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;

class ReportTest extends TestCase
{
    public function testProductOrders() {
        $response = $this->json('GET', '/api/reports/2021-01-01/2021-12-31');

        $response->assertStatus(200);
    }
}
