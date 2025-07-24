<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MoneyController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest', 'set.locale']], function () {
    // begin:: auth
    Route::get('/', [AuthController::class, 'login'])->name('home');
    Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
    // end:: auth
});

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(
    [
        'prefix'     => 'admin',
        'as'         => 'admin.',
        'middleware' => [
            'session.auth',
            'prevent.back.history'
        ],
    ],
    function () {
        Route::controller(DashboardController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::post('/count_income_expense_balance', [DashboardController::class, 'count_income_expense_balance'])->name('count_income_expense_balance');
            Route::post('/count_income', [DashboardController::class, 'count_income'])->name('count_income');
            Route::post('/count_expense', [DashboardController::class, 'count_expense'])->name('count_expense');
            Route::post('/count_balance', [DashboardController::class, 'count_balance'])->name('count_balance');
        });

        // begin:: profil
        Route::controller(ProfilController::class)->prefix('profil')->as('profil.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/save_picture', 'save_picture')->name('save_picture');
            Route::post('/save_account', 'save_account')->name('save_account');
            Route::post('/save_security', 'save_security')->name('save_security');
        });
        // end:: profil

        // begin:: category
        Route::controller(CategoryController::class)->prefix('category')->as('category.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: category

        // begin:: money
        Route::controller(MoneyController::class)->prefix('money')->as('money.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: money
    }
);
