<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverController;

Route::get('driver/dashboard',[DriverController::class , 'dashboard'])
->middleware(['auth', 'verified','driverstatus'])->name('driver.dashboard');




    Route::group(['middleware' => ['guest'], 'prefix' => 'driver', 'as' => 'driver.'], function () {
    Route::get('register', [DriverController::class, 'create'])
                ->name('register');

    Route::post('register', [DriverController::class, 'register']);

    Route::get('/', [AuthenticatedSessionController::class, 'create']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

    Route::group(['middleware' => ['auth'], 'prefix' => 'driver', 'as' => 'driver.'], function () {


    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::any('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});


Route::group(['middleware' => ['auth'], 'prefix' => 'driver', 'as' => 'driver.'], function () {

    Route::get('/queue', [DriverController::class, 'queue'])->name('queue');
    Route::post('/store', [DriverController::class, 'store'])->name('store');
    Route::get('/profile/edit/{id}', [DriverController::class, 'edit'])->name('edit');
    Route::post('/profile/update', [DriverController::class, 'update'])->name('update');
    Route::get('/exit',[DriverController::class, 'exit'])->name('exit');
    Route::post('/status',[DriverController::class, 'status'])->name('status');
});
