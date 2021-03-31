<?php

use App\Http\Controllers\{BiosController,
    BioStatusController,
    BioViewController,
    DashboardController,
    LinkController,
    LinksController,
    LinkStatusController,
    LinkTitleUrlController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/{user:username}/{bio:slug}', BioViewController::class)
    ->name('bio.view');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    // Show Bio
    Route::get('/bios/{bio:slug}', [BiosController::class, 'show'])
        ->name('bio.show');

    Route::get('/bios/{bio:slug}/appearance', \App\Http\Controllers\BioAppearanceController::class)
        ->name('bio.appearance');

    // Bio Status
    Route::put('/bio/{bio:slug}/status', BioStatusController::class)
        ->name('bio.status.update');

    // create link
    Route::post('/bio/{bio:slug}/links', [LinkController::class, 'store'])
        ->name('link.create');


    //Link Status
    Route::delete('/links/{link}', [LinksController::class, 'delete'])
        ->name('link.delete');

    //Link Status
    Route::put('/links/{link}/status', LinkStatusController::class)
        ->name('link.status.update');


    //Link Title & Url
    Route::put('/links/{link}/title-url', LinkTitleUrlController::class)
        ->name('link.title.url.update')->middleware('remember');


});
