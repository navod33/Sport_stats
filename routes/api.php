<?php

use App\Http\Controllers\API\V1\GamesAPIController;
use App\Http\Controllers\API\V1\MatchSetupsAPIController;
use App\Http\Controllers\API\V1\PlayersAPIController;
use App\Http\Controllers\API\V1\ScoresAPIController;
use App\Http\Controllers\API\V1\SeasonsAPIController;
use App\Http\Controllers\API\V1\TeamsAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Start Oxygen API routes
Route::group([
	'prefix' => 'v1',
	'middleware' => ['auth.api'],
	'namespace' => '\App\Http\Controllers\API\V1'
], function () {

	if (config('features.api_active')) {
		Route::post('/register', 'Auth\AuthController@register');
		Route::post('/login', 'Auth\AuthController@login');
        Route::post('/verify-email/{code}', 'Auth\AuthController@verityEmail');
		Route::post('/password/email', 'Auth\ForgotPasswordController@checkRequest');
        Route::post('/resend-code', 'Auth\AuthController@resendCode');

		// guest (all-users) API routes
		Route::get('/guests', 'GuestController@index');

		// logged-in users
		Route::group(['middleware' => ['auth.api.logged-in']], function () {
			Route::get('/logout', 'Auth\AuthController@logout');
			Route::get('/profile', 'Auth\ProfileController@index');
			Route::put('/profile', 'Auth\ProfileController@update');
			Route::post('/avatar', 'Auth\ProfileController@updateAvatar');
			Route::post('/password/edit', 'Auth\ResetPasswordController@updatePassword');

			Route::get('/seasons', [SeasonsAPIController::class, 'index']);
			Route::post('/files', [\App\Http\Controllers\API\V1\FilesAPIController::class, 'store']);

			Route::get('/teams', [TeamsAPIController::class, 'index']);
            Route::post('/teams', [TeamsAPIController::class, 'store']);
            Route::put('/teams/{uuid}', [TeamsAPIController::class, 'update']);
            Route::delete('/teams/{uuid}', [TeamsAPIController::class, 'destroy']);

			Route::get('/player-positions', [PlayersAPIController::class, 'ppositions']);

            Route::get('/players', [PlayersAPIController::class, 'index']);
            Route::post('/players', [PlayersAPIController::class, 'store']);
			Route::post('/player', [PlayersAPIController::class, 'storeplayer']);
            Route::put('/players/{uuid}', [PlayersAPIController::class, 'update']);
            Route::delete('/players/{uuid}', [PlayersAPIController::class, 'destroy']);

            // routes for games
            Route::get('/games', [GamesAPIController::class, 'index']);
            Route::post('/games', [GamesAPIController::class, 'store']);
            Route::put('/games/{uuid}', [GamesAPIController::class, 'update']);
            Route::delete('/games/{uuid}', [GamesAPIController::class, 'destroy']);

            // https://projects.invisionapp.com/share/KN12QOVVETSY#/screens/467309959

            // scores
            Route::get('/games/{gameUuid}/scores', [ScoresAPIController::class, 'index']);
            Route::post('/games/{gameUuid}/scores', [ScoresAPIController::class, 'store']);
            Route::delete('/games/{gameUuid}/scores/{uuid}', [ScoresAPIController::class, 'destroy']);

			//match setup
			Route::post('/match', [MatchSetupsAPIController::class, 'store']);
			Route::get('/match', [MatchSetupsAPIController::class, 'index']);
		});
	}
});
// End Oxygen API routes
// Start AppSettings Routes
Route::group(['prefix' => 'v1', 'namespace' => '\EMedia\AppSettings\Http\Controllers\API\V1'], function() {
	Route::get('/settings', 'SettingsController@index')->name('settings.index');
	Route::get('/settings/{key}', 'SettingsController@show')->name('settings.show');
});
// End AppSettings Routes
