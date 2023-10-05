<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $data = [
        'tooling' => ['count' => count(\App\Models\Tool::all())],
        'organisations' => ['count' => count(\App\Models\Organisation::all())],
        'licences' => ['count' => count(\App\Models\Licence::all())],
        'teams' => ['count' => count(\App\Models\Team::all())],
        'business-cases' => ['count' => count(\App\Models\BusinessCase::all())],
        'contacts' => ['count' => count(\App\Models\Contact::all())],
        'cost-centres' => ['count' => count(\App\Models\CostCentre::all())],
        'slack-settings' => ['count' => count(\App\Models\Slack::all())]
    ];
    return view('dashboard', ['data' => $data]);
})->middleware(['auth'])->name('dashboard');

// auth routes
require __DIR__ . '/auth.php';

// Organisations
$org_controller = 'App\Http\Controllers\OrganisationController@';
$org_base_path = 'dashboard/organisations';
Route::get($org_base_path, $org_controller . 'index')->name('organisations');
Route::post($org_base_path, $org_controller . 'store')->name('organisation-add');
Route::get($org_base_path . '/create', $org_controller . 'create')->name('organisations-create');
Route::get($org_base_path . '/{slug}/edit', $org_controller . 'edit')->name('organisations-edit');
Route::get($org_base_path . '/{slug}', $org_controller . 'show')->name('organisation');
Route::patch($org_base_path . '/{org}', $org_controller . 'update')->name('organisations-patch');
Route::delete($org_base_path . '/{contact}', $org_controller . 'destroy')->name('organisations-delete');

// Teams
$team_controller = 'App\Http\Controllers\TeamController@';
$team_base_path = 'dashboard/teams';
Route::get($team_base_path, $team_controller . 'index')->name('teams');
Route::post($team_base_path, $team_controller . 'store')->name('teams-add');
Route::get($team_base_path . '/create', $team_controller . 'create')->name('teams-create');
Route::get($team_base_path . '/{slug}/edit', $team_controller . 'edit')->name('teams-edit');
Route::get($team_base_path . '/{slug}', $team_controller . 'show')->name('team');
Route::patch($team_base_path . '/{team}', $team_controller . 'update')->name('teams-patch');
Route::delete($team_base_path . '/{contact}', $team_controller . 'destroy')->name('teams-delete');

// Contacts
$contact_controller = 'App\Http\Controllers\ContactController@';
$contact_base_path = 'dashboard/contacts';
Route::get($contact_base_path, $contact_controller . 'index')->name('contacts');
Route::post($contact_base_path, $contact_controller . 'store')->name('contacts-add');
Route::get($contact_base_path . '/create', $contact_controller . 'create')->name('contacts-create');
Route::get($contact_base_path . '/{slug}/edit', $contact_controller . 'edit')->name('contacts-edit');
Route::get($contact_base_path . '/{slug}', $contact_controller . 'show')->name('contact');
Route::patch($contact_base_path . '/{contact}', $contact_controller . 'update')->name('contacts-patch');
Route::delete($contact_base_path . '/{contact}', $contact_controller . 'destroy')->name('contacts-delete');

// Events
Route::resource('dashboard/events', EventController::class);
Route::post('dashboard/event/types', 'App\Http\Controllers\EventTypeController@store');
Route::post('dashboard/event/types/{type}/tag', 'App\Http\Controllers\EventTypeTagController@store');

// Tags
Route::resource('dashboard/tags', TagController::class);

// Slack Settings
$slack_controller = 'App\Http\Controllers\SlackController@';
$slack_base_path = 'dashboard/slack-notification-settings';
Route::get($slack_base_path, $slack_controller . 'index')->name('slack-settings');
Route::post($slack_base_path, $slack_controller . 'store')->name('slack-settings-add');
Route::get($slack_base_path . '/create', $slack_controller . 'create')->name('slack-settings-create');
Route::get($slack_base_path . '/{slug}/edit', $slack_controller . 'edit')->name('slack-settings-edit');
Route::get($slack_base_path . '/{slug}', $slack_controller . 'show')->name('slack-setting');
Route::patch($slack_base_path . '/{slack}', $slack_controller . 'update')->name('slack-settings-patch');
Route::delete($slack_base_path . '/{slack}', $slack_controller . 'destroy')->name('slack-settings-delete');

// Tools
$tool_controller = 'App\Http\Controllers\ToolController@';
$tool_base_path = 'dashboard/tools';
Route::get($tool_base_path, $tool_controller . 'index')->name('tools');
Route::post($tool_base_path, $tool_controller . 'storeSessionData')->name('tools-add');
Route::post($tool_base_path . '/contact', $tool_controller . 'storeContact')->name('tools-add-contact');
Route::post($tool_base_path . '/business-case', $tool_controller . 'storeBusinessCase')->name('tools-add-business-case');
Route::post($tool_base_path . '/store', $tool_controller . 'store')->name('tools-store');
Route::post($tool_base_path . '/search/{search}', $tool_controller . 'find')->name('tools-find');
Route::post($tool_base_path . '/{tool}/approve', $tool_controller . 'approve')->name('tools-approve');
Route::get($tool_base_path . '/create', $tool_controller . 'create')->name('tools-create');
Route::get($tool_base_path . '/create/contact', $tool_controller . 'createContact')->name('tools-create-contact');
Route::get($tool_base_path . '/create/business-case', $tool_controller . 'createBusinessCase')->name('tools-create-business-case');
Route::get($tool_base_path . '/create/summary', $tool_controller . 'viewSummary')->name('tools-view-summary');
Route::get($tool_base_path . '/{slug}', $tool_controller . 'show')->name('tool');
Route::patch($tool_base_path . '/{tool}', $tool_controller . 'update')->name('tools-patch');
Route::delete($tool_base_path . '/{tool}', $tool_controller . 'destroy')->name('tools-delete');

Route::post($tool_base_path . '/{tool}/tag', 'App\Http\Controllers\TagToolController@store');
Route::post($tool_base_path . '/{tool}/event', 'App\Http\Controllers\EventController@store');

// Licences
$licence_controller = 'App\Http\Controllers\LicenceController@';
$licence_base_path = 'dashboard/licences';
Route::get($licence_base_path, $licence_controller . 'index')->name('licences');
Route::post($licence_base_path, $licence_controller . 'store')->name('licences-add');
Route::post($licence_base_path . '/create/{part}', $licence_controller . 'session')->name('licences-store-session');
Route::get($licence_base_path . '/{licence}/edit', $licence_controller . 'edit')->name('licences-edit');
Route::get($licence_base_path . '/{licence}', $licence_controller . 'show')->name('licence');
Route::patch($licence_base_path . '/{licence}', $licence_controller . 'update')->name('licences-patch');
Route::delete($licence_base_path . '/{licence}', $licence_controller . 'destroy')->name('licences-delete');

// bind licences to tooling routes
Route::get($tool_base_path . '/{slug}/licences', $licence_controller . 'indexToolLicences')->name('licences-tools');
Route::post($tool_base_path . '/{slug}/licences', $licence_controller . 'storeFromSession')->name('licences-session-store');
Route::get($tool_base_path . '/{slug}/licences/create', $licence_controller . 'create')->name('licences-create');
Route::get($tool_base_path . '/{slug}/licences/create/{part}', $licence_controller . 'create')->name('licences-create-part');


// Business Cases
$bcase_controller = 'App\Http\Controllers\BusinessCaseController@';
$bcase_base_path = 'dashboard/business-cases';
Route::get($bcase_base_path, $bcase_controller . 'index')->name('business-cases');
Route::post($bcase_base_path, $bcase_controller . 'store')->name('business-cases-add');
Route::post($bcase_base_path . '/{id}/clone', $bcase_controller . 'clone')->name('business-cases-clone');
Route::get($bcase_base_path . '/{slug}/edit', $bcase_controller . 'edit')->name('business-cases-edit');
Route::get($bcase_base_path . '/{slug}', $bcase_controller . 'show')->name('business-case');
Route::patch($bcase_base_path . '/{case}', $bcase_controller . 'update')->name('business-cases-patch');
Route::delete($bcase_base_path . '/{case}', $bcase_controller . 'destroy')->name('business-cases-delete');

$tool_base_path .= '/{slug}/business-cases';
// bind business cases to tooling routes
Route::get($tool_base_path, $bcase_controller . 'indexToolBusinessCases')->name('business-cases-tools');
Route::post($tool_base_path , $bcase_controller . 'storeFromSession')->name('business-cases-session-store');
Route::get($tool_base_path . '/create', $bcase_controller . 'create')->name('business-cases-create');
Route::get($tool_base_path . '/create/{part}', $bcase_controller . 'create')->name('business-cases-create-part');


// cost centres
$cost_centre_controller = 'App\Http\Controllers\CostCentreController@';
$cost_centre_base_path = 'dashboard/cost-centres';
Route::get($cost_centre_base_path, $cost_centre_controller . 'index')->name('cost-centres');
Route::post($cost_centre_base_path, $cost_centre_controller . 'store')->name('cost-centres-add');
Route::get($cost_centre_base_path . '/create', $cost_centre_controller . 'create')->name('cost-centres-create');
Route::get($cost_centre_base_path . '/{slug}', $cost_centre_controller . 'show')->name('cost-centre');
Route::patch($cost_centre_base_path . '/{cost_centre}', $cost_centre_controller . 'update')->name('cost-centres-patch');
Route::delete($cost_centre_base_path . '/{cost_centre}', $cost_centre_controller . 'destroy')->name('cost-centres-delete');
Route::get($cost_centre_base_path . '/{slug}/edit', $cost_centre_controller . 'edit')->name('cost-centres-edit');

