<?php

namespace Tests\Feature\Event;

use App\Models\EventType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_event_type_can_be_created()
    {
        $response = $this->post('/dashboard/event/types', [
            'name' => 'Status',
            'icon' => '<path d="M15.137 3.945c-.644-.374-1.042-1.07-1.041-1.82v-.003c.001-1.172-.938-2.122-2.096-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.667 2.712-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.195-10.594-6.863-13.306zm-3.137-2.945c.552 0 1 .449 1 1 0 .552-.448 1-1 1s-1-.448-1-1c0-.551.448-1 1-1zm3 20c0 1.598-1.392 3-2.971 3s-3.029-1.402-3.029-3h6z"/>'
        ]);
        $this->assertCount(1, EventType::all());
        $response->assertCreated();
    }

    /** @test */
    public function an_event_type_can_be_created_with_null_icon()
    {
        $response = $this->post('/dashboard/event/types', [
            'name' => 'Status'
        ]);
        $this->assertCount(1, EventType::all());
        $response->assertCreated();
    }

    /** @test */
    public function an_event_type_icon_must_contain_a_path_tag_if_present()
    {
        $response = $this->post('/dashboard/event/types', [
            'name' => 'Status',
            'icon' => '<svg/>'
        ]);

        $response->assertSessionHasErrors('icon');
    }
}
