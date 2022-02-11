<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForHimController;
use App\Http\Controllers\ForHerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Hash;

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
    return view('home');
})->name('home');
//auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::get('forget-password', function() {
    return view('auth.forget-password');

})->name('forget-password');
Route::get('logout', function() {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
Route::post('update/{id}', [LoginController::class, 'updateAccount'])->name('user.update');
Route::get('login/create', [LoginController::class, 'createAccount'])->name('login.create');
Route::post('create/account', [RegisterController::class, 'createUser'])->name('user.create');
Route::post('login', [LoginController::class, 'login'])->name('login.auth');
// product
Route::get('for-him/{sorter?}', [ForHimController::class, 'index'])->name('for-him.index');
Route::get('him/{cat}/{sorter?}', [ForHimController::class, 'filterCategory'])->name('for-him.category');
Route::get('for-her/{sorter?}', [ForHerController::class, 'index'])->name('for-her.index');
Route::get('her/{cat}/{sorter?}', [ForHerController::class, 'filterCategory'])->name('for-her.category');
Route::get('new-arrivals/{sorter?}', [AdminController::class, 'special'])->name('new-arrival.index');
Route::get('sale-off/{sorter?}', [AdminController::class, 'special'])->name('sale-off.index');
Route::get('p/{product}', [AdminController::class, 'productDetail'])->name('product.detail');

//cart
Route::get('checkout/cart', [AdminController::class, 'checkoutCart'])->name('cart.checkout');
Route::get('checkout/pay', [AdminController::class, 'checkoutPay'])->name('pay.checkout');
Route::post('search', [AdminController::class, 'search'])->name('product.search');
Route::post('cart/add', [CartController::class, 'addCart'])->name('cart.add');
Route::post('cart/delete', [CartController::class, 'deleteCart'])->name('cart.delete');
//Route::get('convert', [AdminController::class, 'convertLower']);


