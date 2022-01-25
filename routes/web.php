<?php

use App\Http\Controllers\User\CheckoutController;
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
    return view('welcome');
})->name('welcome');

//login
Route::get('login', function () {
    return view('login');
})->name('login');


//success checkout
Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
// checkout dengan controller
Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
// mengirim data saat checkout
Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');


//socialite google
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
