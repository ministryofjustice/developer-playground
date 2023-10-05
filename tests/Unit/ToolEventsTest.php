<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Models\Event;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class ToolEventsTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    /** @test */
    public function tools_can_record_a_review_event()
    {
        /**
         * @var Tool $tool
         **/
        $tool = Tool::factory()->create();
        $user = User::factory()->create();

        $detail = 'This is a viability review of a tool submitted to the TPC, by an authenticated user.';

        $tool->review($detail, $user);

        $this->assertCount(1, Event::all());
        $this->assertEquals($detail, Event::first()->detail);
        $this->assertEquals($tool->id, Event::first()->tool_id);
        $this->assertEquals($user->id, Event::first()->user_id);
    }

    /** @test */
    public function tools_can_record_a_status_update_event()
    {
        $this->authorisedUser();
        /**
         * @var Tool $tool
         **/
        $tool = Tool::factory()->create();

        $tool->status('in review');
        $tool->status('rejected');
        $tool->status('approved');

        $this->assertCount(3, Event::all());
        $this->assertEquals('in review', Event::first()->detail);
        $this->assertEquals($tool->id, Event::first()->tool_id);
    }

    public function test_a_tool_object_has_events()
    {
        Event::factory()->create();
        $tool = Tool::first();
        $this->assertEquals('Tool created', $tool->events[0]->detail);
    }

    public function test_a_tool_object_has_a_contact()
    {
        $tool = Tool::factory()->create();
        $contact = Contact::first();
        $this->assertEquals($contact->name, $tool->contact->name);
    }
}
