<?php

use App\Http\Controllers\Auth\AuthAdminController;
use App\Http\Controllers\Auth\AuthOwnerController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingPlaceController;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::group(['domain' => 'admin.' . env('DOMAIN')], function () {
    Route::controller(AuthAdminController::class)->group(function () {
        Route::get('login', 'login')->name('login')->middleware('guest:admin');
        Route::post('login', 'loginProcess');
        Route::get('forgot-password', 'forgotPassword');
        Route::post('forgot-password', 'forgotPasswordProcess');
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

        Route::prefix('districts')->controller(DistrictController::class)->group(function () {
            Route::get('/', 'index');
        });

        Route::prefix('villages')->controller(VillageController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('json', 'json');
        });

        Route::prefix('voting-places')->controller(VotingPlaceController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('json', 'json');
        });

        Route::prefix('coordinators')->controller(CoordinatorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('json', 'json');
        });

        Route::prefix('voters')->controller(VoterController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('validating', 'validating');
            Route::post('check', 'check');
            Route::post('store', 'store');
            Route::delete('destroy', 'destroy');

            Route::controller(CoordinatorController::class)->group(function () {
                Route::post('coordinator', 'coordinator');
                Route::post('check-coordinator', 'checkCoordinator');
                Route::post('be-coordinator', 'beCoordinator');
                Route::post('cancel-coordinator', 'cancelCoordinator');
            });

            Route::controller(ExportController::class)->group(function () {
                Route::get('export', 'export');
            });

            Route::controller(ImportController::class)->group(function () {
                Route::get('import', 'index');
                Route::post('import', 'import');
            });
        });
    });
});

// OWNER
Route::controller(AuthOwnerController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginProcess');
    Route::get('logout', 'logout');
});

Route::middleware('auth:owner')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'ownerDashboard');
        Route::get('dashboard', 'ownerDashboard');
    });
});
