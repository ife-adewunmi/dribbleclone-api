<?php

// use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\VerificationController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\ResetPasswordController;

use App\Http\Controllers\API\User\MeController;
use App\Http\Controllers\API\User\SettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Route::get('/', function () {
//     return response()->json(['message' => 'Hello Api'], 200);
// });

/**
 * Route for Public users only
 */
// me (current user)
Route::get('me', [MeController::class, 'getMe']);

// designs
// Route::get('designs', 'Designs\DesignController@index');
// Route::get('designs/{id}', 'Designs\DesignController@findDesign');
// Route::get('designs/slug/{slug}', 'Designs\DesignController@findBySlug');


// //users
// Route::get('users', 'User\UserController@index');
// Route::get('user/{username}', 'User\UserController@findByUsername');
// Route::get('users/{id}/designs', 'Designs\DesignController@getForUser');

// // Team
// Route::get('teams/slug/{slug}', 'Teams\TeamsController@findBySlug');
// Route::get('teams/{id}/designs', 'Designs\DesignController@getForTeam');

// // Search Designs
// Route::get('search/designs', 'Designs\DesignController@search');
// Route::get('search/designers', 'User\UserController@search');

/**
 * Route group for Authenticated users only
 */
Route::group(['middleware' => ['auth:api']], function(){
    
    Route::post('logout', [LoginController::class, 'logout']);
    Route::put('settings/profile', [SettingsController::class, 'updateProfile']);
    Route::put('settings/password', [SettingsController::class, 'updatePassword']);

});

/**
 * Route group for Guest users only
 */
Route::group(['middleware' => ['guest:api'], // 'prefix' => 'auth'
], function(){
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('verification/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('verification/resend', [VerificationController::class, 'resend']);

    Route::post('login', [LoginController::class, 'login']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});