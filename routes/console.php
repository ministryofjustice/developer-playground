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
    $this->newLine();
    $this->warn("***|");
    $this->warn("***|  You should restart your docker application after setup");
    $this->warn("***|  Exit this shell and run\e[0m make restart");
    $this->warn("***|");
    $this->warn("***|  Your application is available here:");
    $this->warn("***|");
    $this->warn("***|   \e[0m http://127.0.0.1:8000");
    $this->warn("***|");
    $this->warn("***|  Access the DB management utility here:");
    $this->warn("***|");
    $this->warn("***|   \e[0m http://127.0.0.1:9191");
    $this->warn("***|");
    $this->newLine(2);
});
