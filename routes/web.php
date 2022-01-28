<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

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

//socialite google
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');


// membuar group middleware untuk halaman-halaman yang harus login terlebih dahulu jika ingin masuk
Route::middleware(['auth'])->group(function () {
    //success checkout
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    // checkout dengan controller
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    // mengirim data saat checkout
    Route::post('checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');

    // my dashboard
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // // invoice
    // Route::get('dashboard/checkout/invoice/{checkout}', [CheckoutController::class, 'invoice'])->name('user.checkout.invoice');

    // user dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')->group(function () {
        Route::get('/', [UserDashboard::class, 'index'])->name('dashboard');
    });

    // admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    });
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
