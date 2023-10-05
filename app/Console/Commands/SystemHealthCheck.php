<?php

namespace App\Console\Commands;

use App\Models\Licence;
use App\Models\Slack;
use App\Models\Tool;
use App\Notifications\LicenceHasCloseExpiryDate;
use App\Notifications\LicenceHasExpired;
use App\Notifications\NoToolingContactDefined;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SystemHealthCheck extends Command
{
    use Notifiable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:system-health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param Notification $notification
     * @return string
     */
    public function routeNotificationForSlack($notification): string
    {
        return Slack::where('name', 'LIKE', 'default')->first()->webhook_url;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $results = [
            'tools-no-contact' => $this->toolsHaveNoContactAssigned(), // returns false if all contacts present
            'licences-expired' => $this->licenceHasExpired(), // returns false if all licences are in date
            'licences-close-to-expire' => $this->licenceHasCloseExpiryDate(), // returns false if all licences are in date
        ];

        $results = array_filter($results);

        if (!empty($results)) {
            // send message to slack
            if ($results['tools-no-contact'] ?? null) {
                $this->notify(new NoToolingContactDefined($results['tools-no-contact']));
            }

            if ($results['licences-expired'] ?? null) {
                $this->notify(new LicenceHasExpired($results['licences-expired']));
            }

            if ($results['licences-close-to-expire'] ?? null) {
                $this->notify(new LicenceHasCloseExpiryDate($results['licences-close-to-expire']));
            }

            return CommandAlias::FAILURE;
        }

        return CommandAlias::SUCCESS;
    }

    /**
     * @return false|object
     */
    protected function toolsHaveNoContactAssigned()
    {
        $tools = Tool::where('contact_id', '=', NULL)->get();

        if (count($tools) > 0) {
            return $tools;
        }

        return false;
    }

    /**
     * @return false|object
     */
    protected function licenceHasExpired()
    {

        $licences = Licence::where('stop', '<', Carbon::now())->get();

        if (count($licences) > 0) {
            return $licences;
        }

        return false;
    }

    /**
     * @return false|object
     */
    protected function licenceHasCloseExpiryDate()
    {
        $now = Carbon::now();
        $today = $now->format('Y-m-d 00:00:00');
        $ninety_days = $now->days(90)->format('Y-m-d 00:00:00');

        $licences = Licence::whereBetween('stop', [$today, $ninety_days])->get();

        if (count($licences) > 0) {
            return $licences;
        }

        return false;
    }

    public function getKey()
    {
        return null;
    }
}
