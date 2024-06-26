<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\RolesPermissionController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth::routes();

Route::get('/demo', [DemoController::class, 'demo'])->name('demo');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('media' , ImageController::class);
Route::post('process' , [ImageController::class , 'proccess']); // FILEPOND
Route::delete('revert' , [ImageController::class , 'revert']); // FILEPOND
Route::get('restore' , [ImageController::class , 'restore']); // FILEPOND

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
Auth::routes();
