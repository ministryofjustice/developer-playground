<?php

namespace Tests\Feature;

use App\Models\Slack;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\WithAuthUser;
use Tests\TestCase;

class SlackSettingsManagementTest extends TestCase
{
    use RefreshDatabase, WithAuthUser;

    private string $feature_path = 'dashboard/slack-notification-settings';

    public function test_a_slack_webhook_url_can_be_added()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $url = 'https://slack.webhook.example.com/37468392092';

        $response = $this->post($this->feature_path, [
            'webhook_url' => $url,
            'name' => 'default',
            'channel' => '#channel'
        ]);

        $slack = Slack::first();
        $response->assertRedirect($slack->path());
        $this->assertEquals($url, $slack->webhook_url);
    }

    public function test_a_webhook_url_can_be_updated()
    {
        $this->authorisedUser();

        $slack = Slack::factory()->create();
        $this->assertCount(1, Slack::all());

        $patch_name = 'central digital';
        $patch_webhook = 'https://updated-slack.webhook.example.com/37468392092';
        $response = $this->patch($this->feature_path . '/' . $slack->id, [
            'name' => $patch_name,
            'webhook_url' => $patch_webhook,
            'channel' => '#channel'
        ]);

        $slack = Slack::first();
        $this->assertEquals($patch_name, $slack->name);
        $this->assertEquals($patch_webhook, $slack->webhook_url);

        $response->assertRedirect($slack->path());
    }

    public function test_a_webhook_url_can_be_removed()
    {
        $this->authorisedUser();

        $response = $this->delete(
            $this->feature_path . '/' . Slack::factory()->create()->id
        );
        $response->assertRedirect($this->feature_path);

        $this->assertCount(0, Slack::all());
    }

    public function test_a_webhook_url_create_form_can_be_rendered()
    {
        $this->authorisedUser();

        $response = $this->get($this->feature_path . '/create');
        $response->assertStatus(200);
    }

    public function test_a_webhook_url_can_be_viewed()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $slack = Slack::factory()->create();
        $this->assertCount(1, Slack::all());
        $this->assertEquals($slack->slug, Slack::first()->slug);

        $response = $this->get($this->feature_path . '/' . $slack->slug);
        $response->assertStatus(200);

        // check data response
        $this->assertArrayHasKey('webhook_url', $response['setting']);
    }

    public function test_a_webhook_url_edit_form_can_be_rendered()
    {
        $this->withoutExceptionHandling();
        $this->authorisedUser();

        $slack = Slack::factory()->create();
        $response = $this->get($this->feature_path . '/' . $slack->slug . '/edit');
        $response->assertStatus(200);

        // check data response
        $this->assertArrayHasKey('webhook_url', $response['settings']);
    }
}
