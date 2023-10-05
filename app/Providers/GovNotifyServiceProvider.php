<?php

namespace App\Providers;

use Alphagov\Notifications\Client;
use Illuminate\Support\ServiceProvider;

class GovNotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->app->singleton(Client::class, function () {
            return new Client([
                'apiKey' => config('ck.gov_notify_api_key'),
                'httpClient' => new \Http\Adapter\Guzzle7\Client(),
            ]);
        });
    }

    /**
     * Register services.
     */
    public function register()
    {
        //
    }
}
