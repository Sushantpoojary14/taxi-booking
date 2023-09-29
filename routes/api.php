<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QueueController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__.'/cache.php';
// Route::group(['middleware' => ['auth:admin']], function () {
    Route::post('/status', [AdminController::class, 'status']);
Route::get('/index', [AdminController::class, 'indexapi']);
Route::post('/queuedata',[AdminController::class, 'queueapi']);
Route::get('/category',[AdminController::class, 'categoryapi']);
Route::post('/test',[AdminController::class, 'test']);
 Route::get('/delete/{id}', [AdminController::class, 'destroy']);   
// });
Route::get('/get_category', [CustomerController::class, 'category']);

Route::get('/price',[CustomerController::class, 'priceapi']);
Route::get('/qrcodeapi',[QueueController::class, 'get_qrcodeapi']);
Route::post('/qrcodeapi',[QueueController::class, 'qrcodeapi']);
Route::post('/adminavailabilityapi',[AdminController::class, 'adminavailabilityapi']);
Route::post('/availabilityapi',[CustomerController::class, 'availabilityapi']);




