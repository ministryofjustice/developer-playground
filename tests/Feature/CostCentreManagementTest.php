<?php

namespace Tests\Feature;

use App\Models\CostCentre;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class CostCentreManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_cost_centres_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        CostCentre::factory()->create();
        CostCentre::factory()->create();
        $this->assertCount(2, CostCentre::all());

        $response = $this->get(route('cost-centres'));
        $response->assertStatus(200);

        // check response data exists and contains only the records we
        // created above with factory
        $this->assertArrayHasKey('0', $response['cost_centres']);
        $this->assertArrayHasKey('1', $response['cost_centres']);
        $this->assertArrayNotHasKey('2', $response['cost_centres']);
    }

    public function test_no_unauthorised_access_to_cost_centre_crud()
    {
        $this->withoutExceptionHandling();

        CostCentre::factory()->create();
        $this->assertCount(1, CostCentre::all());

        $this->expectException(AuthenticationException::class);
        $response = $this->get(route('cost-centres'));
        $response->assertForbidden();
    }

    public function test_a_cost_centre_can_be_created()
    {
        $this->authorisedUser();

        $response = $this->post(route('cost-centres-add'), [
            'name' => 'My Cost Centre',
            'number' => '10044567'
        ]);
        $cost_centre = CostCentre::first();
        $response->assertRedirect(route('cost-centre', $cost_centre->slug));
        $this->assertEquals('10044567', $cost_centre->number);
    }

    public function test_a_cost_centre_can_be_updated()
    {
        $this->authorisedUser();

        $cost_centre = CostCentre::factory()->create();

        $name = 'My New Cost Centre Name';
        $number = '9876543210';
        $response = $this->patch(route('cost-centres-patch', $cost_centre->id), [
            'name' => $name,
            'number' => $number
        ]);

        $cost_centre->refresh();
        $response->assertRedirect(route('cost-centre', $cost_centre->slug));
        $this->assertEquals($name, $cost_centre->name);
        $this->assertEquals($number, $cost_centre->number);
    }

    public function test_a_cost_centre_can_be_deleted()
    {
        $this->authorisedUser();

        $cost_centre = CostCentre::factory()->create();
        $response = $this->delete(route('cost-centres-delete', $cost_centre->id));
        $response->assertRedirect(route('cost-centres'));

        $this->assertCount(0, CostCentre::all());
    }

    public function test_a_cost_centre_can_be_viewed()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $cost_centre = CostCentre::factory()->create();
        $this->assertCount(1, CostCentre::all());
        $this->assertEquals($cost_centre->slug, CostCentre::first()->slug);

        $response = $this->get(route('cost-centre', $cost_centre->slug));
        $response->assertStatus(200);
    }

    public function test_a_cost_centre_create_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->get(route('cost-centres-create'));
        $response->assertStatus(200);
    }

    public function test_a_cost_centre_edit_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $contact = CostCentre::factory()->create();
        $response = $this->get('dashboard/cost-centres/' . $contact->slug . '/edit');
        $response->assertStatus(200);
    }
}
