<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('user.home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
require __DIR__ . '/product.php';
require __DIR__ . '/category.php';
Route::get('redirect', [UserController::class, 'redirect'])->middleware('auth');

Route::post('{value}/addCart', [UserController::class, 'addCart'])->name('addCart')->middleware('auth');
Route::get('cart/{value}', [UserController::class, 'destroy'])->middleware('auth');
Route::get('showCart', [UserController::class, 'showCart'])->name('showCart')->middleware('auth');
Route::post('/confirm', [UserController::class, 'confirm'])->name('confirm')->middleware('auth');


// Edit & Delete in Cart
Route::get('/editCart/{value}',[UserController::class,'editForm']);
Route::post('/editCart/{id}',[UserController::class,'edit']);
Route::get('/deleteCart/{id}',[UserController::class,'destroy']);



Route::post('voucher',[UserController::class,'voucher']);
Route::post('remove',[UserController::class,'remove']);
Route::post('payment',[UserController::class,'payment']);

Route::post('pay',[UserController::class,'pay']);
Route::get('invoice',[UserController::class,'invoice']);
Route::get('order',[UserController::class,'order']);
Route::get('sms',[UserController::class,'sms']);
Route::get('review/{id}',[UserController::class,'reviewform']);
Route::post('review/{id}',[UserController::class,'review']);