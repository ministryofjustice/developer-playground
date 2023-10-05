<?php

namespace Tests\Feature\Event;

use App\Models\EventType;
use App\Models\EventTypeTag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTypeTagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_type_tag_can_be_created()
    {
        $type = EventType::factory()->create();

        $response = $this->post('/dashboard/event/types/' . $type->id .'/tag', [
            'name' => 'Approve',
            'icon' => '<path d="M21.856 10.303c.086.554.144 1.118.144 1.697 0 6.075-4.925 11-11 11s-11-4.925-11-11 4.925-11 11-11c2.347 0 4.518.741 6.304 1.993l-1.422 1.457c-1.408-.913-3.082-1.45-4.882-1.45-4.962 0-9 4.038-9 9s4.038 9 9 9c4.894 0 8.879-3.928 8.99-8.795l1.866-1.902zm-.952-8.136l-9.404 9.639-3.843-3.614-3.095 3.098 6.938 6.71 12.5-12.737-3.096-3.096z"/>'
        ]);

        $this->assertCount(1, EventTypeTag::all());
        $response->assertCreated();
    }


    /** @test */
    public function an_event_type_tag_can_be_created_with_null_icon()
    {
        $type = EventType::factory()->create();
        $response = $this->post('/dashboard/event/types/' . $type->id . '/tag', [
            'name' => 'Approve'
        ]);
        $this->assertCount(1, EventType::all());
        $response->assertCreated();
    }

    /** @test */
    public function an_event_type_tag_icon_must_contain_a_path_tag_if_present()
    {
        $type = EventType::factory()->create();
        $response = $this->post('/dashboard/event/types/' . $type->id . '/tag', [
            'name' => 'Approve',
            'icon' => '<svg/>'
        ]);

        $response->assertSessionHasErrors('icon');
    }

    /** @test */
    public function an_event_type_tag_must_have_a_valid_event_type_id()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Database\Eloquent\ModelNotFoundException');

        $this->post('/dashboard/event/types/3/tag', [
            'name' => 'Approve'
        ]);
    }
}
