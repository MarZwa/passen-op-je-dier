<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', HomeController::class)->name('home');

Route::get('/', HomeController::class)->name('home');
Route::get('/requests/show/{id}', [RequestController::class, 'show'])->name('requests.show');

Route::middleware(['auth'])->group(function () {
    Route::controller(RequestController::class)->name('requests.')->group(function () {
        Route::get('/requests/pet/{id}', 'indexPet')->name('index-pet');
        Route::get('/requests/create/{id}', 'create')->name('create');
        Route::post('/requests/store', 'store')->name('store');
        Route::delete('/requests/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(UserController::class)->name('users.')->group(function () {
        Route::get('/users', 'index')->name('index');
        Route::get('/users/{id}', 'show')->name('show');
        Route::put('/users/block/{id}', 'block')->name('block');
        Route::put('/users/unblock/{id}', 'unblock')->name('unblock');
    });

    Route::controller(RegistrationController::class)->name('registrations.')->group(function () {
        Route::get('/registrations', 'index')->name('index');
        Route::get('/registrations/index-request/{id}', 'indexRequest')->name('index-request');
        Route::get('/registrations/create/{request_id}', 'create')->name('create');
        Route::post('/registrations/store', 'store')->name('store');
        Route::delete('/registrations/destroy/{id}', 'destroy')->name('destroy');
        Route::put('/registrations/accept', 'accept')->name('accept');
        Route::put('/registrations/decline', 'decline')->name('decline');
    });

    Route::controller(PetController::class)->name('pets.')->group(function () {
        Route::get('/pets', 'index')->name('index');
        Route::get('/pets/show/{id}', 'show')->name('show');
        Route::get('/pets/create', 'create')->name('create');
        Route::post('/pets/store', 'store')->name('store');
        Route::delete('/pets/destroy/{id}', 'destroy')->name('destroy');
    });

    Route::controller(AssetController::class)->name('assets.')->group(function () {
        Route::post('/assets/store', 'store')->name('store');
    });

    Route::controller(ReviewController::class)->name('reviews.')->group(function () {
        Route::post('/reviews/store', 'store')->name('store');
    });
});
