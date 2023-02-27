<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\NotificationController;
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
 //Clear route cache

require __DIR__.'/cache.php';
//Clear config cache


// Route::get('/test', );
Route::get('/test',[QueueController::class, 'test'])->name('test');
Route::get('/test2',[QueueController::class, 'test2'])->name('test2');
Route::get('/code',[QueueController::class, 'code'])->name('code');
Route::any('/qrcode',[QueueController::class, 'qrcode'])->name('random');
Route::get('/send',[NotificationController::class, 'sendSmsNotificaition']);

Route::get('/', [CustomerController::class, 'index']);
Route::get('/home', [CustomerController::class, 'index']);
Route::get('/contact-us', [CustomerController::class, 'contact'])->name('contact');
Route::post('/contact-us', [CustomerController::class, 'contactusform'])->name('contact.store');
Route::get('/about-us', [CustomerController::class, 'about'])->name('about');


Route::get('/dashboard',[DriverController::class , 'dashboard'])
->middleware(['auth', 'verified','driverstatus'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // Route::get('/profile', [DriverController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/admin/dashboard',[AdminController::class, 'index']
)->middleware(['auth:admin', 'verified'])->name('admin.dashboard');
Route::group(['middleware'=>['auth:admin'],'prefix'=>'admin','as'=>'admin.'],function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/adminauth.php';


