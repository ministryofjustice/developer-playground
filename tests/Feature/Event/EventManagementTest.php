<?php

namespace Tests\Feature\Event;

use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_can_be_created()
    {
        $user = User::factory()->create();
        $tool = Tool::factory()->create();

        $response = $this->post('/dashboard/tools/' . $tool->id . '/event', [
            'action' => 'tooling-review',
            'detail' => 'This detail would contain an official review of a tool after consideration.',
            'origin' => 'email-submission',
            'user_id' => $user->id
        ]);
        $this->assertCount(1, Event::all());
        $response->assertCreated();
    }
}
