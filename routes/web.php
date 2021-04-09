<?php

use App\Http\Controllers\{BioAppearanceController,
    BioAvatarController,
    BiosController,
    BioStatusController,
    BioViewController,
    DashboardController,
    LinkController,
    LinkIconController,
    LinksController,
    LinkStatusController,
    LinkTitleUrlController};
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

//Route::get('/{user:username}/{bio:slug}', BioViewController::class)
//    ->name('bio.view');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {

    Route::get('/', DashboardController::class)
        ->name('dashboard');

    // Create Bio
    Route::post('/bios', [BiosController::class, 'store'])
        ->name('bio.store');

    // Show Bio
    Route::get('/bios/{bio:slug}', [BiosController::class, 'show'])
        ->name('bio.show');

    // Update Bio
    Route::put('/bios/{bio:slug}', [BiosController::class, 'update'])
        ->name('bio.update');

    // Delete Bio
    Route::delete('/bios/{bio:slug}', [BiosController::class, 'destroy'])
        ->name('bio.delete');

    //Preview Bio
    Route::get('/{user:username}/{bio:slug}/preview', BioViewController::class)
        ->name('bio.view');

    Route::get('/bios/{bio:slug}/appearance', BioAppearanceController::class)
        ->name('bio.appearance');

    // Bio Status
    Route::put('/bio/{bio:slug}/status', BioStatusController::class)
        ->name('bio.status.update');

    // Bio avatar
    Route::post('/bio/{bio:slug}/avatar', [BioAvatarController::class, 'store'])
        ->name('bio.avatar.store');
    Route::delete('/bio/{bio:slug}/avatar/{avatar}', [BioAvatarController::class, 'destroy'])
        ->name('bio.avatar.delete');

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

    Route::post('link/{link}/icon', LinkIconController::class)
        ->name('link.icon.update');


});
