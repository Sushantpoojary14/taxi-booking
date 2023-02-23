<?php

use  App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use  App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use  App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use  App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use  App\Http\Controllers\AdminAuth\NewPasswordController;
use  App\Http\Controllers\AdminAuth\PasswordController;
use  App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use  App\Http\Controllers\AdminAuth\RegisteredUserController;
use  App\Http\Controllers\AdminAuth\VerifyEmailController;
use  App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['guest:admin'],'prefix'=>'admin','as'=>'admin.'],function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //             ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);
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


Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function () {
    // Route::post('/add', [AdminController::class, 'store'])->name('addnew');

    // Route::get('/showadd', function () {
    //     return view('admin.add');
    // })->name('add');

    Route::get('/showedit/{id}',[AdminController::class, 'edit'])->name('showedit');

    Route::post('/edit', [AdminController::class, 'update'])->name('edit');

    Route::get('/destroy/{id}',[AdminController::class, 'destroy'])->name('destroy');

    // Route::post('/showqueue',[AdminController::class, 'showqueue'])->name('showqueue');
    Route::any('/queue',[AdminController::class, 'show'])->name('queue');
    Route::get('/dispatch/{id}',[AdminController::class, 'queuedispatch'])->name('dispatch');
    Route::post('/status/{id}',[AdminController::class, 'status'])->name('status');
    Route::any('/printedit/{id}',[AdminController::class, 'printedit'])->name('printedit');
    Route::any('/printedit',[AdminController::class, 'print'])->name('print');
    Route::post('/printview',[AdminController::class, 'printview'])->name('printview');
});
