<?php


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
});

Route::post('/payments/pay', [App\Http\Controllers\PaymentController::class, 'pay'])->name('pay');
Route::get('/payments/approval', [App\Http\Controllers\PaymentController::class, 'approval'])->name('approval');
Route::get('/payments/cancelled', [App\Http\Controllers\PaymentController::class, 'cancelled'])->name('cancelled');

Route::prefix('subscribe')
    ->name('subscribe.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\SubscriptionController::class, 'show'])->name('show');

        Route::post('/', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('store');

        Route::get('/approval', [App\Http\Controllers\SubscriptionController::class, 'approval'])->name('approval');

        Route::get('/cancelled', [App\Http\Controllers\SubscriptionController::class, 'cancelled'])->name('cancelled');
    });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

