<?php

namespace Tests\Unit;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithAuthUser;

class ScheduleTest extends TestCase
{
    use WithAuthUser, RefreshDatabase;

    public function test_system_health_check_is_scheduled()
    {
        $schedule_name = 'system-health-check';
        $schedule_time = '0 7 * * 1-5'; // 7am every morning, Monday to Friday

        $schedule = app()->make(Schedule::class);

        $events = collect($schedule->events())->filter(function (Event $event) use ($schedule_name) {
            return stripos($event->command, $schedule_name);
        });

        if ($events->count() === 0) {
            $this->fail('The schedule for "' . $schedule_name . '" was not found.');
        }

        $events->each(function (Event $event) use ($schedule_time) {
            $this->assertEquals($schedule_time, $event->expression);
        });
    }
}
