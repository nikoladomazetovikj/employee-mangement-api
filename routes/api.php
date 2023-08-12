<?php

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

Route::middleware('jwt.auth')->group(function () {
    Route::apiResources([
        'company' => \App\Http\Controllers\Api\CompaniesController::class,
        'user' => \App\Http\Controllers\Api\UserController::class,
        'inquire' => \App\Http\Controllers\Api\InquireController::class
    ]);

});
