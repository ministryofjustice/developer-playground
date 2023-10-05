<?php

namespace Tests\Feature;

use App\Models\Organisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\WithAuthUser;

class OrganisationManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_the_new_organisation_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        // authentication needed
        $this->authorisedUser();

        $response = $this->get('/dashboard/organisations/create');
        $response->assertStatus(200);
    }

    public function test_an_organisation_can_be_created()
    {
        // authentication needed
        $this->authorisedUser();

        $response = $this->post('/dashboard/organisations', [
            'name' => 'Ministry of Justice HQ',
            'address' => '102 Petty France, London SW1H 9AJ'
        ]);
        $response->assertRedirect('/dashboard/organisations');

        $this->assertCount('1', Organisation::all());
    }

    public function test_organisations_can_be_listed()
    {
        $this->withoutExceptionHandling();

        // authentication needed
        $this->authorisedUser();

        $response = $this->get('/dashboard/organisations');
        $response->assertStatus(200);
    }

    public function test_organisation_can_be_updated()
    {
        $this->authorisedUser();

        $organisation = Organisation::factory()->create();
        $response = $this->patch('/dashboard/organisations/' . $organisation->id, [
            'name' => 'My New Org Name',
            'address' => 'Great Road, London',
            'description' => $organisation->description
        ]);

        $organisation_patched = Organisation::first();
        $this->assertEquals('My New Org Name', $organisation_patched->name);
        $this->assertEquals('Great Road, London', $organisation_patched->address);
        $response->assertRedirect($organisation_patched->fresh()->path());
    }

    public function test_organisation_edit_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        $this->authorisedUser();
        $organisation = Organisation::factory()->create();
        $response = $this->get('/dashboard/organisations/' . $organisation->slug . '/edit');
        $response->assertStatus(200);
    }

    public function test_single_organisation_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        $this->authorisedUser();
        $org = Organisation::factory()->create();
        $response = $this->get('/dashboard/organisations/' . $org->slug);
        $response->assertStatus(200);
    }
}
