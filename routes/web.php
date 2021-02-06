<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ChairmanController;
use App\Http\Controllers\ExternalBookingController;
use App\Http\Controllers\SettingsCongregationController;
use App\Http\Controllers\SettingsMeetingController;
use App\Http\Controllers\SettingsNotificationsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SettingsExtraController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\TalkController;
use App\Models\Talk;
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
    return Inertia::render('Welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('/bookings', BookingsController::class)->except(['create', 'show']);
    Route::post('/bookings/create', [BookingsController::class, 'create']);
    Route::get('/bookings/create', [BookingsController::class, 'create']);
    Route::get('/bookings/thanks/{booking}', [BookingsController::class, 'showThanks'])->name('bookings.thanks');
    Route::get('/bookings/comments/{booking}', [BookingsController::class, 'showComments'])->name('bookings.comments');
    Route::post('/bookings/comments/{booking}', [BookingsController::class, 'comments'])->name('bookings.comment');

    Route::resource('settings', SettingsController::class)->only(['index']);
    Route::resource('settings.congregation', SettingsCongregationController::class)->only(['update']);
    Route::resource('settings.meeting', SettingsMeetingController::class)->only(['update']);
    Route::resource('settings.extra', SettingsExtraController::class)->only(['update']);
    Route::resource('settings.notifications', SettingsNotificationsController::class)->only(['update']);

    Route::resource('speakers', SpeakerController::class)->except(['edit', 'create']);

    Route::resource('talks', TalkController::class)->only(['index', 'show', 'destroy', 'store']);
    Route::get('all-talks', function () {
        return Talk::all();
    });

    Route::resource('chairmen', ChairmanController::class)->except(['create', 'edit', 'show']);
});

Route::get('/bookings/{identifier}', [ExternalBookingController::class, 'index'])->name('bookings.thanks');
Route::post('/bookings/greeting/{booking}', [BookingsController::class, 'greeting'])->name('bookings.greeting');
