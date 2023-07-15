<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthOwnerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::group(['domain' => 'admin.' . env('DOMAIN')], function () {
    Route::controller(AuthAdminController::class)->group(function () {
        Route::get('login', 'login')->name('login')->middleware('guest:admin');
        Route::post('login', 'loginProcess');
        Route::get('forgot-password', 'forgotPassword');
        Route::post('forgot-password', 'forgotPasswordProcess');
        Route::get('reset-password', 'resetPassword');
        Route::post('reset-password', 'resetPasswordProcess');
        Route::post('otp', 'otp');
        Route::get('logout', 'logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'adminDashboard');
            Route::get('dashboard', 'adminDashboard');
        });

        Route::get('profile', [ProfileController::class, 'admin']);

        Route::prefix('search')->controller(SearchController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'search');
        });

        include 'extra/village-route.php';

        include 'extra/voting-place-route.php';

        include 'extra/coordinator-route.php';

        include 'extra/voter-route.php';
    });
});

// OWNER
Route::controller(AuthOwnerController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginProcess');
    Route::get('forgot-password', 'forgotPassword');
    Route::post('forgot-password', 'forgotPasswordProcess');
    Route::get('reset-password', 'resetPassword');
    Route::post('reset-password', 'resetPasswordProcess');
    Route::post('otp', 'otp');
    Route::get('logout', 'logout');
});

Route::middleware('auth:owner')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'ownerDashboard');
        Route::get('dashboard', 'ownerDashboard');
    });

    Route::prefix('administrators')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('check', 'check');
        Route::post('store', 'store');
        Route::delete('destroy', 'destroy');
    });

    include 'extra/village-route.php';

    include 'extra/voting-place-route.php';

    include 'extra/coordinator-route.php';

    include 'extra/voter-route.php';
});
