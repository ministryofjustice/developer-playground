<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('notify:restart', function () {
    $pre = '***|';
    $this->newLine();
    $this->warn($pre);
    $this->warn("$pre  \e[0m The application will be restarted to load a newly created APP_KEY environment variable.");
    $this->warn("$pre  \e[0m This is a onetime setup action. Stand by.");
    $this->warn($pre);
    $this->warn("$pre  The application URL:");
    $this->warn($pre);
    $this->warn("$pre   \e[0m http://127.0.0.1:8000");
    $this->warn($pre);
    $this->comment("$pre  Once our Node container is online, asset compilation will take place.");
    $this->comment("$pre  Styling will be available shortly after.");
    $this->warn($pre);
    $this->warn("$pre  Access the DB management utility here:");
    $this->warn($pre);
    $this->warn("$pre   \e[0m http://127.0.0.1:9191");
    $this->warn($pre);
    $this->newLine(2);
});
