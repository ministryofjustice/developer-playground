<?php

namespace Tests\Feature\Auth;

use App\Models\Organisation;
use App\Models\Team;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_org_and_team_select_form_can_be_rendered()
    {
        $response = $this->get('/create-an-account');
        $response->assertStatus(200);
    }

    public function test_registration_screen_redirects_without_session()
    {
        $response = $this->get('/create-an-account/register');
        $response->assertStatus(302);
        $response->assertRedirect('/create-an-account');
    }

    public function test_the_org_team_session_var_is_saved()
    {
        $this->withoutExceptionHandling();

        $organisation = Organisation::factory()->create();
        $team = Team::factory()->create();

        $response = $this->post('/create-an-account/org-team', [
            'organisation' => $organisation->id,
            'team' => $team->id
        ]);

        $response->assertRedirect('/create-an-account/register');
    }

    public function test_registration_screen_can_be_rendered()
    {
        Organisation::factory()->create();
        Team::factory()->create();

        $response = $this->withSession(['org-team' => [
            'organisation' => 1,
            'team' => 1
        ]])->get('/create-an-account/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->withSession(['org-team' => [
            'team' => 1
        ]])->post('/create-an-account/register', [
            'name' => 'Test User',
            'email' => 'test@justice.gov.uk',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_cannot_register_without_justice_email()
    {
        $response = $this->withSession(['org-team' => [
            'organisation' => 1,
            'team' => 1,
        ]])->post('/create-an-account/register', [
            'name' => 'Test User',
            'email' => 'test@non-justice.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_request_team_addition_page_can_render()
    {
        $response = $this->get('/request-team-addition');
        $response->assertStatus(200);
    }

    public function test_request_team_addition_is_success()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/request-team-addition', [
            'name' => 'My name',
            'email' => 'my-email@justice.gov.uk',
            'team' => 'My great team',
            'organisation' => 1
        ]);

        $response->assertRedirect('your-team-addition-request-has-been-sent');
    }

    public function test_your_request_has_been_sent_page_renders()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('your-team-addition-request-has-been-sent');
        $response->assertStatus(200);
    }
}
