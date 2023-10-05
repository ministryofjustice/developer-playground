<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\TagTool;
use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\WithAuthUser;

class TagManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    /** @test */
    public function a_tag_can_be_created()
    {
        $response = $this->post('/dashboard/tags', [
            'name' => 'my tag'
        ]);

        $response->assertCreated();
        $this->assertCount(1, Tag::all());
    }

    /** @test */
    public function tag_name_must_not_be_blank()
    {
        $response = $this->post('/dashboard/tags', [
            'name' => ''
        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_must_be_unique()
    {
        $unique_one = $this->post('/dashboard/tags', [
            'name' => 'non-unique tag'
        ]);
        $unique_one->assertCreated();

        $unique_two = $this->post('/dashboard/tags', [
            'name' => 'non-unique tag'
        ]);
        $unique_two->assertSessionHasErrors('name');
    }

    /** @test */
    public function tag_name_must_not_exceed_80_chars()
    {
        $response = $this->post('/dashboard/tags', [
            'name' => Str::random(81)
        ]);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function tags_are_removed_if_tool_is_deleted()
    {
        $this->post('/dashboard/tags', ['name' => 'my tag']);
        $this->post('/dashboard/tags', ['name' => 'another tag']);
        $this->post('/dashboard/tags', ['name' => 'yet another tag']);
        $this->post('/dashboard/tags', ['name' => 'another tag for tool 2']);

        $this->assertCount(4, Tag::all());

        $this->authorisedUser();
        $tools = Tool::factory()->count(2)->create();

        // resolve ids
        $tool_1_id = $tools->find(1)->id;
        $tool_2_id = $tools->find(2)->id;

        // attach tags to tool 1
        $this->post('/dashboard/tools/' . $tool_1_id . '/tag', ['tag_id' => 1]);
        $this->post('/dashboard/tools/' . $tool_1_id . '/tag', ['tag_id' => 2]);
        // attach tags to tool 2
        $this->post('/dashboard/tools/' . $tool_2_id . '/tag', ['tag_id' => 1]);
        $this->post('/dashboard/tools/' . $tool_2_id . '/tag', ['tag_id' => 2]);
        $this->post('/dashboard/tools/' . $tool_2_id . '/tag', ['tag_id' => 3]);
        $this->post('/dashboard/tools/' . $tool_2_id . '/tag', ['tag_id' => 4]);

        $this->assertCount(6, TagTool::all());

        $this->delete('/dashboard/tools/' . $tool_1_id);
        $this->assertCount(4, TagTool::all());

        $this->delete('/dashboard/tools/' . $tool_2_id);
        $this->assertCount(0, TagTool::all());

        // tags still exist
        $this->assertCount(4, Tag::all());
    }
}
