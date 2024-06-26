<?php

use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin/')->group(function () {
    // Admin routes
    Route::resource('menu', AdminMenuController::class);
    Route::resource('users', UserController::class);
    Route::put('change-role/{user_id}', [UserController::class, 'changeRole'])->name('changerole');
    Route::get('/transactions', [OrderController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [OrderController::class, 'show'])->name('transactions.show');
    Route::post('/transactions/{id}/update-payment-status', [OrderController::class, 'updatePaymentStatus'])->name('transactions.updatePaymentStatus');
});

Route::middleware(['auth', 'role:user'])->name('user.')->group(function () {
    // User routes
    Route::resource('menu', MenuController::class);
    Route::get('order', [UserController::class, 'order'])->name('order');
    Route::post('/order/add', [UserController::class, 'addOrder'])->name('order.add');
    Route::post('/order/{id}/update', [UserController::class, 'updateQuantity'])->name('order.update');
    Route::delete('/order/delete/{id}', [UserController::class, 'deleteOrder'])->name('order.delete');
    Route::get('history', [UserController::class, 'history'])->name('history');
    Route::get('/history/{transactionId}', [UserController::class, 'showHistory'])->name('history.show');
});

require __DIR__ . '/auth.php';
