<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class DashboardTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_the_dashboard_can_receive_data()
    {
        $this->authorisedUser();

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);

        $this->assertArrayHasKey('tooling', $response['data']);
        $this->assertArrayHasKey('organisations', $response['data']);
        $this->assertArrayHasKey('licences', $response['data']);
        $this->assertArrayHasKey('teams', $response['data']);
        $this->assertArrayHasKey('business-cases', $response['data']);
        $this->assertArrayHasKey('contacts', $response['data']);
        $this->assertArrayHasKey('cost-centres', $response['data']);
    }
}
