<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
Route::any('/qrcode',[QueueController::class, 'qrcode'])->name('random');


Route::group(['middleware' => [], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/', [AuthenticatedSessionController::class, 'create']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('store');


});


Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {


    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Route::post('/add', [AdminController::class, 'store'])->name('addnew');

    // Route::get('/showadd', function () {
    //     return view('admin.add');
    // })->name('add');

    Route::get('/showedit/{id}', [AdminController::class, 'edit'])->name('showedit');
    Route::post('/edit', [AdminController::class, 'update'])->name('edit');
    Route::get('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');
    // Route::post('/showqueue',[AdminController::class, 'showqueue'])->name('showqueue');
    Route::get('/queue', [AdminController::class, 'show'])->name('queue');
    Route::get('/dispatch/{id}', [AdminController::class, 'queuedispatch'])->name('dispatch');
    // Route::post('/status/{id}', [AdminController::class, 'status'])->name('status');
    Route::any('/printedit/{id}', [AdminController::class, 'printedit'])->name('printedit');
    Route::any('/printedit', [AdminController::class, 'print'])->name('print');
    Route::post('/printview', [AdminController::class, 'printview'])->name('printview');
    Route::any('/trip', [AdminController::class, 'showtrip'])->name('trip');
    Route::get('/billview', [AdminController::class, 'billview'])->name('billview');
    Route::post('/generatebill', [AdminController::class, 'generatebill'])->name('generatebill');
     Route::any('/viewdetail/{id}', [AdminController::class, 'viewdetail'])->name('viewdetail');
    Route::any('/editdetails', [AdminController::class, 'editdetails'])->name('editdetails');
    Route::any('/updatedetails', [AdminController::class, 'updatedetails'])->name('updatedetails');

});
