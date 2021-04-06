<?php

use App\Http\Controllers\Api\AvatarController;
use App\Http\Controllers\Api\LinkIconController;
use App\Http\Controllers\Api\LinkScheduleController;
use App\Http\Controllers\Api\SvgsController;
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


Route::middleware('auth:sanctum')->group(function () {
    Route::get('svgs', SvgsController::class);
    Route::post('link/{link}/icon', LinkIconController::class);
    Route::post('link/{link}/schedule', LinkScheduleController::class);
    Route::post('bio/{bio}/avatar', [AvatarController::class,'update']);
    Route::delete('bio/{bio}/avatar/{avatar}', [AvatarController::class,'destroy']);
});
