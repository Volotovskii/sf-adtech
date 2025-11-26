<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\WebmasterController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\OfferController;
use Spatie\Permission\Traits\HasRoles;

// Главная страница
Route::get('/', function () {

    return view('welcome');
});



// Аутентификация (Breeze)
require __DIR__ . '/auth.php';

// Только авторизованные пользователи
// Если статус ожидание редирект на информацию об этом TODO
Route::middleware(['auth', 'check.user.status'])->group(function () {
    // advertiser
    Route::prefix('advertiser')->middleware(['role:advertiser'])->group(function () {
        Route::get('/', [AdvertiserController::class, 'dashboard'])->name('advertiser.dashboard');
        Route::resource('offers', OfferController::class)->names('advertiser.offers');
        Route::get('/stats', [AdvertiserController::class, 'stats'])->name('advertiser.stats');
         //Route::put('/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('offer.updateStatus');
         Route::put('/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('offers.updateStatus');
        //Route::put('/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('advertiser.offers.updateStatus');
Route::put('/advertiser/offers/{offer}/status', [OfferController::class, 'updateStatus'])->name('offers.updateStatus');
    });

    // webmaster
    Route::prefix('webmaster')->middleware(['role:webmaster'])->group(function () {
        Route::get('/', [WebmasterController::class, 'dashboard'])->name('webmaster.dashboard');
        Route::get('/offers', [WebmasterController::class, 'offers'])->name('webmaster.offers');
        Route::post('/subscribe/{offer}', [WebmasterController::class, 'subscribe'])->name('webmaster.subscribe');
        Route::delete('/unsubscribe/{offer}', [WebmasterController::class, 'unsubscribe'])->name('webmaster.unsubscribe');
        Route::post('/unsubscribe/{offer}', [WebmasterController::class, 'unsubscribe'])->name('webmaster.unsubscribe');
        Route::put('/webmaster/update-markup/{offer}', [WebmasterController::class, 'updateMarkup'])->name('webmaster.update-markup');
        Route::get('/links', [WebmasterController::class, 'links'])->name('webmaster.links');
        Route::get('/stats', [WebmasterController::class, 'stats'])->name('webmaster.stats');
    });

});

// admin (без check.user.status, чтобы админ мог управлять)
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/stats', [AdminController::class, 'stats'])->name('admin.stats');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/toggle-user/{id}', [AdminController::class, 'toggleUser'])->name('admin.toggle-user');
        Route::get('/system-stats', [AdminController::class, 'systemStats'])->name('admin.system-stats');
        Route::get('/redirect-failures', [AdminController::class, 'redirectFailures'])->name('admin.redirect-failures');
        Route::get('/link-logs', [AdminController::class, 'linkLogs'])->name('admin.link-logs');
        // маршруты для подтверждения
        Route::get('/pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pending-users');
        Route::post('/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
        Route::post('/reject-user/{id}', [AdminController::class, 'rejectUser'])->name('admin.reject-user');
        Route::post('/admin/toggle-user/{id}', [AdminController::class, 'toggleUser'])->name('admin.toggle-user');
         // регистрация пользователей
        Route::get('/create-user', [AdminController::class, 'showCreateUserForm'])->name('admin.create-user.form');
        Route::post('/create-user', [AdminController::class, 'createUser'])->name('admin.create-user');
    });
});

// redirector (публичный маршрут, без аутентификации)
Route::get('/go/{token}', [RedirectController::class, 'redirect'])->name('redirect.link');

