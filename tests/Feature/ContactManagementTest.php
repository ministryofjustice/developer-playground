<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class ContactManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    public function test_a_contact_can_be_added()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->post('dashboard/contacts', [
            'name' => 'New tooling contact',
            'email' => 'tooling.contact@justice.gov.uk',
            'slack' => 'MYSL4C3ID'
        ]);

        $response->assertCreated();
        $this->assertCount(1, Contact::all());
    }

    public function test_contacts_can_be_listed()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->get('/dashboard/contacts');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_a_contact_cannot_be_added_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $response = $this->post('dashboard/contacts', [
            'name' => 'New tooling contact',
            'email' => 'tooling.contact@justice.gov.uk'
        ]);
        $response->assertForbidden();
    }

    public function test_a_contact_can_be_updated()
    {
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $this->assertCount(1, Contact::all());

        $patch_name = 'James McNally';
        $patch_email = 'tooling.contact@justice.gov.uk';
        $patch_slack = 'AN0T83RID';
        $response = $this->patch('dashboard/contacts/' . $contact->id, [
            'name' => $patch_name,
            'email' => $patch_email,
            'slack' => $patch_slack
        ]);

        $contact = Contact::first();
        $this->assertEquals($patch_name, $contact->name);
        $this->assertEquals($patch_email, $contact->email);
        $this->assertEquals($patch_slack, $contact->slack);

        $response->assertRedirect($contact->path());
    }

    /**
     * This particular test focuses on the ability to update a record using
     * both old data and new data. For instance; we leave the name and slack as
     * they were but change the email address, thus mimicking behaviour in the app.
     */
    public function test_a_contact_email_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $this->assertCount(1, Contact::all());

        $patch_email = 'tooling.contact@justice.gov.uk';
        $response = $this->patch('dashboard/contacts/' . $contact->id, [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $patch_email,
            'slack' => $contact->slack
        ]);

        $contact = Contact::first();
        $this->assertEquals($patch_email, $contact->email);

        $response->assertRedirect($contact->path());
    }

    public function test_a_contact_can_be_removed()
    {
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $response = $this->delete('dashboard/contacts/' . $contact->id);
        $response->assertRedirect('dashboard/contacts');

        $this->assertCount(0, Contact::all());
    }

    public function test_a_contact_create_form_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get('/dashboard/contacts/create');
        $response->assertStatus(200);
    }

    public function test_a_contact_can_be_viewed()
    {
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $this->assertCount(1, Contact::all());
        $this->assertEquals($contact->slug, Contact::first()->slug);

        $response = $this->get('/dashboard/contacts/' . $contact->slug);
        $response->assertStatus(200);
    }

    public function test_a_contact_edit_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $contact = Contact::factory()->create();
        $response = $this->get('dashboard/contacts/' . $contact->slug . '/edit');
        $response->assertStatus(200);
    }
}
