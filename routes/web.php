<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QueueController;
use Illuminate\Http\Request;
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

Route::get('/test',[QueueController::class, 'test'])->name('test');
Route::get('/test2',[QueueController::class, 'test2'])->name('test2');
Route::get('/test3',[CustomerController::class, 'test3'])->name('test3');

Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::get('/home', [CustomerController::class, 'index']);
Route::get('/contact-us', [CustomerController::class, 'contact'])->name('contact');
Route::post('/contact-us', [CustomerController::class, 'contactusform'])->name('contact.store');
Route::get('/about-us', [CustomerController::class, 'about'])->name('about');
Route::post('/billview', [CustomerController::class, 'billview'])->name('billview');
Route::post('/payment', [CustomerController::class, 'payment'])->name('payment');
Route::get('/billview', [CustomerController::class, 'c_billview'])->name('c_billview');
Route::get('map/{id}', [AdminController::class, 'url']);
Route::get('/privatepolicy', function(){
    return view('customer.private_policy');
});

Route::get('/form',function(){
    return view('payment.form');
});
Route::post('/redirect',function(request $request){
     $customer  =$request->billing_data;
    //  dd($customer,$request->input());
    return view('payment.ccavRequestHandler',compact('customer'));
});
Route::post('/response',[CustomerController::class, 'response']);

Route::post('/cancel',function(request $request){
    dd($request->input());
   return view('customer.payment');
});

Route::any('/customerpayment', [CustomerController::class, 'billview']);
require __DIR__.'/auth.php';

require __DIR__.'/adminauth.php';


