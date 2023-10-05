<?php

namespace Tests\Feature;

use App\Models\BusinessCase;
use App\Models\Contact;
use App\Models\Tag;
use App\Models\TagTool;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tool;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\WithAuthUser;

class ToolingManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    /** @test */
    public function a_new_tool_form_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->withSession(['tooling-data' => []])->get('/dashboard/tools/create');
        $response->assertStatus(200);
    }

    /** @test */
    public function existing_tools_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get('/dashboard/tools');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_tool_can_be_added_to_the_tpc()
    {
        $this->authorisedUser();

        $response = $this->post('/dashboard/tools', [
            'name' => 'My cool tool',
            'description' => 'A wonderful description to enlighten the reader.',
            'link' => 'https:/example.com/remote-management-admin'
        ]);

        $response->assertSessionHas('tooling');
        $response->assertRedirect('/dashboard/tools/create/contact');
    }

    /** @test */
    public function tool_data_must_not_be_blank()
    {
        $this->authorisedUser();

        $response = $this->post('/dashboard/tools', [
            'name' => '',
            'description' => '',
            'link' => 'https:/example.com/remote-management-admin',
            'contact_id' => "1"
        ]);

        $response->assertSessionHasErrors(['name', 'description']);
    }

    /** @test */
    public function a_tool_can_be_updated()
    {
        $this->authorisedUser();

        Tool::factory()->create();

        $response = $this->patch('/dashboard/tools/1', [
            'name' => 'Even cooler tool',
            'description' => 'So boom!',
            'link' => 'https:/tool.com/login'
        ]);

        $tool = Tool::first();

        $this->assertEquals('Even cooler tool', $tool->name);
        $this->assertEquals('So boom!', $tool->description);
        $this->assertEquals('https:/tool.com/login', $tool->link);
        $response->assertRedirect($tool->fresh()->path());
    }

    /** @test */
    public function a_tool_can_be_deleted()
    {
        Tool::factory()->create();
        $this->assertCount(1, Tool::all());

        $this->authorisedUser();
        $response = $this->delete('/dashboard/tools/1');

        $this->assertCount(0, Tool::all());
        $response->assertRedirect('/dashboard/tools');
    }

    /** @test */
    public function a_tool_cannot_be_deleted_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        Tool::factory()->create();
        $this->assertCount(1, Tool::all());

        $this->expectException(AuthenticationException::class);
        $response = $this->delete('/dashboard/tools/1');
        $response->assertForbidden();
    }

    /** @test */
    public function a_tag_can_be_added_to_a_tool()
    {
        $this->post('/dashboard/tags', [
            'name' => 'my tag'
        ]);

        $this->post('/dashboard/tags', [
            'name' => 'another tag'
        ]);

        $this->assertCount(2, Tag::all());

        $tag_1 = Tag::where('name', 'my tag')->first();
        $tag_2 = Tag::where('name', 'another tag')->first();

        $this->assertEquals(1, $tag_1->id);
        $this->assertEquals(2, $tag_2->id);

        $tool = Tool::factory()->create();

        $tag_tool_1 = $this->post('/dashboard/tools/' . $tool->id . '/tag', [
            'tag_id' => $tag_1->id
        ]);
        $tag_tool_1->assertCreated();

        $tag_tool_2 = $this->post('/dashboard/tools/' . $tool->id . '/tag', [
            'tag_id' => $tag_2->id
        ]);
        $tag_tool_2->assertCreated();

        // assert tools tags
        $tags = Tool::first()->tags();
        $this->assertCount(2, TagTool::all());
        $this->assertCount(2, $tags->get());
        $this->assertEquals('another tag', $tags->find(2)->name);
    }

    /** @test */
    public function a_tool_can_be_displayed()
    {
        $this->authorisedUser();
        $tool = Tool::factory()->create();

        $response = $this->get($tool->path());
        $response->assertStatus(200);
    }

    /** @test */
    public function a_tool_can_be_found_using_tool_search()
    {
        $this->authorisedUser();

        $tool = Tool::factory()->create();
        $search = $tool->slug;
        $response = $this->post('/dashboard/tools/search/' . substr($search, 0, 4) . '/');
        $results = $response->getData()->results;

        $this->assertCount(1, $results);
        $this->assertEquals($tool->name, $results[0]->name);
    }

    /** @test */
    public function a_tool_cannot_be_searched_by_unknown_user()
    {
        $this->withoutExceptionHandling();

        $tool = Tool::factory()->create();

        $this->expectException(AuthenticationException::class);

        $search = $tool->slug;
        $response = $this->post('/dashboard/tools/search/' . substr($search, 0, 4) . '/');
        $response->assertForbidden();
    }

    public function test_a_tool_contact_add_screen_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get('/dashboard/tools/create/contact');
        $response->assertStatus(200);
    }

    public function test_a_tooling_contact_can_be_added()
    {
        $this->authorisedUser();

        $response = $this->post('dashboard/tools/contact', [
            'name' => 'Tooling Contact',
            'email' => 'tooling.contact@justice.gov.uk',
            'slack' => 'BL4HBL4H'
        ]);

        $response->assertSessionHas('contact');
        $response->assertRedirect(route('tools-create-business-case'));
    }

    public function test_a_tooling_contact_can_be_skipped()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->post('dashboard/tools/contact', [
            'skip_contact' => 'yes'
        ]);

        $response->assertSessionMissing('contact');
        $response->assertRedirect(route('tools-create-business-case'));
    }

    public function test_a_tool_business_case_add_screen_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get(route('tools-create-business-case'));
        $response->assertStatus(200);
    }

    public function test_a_tooling_business_case_can_be_added()
    {
        $this->authorisedUser();

        $response = $this->post('dashboard/tools/business-case', [
            'business-case' => 'yes',
            'name' => 'My compelling case title',
            'text' => 'A massive amount of text'
        ]);

        $response->assertSessionHas('business-case');
        $response->assertRedirect(route('tools-view-summary'));
    }


    public function test_a_tooling_business_case_can_be_skipped()
    {
        $this->authorisedUser();

        $response = $this->post('dashboard/tools/business-case', [
            'business-case' => 'no'
        ]);

        $response->assertSessionMissing('business-case');
        $response->assertRedirect(route('tools-view-summary'));
    }

    public function test_a_tool_summary_screen_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $response = $this->get(route('tools-view-summary'));
        $response->assertStatus(200);
    }

    public function test_a_tool_can_be_approved()
    {
        $this->authorisedUser();
        $tool = Tool::factory()->create();
        $this->post('dashboard/tools/' . $tool->id . '/approve', [
            'approved' => true
        ]);

        $tool = Tool::first();
        $this->assertEquals(1, $tool->approved);
    }

    public function test_a_tool_can_be_unapproved()
    {
        $this->authorisedUser();
        $tool = Tool::factory()->create();
        $this->post('dashboard/tools/' . $tool->id . '/approve', [
            'approved' => false
        ]);

        $tool = Tool::first();
        $this->assertEquals(0, $tool->approved);
    }

    public function test_a_tool_can_be_added_with_auth_user_as_contact()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->be($user);

        $response = $this->withSession(['tooling'=> [
            'name' => 'My fab tool',
            'slug' => Str::slug('My fab tool'),
            'description' => 'An equally cool description',
            'link' => 'https:/example.com/remote-management-admin'
        ]])->post(route('tools-store'));

        $tool = Tool::first();
        $contact = Contact::first();

        $response->assertRedirect($tool->path());
        $this->assertEquals($user->email, $contact->email);
        $this->assertEquals($tool->contact_id, $contact->id);
    }
}
