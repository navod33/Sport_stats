<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

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

// If there's a DEV_BROWSERSYNC_URL given, use it for the URLs
// this will help to generate consistent URLs with BrowserSync
// * Don't use this on a production environment
// * Don't uncomment unless you understand what this will do
// if (app()->environment('local')) {
//    $domainRoot = env('DEV_BROWSERSYNC_URL', '');
//    if ($domainRoot !== '') \Illuminate\Support\Facades\URL::forceRootUrl($domainRoot);
// }

// Start Oxygen routes

// Home
Route::get('/', function () {
	return view('oxygen::pages.welcome', ['pageTitle' => 'The Awesomeness Starts Here...']);
})->name('home');

// Filler Pages...
Route::get('/privacy-policy', 'Common\PagesController@privacyPolicy')->name('pages.privacy-policy');
Route::get('/terms-conditions', 'Common\PagesController@termsConditions')->name('pages.terms-conditions');
Route::get('/faqs', 'Common\PagesController@faqs')->name('pages.faqs');

// Contact Us...
Route::get('/contact-us', 'Common\PagesController@contactUs')->name('contact-us');
//Route::get('/team-performance/{team_id}', 'SharePDFController@team');
//Route::get('/player-performance/{team_id}/{player_id}', 'SharePDFController@player');

// Add Other Custom Pages Here...
Route::post('/contact-us', 'Common\PagesController@postContactUs');

Route::group(['middleware' => config('fortify.middleware', ['web'])], function () {
	// Email Verification...
	if (Features::enabled(Features::emailVerification())) {
		Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
			->middleware(['auth'])
			->name('verification.notice');

		Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
			->middleware(['auth', 'signed', 'throttle:6,1'])
			->name('verification.verify');

		Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
			->middleware(['auth', 'throttle:6,1'])
			->name('verification.send');
	}
});

// The middleware order must be web, auth -> if you reverse this order, logins will fail
Route::group(
	[
		'middleware' => ['web'],
		'namespace' => '\\App\\Http\\Controllers'],
	function () {

		/*
		 |-----------------------------------------------------------
		 | Public Routes
		 |-----------------------------------------------------------
		 */
		Route::get('logout', '\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy')
			->name('logout');

		// Route for File Access
		Route::get('files/{uuid}/{fileName?}', 'Manage\ManageFilesController@publicView')->name('files.show');

		// Registration Routes...
		if (has_feature('auth.public_users_can_register')) {
			Route::get('/register', [RegisteredUserController::class, 'create'])
				->middleware(['guest'])
				->name('register');
			// Route::get( 'register', 'Auth\RegisteredUserController@showRegistrationForm')->name('register');
		}

		// Register by Invitation...
		Route::get('invitations/join/{code}', [
			'as'	=> 'invitations.join',
			'uses'	=> 'Auth\InvitationsController@showJoin'
		]);

		// Registration...
		// if (Features::enabled(Features::registration())) {
		// 			Route::post('/register', [RegisteredUserController::class, 'store'])
		// 		->middleware(['guest']);
		// }

		// The registration POST route needs to be open for regular and invitations
		Route::post('register', 'Auth\RegisteredUserController@store')->name('register.store');
	}
);
// End Oxygen routes

// Start Oxygen:Devices Routes
Route::group([
	'prefix' => 'manage', 'as' => 'manage.',
	'middleware' => ['auth', 'auth.acl:roles[super-admins|admins|developers]'],
	], function () {

		Route::resource('devices', '\App\Http\Controllers\Manage\ManageDevicesController')
		 ->only('index', 'show', 'destroy');
	});
// End Devices Routes
// Start AppSettings Routes
Route::group(['prefix' => '/manage/settings', 'middleware' => ['auth', 'auth.acl:roles[super-admins|admins|developers]'], 'as' => 'manage.'], function()
{
	// Settings
	Route::group([
		'namespace' => '\EMedia\AppSettings\Http\Controllers\Manage',
	], function () {
		Route::get('/', 'ManageSettingsController@index')->name('settings.index');
		Route::get('/new', 'ManageSettingsController@create')->name('settings.create');
		Route::get('/{id}/edit', 'ManageSettingsController@edit')->name('settings.edit');

		Route::post('/', 'ManageSettingsController@store')->name('settings.store');
		Route::put('/{id}', 'ManageSettingsController@update')->name('settings.update');
		Route::delete('/{id}', 'ManageSettingsController@destroy')->name('settings.destroy');
	});

	// Groups
	Route::group([
		'prefix' => 'groups',
		'namespace' => '\EMedia\AppSettings\Http\Controllers\Manage',
	], function () {
		Route::get('/', 'ManageSettingGroupsController@index')->name('setting-groups.index');
		Route::get('/new', 'ManageSettingGroupsController@create')->name('setting-groups.create');
		Route::get('/{id}/edit', 'ManageSettingGroupsController@edit')->name('setting-groups.edit');

		Route::post('/', 'ManageSettingGroupsController@store')->name('setting-groups.store');
		Route::put('/{id}', 'ManageSettingGroupsController@update')->name('setting-groups.update');
		Route::delete('/{id}', 'ManageSettingGroupsController@destroy')->name('setting-groups.destroy');
	});
});
// End AppSettings Routes