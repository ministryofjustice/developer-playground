<?php

namespace Tests\Unit;

use App\Console\Commands\SystemHealthCheck;
use App\Models\Licence;
use App\Models\Tool;
use App\Notifications\LicenceHasCloseExpiryDate;
use App\Notifications\LicenceHasExpired;
use App\Notifications\NoToolingContactDefined;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Tests\WithAuthUser;

class HealthStatusTest extends TestCase
{
    use WithAuthUser, RefreshDatabase;

    public function test_alert_if_tool_has_no_contact_assigned()
    {
        Notification::fake();
        Notification::assertNothingSent();

        // create a tool with no contact
        Tool::factory()->create(['contact_id' => null]);

        // run the health-check command and assert it fails; exit code 1
        $this->artisan('command:system-health-check')->assertExitCode(1);

        // assert a notification was sent via NoToolingContactDefined
        Notification::assertSentTo(
            new SystemHealthCheck, NoToolingContactDefined::class
        );
    }

    public function test_alert_if_active_licence_has_expired_date()
    {
        Notification::fake();
        Notification::assertNothingSent();

        // create a licence with a stop date in the past
        Licence::factory()->create(['stop' => '2021-11-11 00:00:00']);

        // run the health-check command and assert it fails; exit code 1
        $this->artisan('command:system-health-check')->assertExitCode(1);

        // assert a notification was sent via LicenceHasExpired
        Notification::assertSentTo(
            new SystemHealthCheck, LicenceHasExpired::class
        );
    }

    public function test_alert_if_active_licence_has_close_approaching_expiry_date()
    {
        Notification::fake();
        Notification::assertNothingSent();

        $date = Carbon::now();

        // create a licence with a stop date inside the alert window; 90 days or less
        Licence::factory()->create(['stop' => $date->days(89)->format('Y-m-d 00:00:00')]);
        // run the health-check command and assert it fails; exit code 1
        $this->artisan('command:system-health-check')->assertExitCode(1);

        // assert a notification was sent via LicenceHasCloseExpiryDate
        Notification::assertSentTo(
            new SystemHealthCheck, LicenceHasCloseExpiryDate::class
        );
    }

    public function test_no_notification_sent_if_active_licence_is_stable()
    {
        Notification::fake();
        Notification::assertNothingSent();

        $date = Carbon::now();

        // create a licence with a stop date outside the alert window; 90 days or more
        Licence::factory()->create(['stop' => $date->days(100)->format('Y-m-d 00:00:00')]);
        // run the health-check command and assert it succeeds; exit code 0
        $this->artisan('command:system-health-check')->assertExitCode(0);

        // assert a notification was sent via LicenceHasCloseExpiryDate
        Notification::assertNotSentTo(
            new SystemHealthCheck, LicenceHasCloseExpiryDate::class
        );
    }
}
