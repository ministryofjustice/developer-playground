<?php

namespace Tests\Feature;

use App\Models\CostCentre;
use App\Models\Licence;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class LicenceManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_Licences_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get(route('licences'));
        $response->assertStatus(200);
    }

    public function test_a_licence_can_be_created()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();
        $tool = Tool::factory()->create();

        $this->post('/dashboard/licences', [
            'tool_id' => $tool->id,
            'description' => 'hello',
            'user_limit' => 1000,
            'currency' => 'GB',
            'cost_per_user' => 10.99,
            'start' => '2021-09-12 00:00:00',
            'stop' => '2022-09-11 23:59:59'
        ]);

        $licences = Licence::all();
        $this->assertCount(1, $licences);

        // start; test date formats correctly
        $this->assertInstanceOf(Carbon::class, $licences->first()->start);
        $this->assertEquals(
            'Sunday 12th of September 2021',
            $licences->first()->start->format('l jS \of F Y')
        );

        // stop; test date formats correctly
        $this->assertInstanceOf(Carbon::class, $licences->first()->stop);
        $this->assertEquals(
            'Sunday 11th of September 2022 11:59 PM',
            $licences->first()->stop->format('l jS \of F Y h:i A')
        );
    }

    public function test_a_licence_with_only_tool_id_can_be_created()
    {
        $tool = Tool::factory()->create();
        $this->authorisedUser();

        // add a licence and associate with the tool_id
        $response = $this->post('/dashboard/licences', [
            'tool_id' => $tool->id
        ]);
        $response->assertCreated();
        $this->assertCount(1, Licence::all());

        // force an error on the tool_id column; attempt to create a record with no data
        $response = $this->post('/dashboard/licences', []);
        $response->assertSessionHasErrors('tool_id');
    }

    public function test_a_licence_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();
        $tool = Tool::factory()->create();
        $cost_centre = CostCentre::factory()->create();

        $this->post('/dashboard/licences', [
            'tool_id' => $tool->id,
            'user_limit' => 5,
            'description' => 'Hello'
        ]);
        $licence = Licence::first();
        $this->assertEquals('Hello', $licence->description);

        $response = $this->patch('/dashboard/licences/' . $licence->id, [
            'tool_id' => $tool->id,
            'cost_centre_id' => $cost_centre->id,
            'description' => 'This description is now a great description',
            'user_limit' => 2000,
            'currency' => 'GBP',
            'cost_per_user' => 5.99,
            'start_day' => '12',
            'start_month' => '09',
            'start_year' => '2021',
            'stop_day' => '11',
            'stop_month' => '09',
            'stop_year' => '2022'
        ]);

        $licence = Licence::first();

        $this->assertEquals('This description is now a great description', $licence->description);
        $this->assertEquals(2000, $licence->user_limit);
        $this->assertEquals('GBP', $licence->currency);
        $this->assertEquals(5.99, $licence->cost_per_user);
        $this->assertInstanceOf(Carbon::class, $licence->start);
        $this->assertInstanceOf(Carbon::class, $licence->stop);
        $response->assertRedirect($licence->fresh()->path());
    }

    public function test_a_licence_description_cannot_be_boolean()
    {
        $tool = Tool::factory()->create();
        $this->authorisedUser();

        // description: boolean
        $response = $this->post('/dashboard/licences', [
            'tool_id' => $tool->id,
            'description' => false
        ]);
        $response->assertSessionHasErrors('description');
    }

    public function test_a_licence_description_cannot_be_an_integer()
    {
        $tool = Tool::factory()->create();
        $this->authorisedUser();

        // description: integer
        $response = $this->post('/dashboard/licences', [
            'tool_id' => $tool->id,
            'description' => 12345
        ]);
        $response->assertSessionHasErrors('description');
    }

    public function test_a_licence_currency_code_is_3_chars_max()
    {
        $tool = Tool::factory()->create();
        $this->authorisedUser();

        // description: integer
        $response = $this->post('/dashboard/licences', [
            'tool_id' => $tool->id,
            'currency' => 'GBPL'
        ]);
        $response->assertSessionHasErrors('currency');
    }

    public function test_a_licence_can_be_deleted()
    {
        $licence = Licence::factory()->create();
        $this->authorisedUser();

        $this->assertCount(1, Licence::all());

        $this->delete('/dashboard/licences/' . $licence->id);
        $this->assertCount(0, Licence::all());
    }

    public function test_a_licence_is_removed_if_tool_deleted()
    {
        $tool = Tool::factory()->create();
        $this->authorisedUser();

        $this->post('/dashboard/licences', [
            'tool_id' => $tool->id
        ]);
        $this->assertCount(1, Licence::all());

        $this->delete('/dashboard/tools/1');
        $this->assertCount(0, Licence::all());
    }

    public function test_a_licence_information_page_can_be_rendered()
    {
        $this->authorisedUser();

        $licence = Licence::factory()->create();
        $response = $this->get('dashboard/licences/' . $licence->id);
        $response->assertStatus(200);

        $this->assertArrayHasKey('description', $response['licence']);
    }

    public function test_a_licence_edit_page_can_be_rendered()
    {
        $this->authorisedUser();

        $licence = Licence::factory()->create();
        $response = $this->get('dashboard/licences/' . $licence->id . '/edit');
        $response->assertStatus(200);

        $this->assertArrayHasKey('description', $response['licence']);
    }

    public function test_a_licence_create_page_can_be_rendered()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $response = $this->get(route('licences-create', $tool->slug));
        $response->assertStatus(200);

        $this->assertArrayHasKey('id', $response['tool']);
    }

    public function test_licences_can_be_listed_on_a_tooling_route()
    {
        $this->authorisedUser();

        $licence = Licence::factory()->create();

        $response = $this->get('dashboard/tools/' . $licence->tool->slug . '/licences');
        $response->assertStatus(200);

        $this->assertArrayHasKey('licences', $response['tool']);
    }

    public function test_a_licence_create_user_limit_input_can_be_rendered()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $route = route('licences-create-part', [
            'slug' => $tool->slug,
            'part' => 'user_limit'
        ]);
        $response = $this->get($route);
        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response['tool']);
        $this->assertEquals(strstr($route, '/dashboard'), $tool->path() . '/licences/create/user_limit');
    }

    public function test_a_licence_create_start_input_can_be_rendered()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $route = route('licences-create-part', [
            'slug' => $tool->slug,
            'part' => 'start'
        ]);
        $response = $this->get($route);
        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response['tool']);
        $this->assertEquals(strstr($route, '/dashboard'), $tool->path() . '/licences/create/start');
    }

    public function test_a_licence_create_cost_centre_input_can_be_rendered()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $route = route('licences-create-part', [
            'slug' => $tool->slug,
            'part' => 'cost_centre'
        ]);
        $response = $this->get($route);
        $response->assertStatus(200);
        $this->assertArrayHasKey('id', $response['tool']);
        $this->assertEquals(strstr($route, '/dashboard'), $tool->path() . '/licences/create/cost_centre');
    }

    public function test_a_description_can_be_stored_in_a_session()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $response = $this->post(
            route('licences-store-session', ['part' => 'description']),
            [
                'tool_id' => $tool->id,
                'description' => 'My great description'
            ]
        );
        $response->assertSessionHas('licence');
        $response->assertRedirect($tool->path() . '/licences/create/user_limit');
    }
}
