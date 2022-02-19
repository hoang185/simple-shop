<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ForHimController;
use App\Http\Controllers\ForHerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\SocialAuthController;

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

Route::get('/', [AdminController::class, 'showHome'])->name('home');
//auth
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::get('forget-password', function() {
    return view('auth.forget-password');

})->name('forget-password');
Route::get('logout', function() {
    Auth::logout();
    Session::flush();
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
Route::post('checkout/pay/insert', [AdminController::class, 'insertOrder'])->name('checkout.info');
Route::post('search', [AdminController::class, 'search'])->name('product.search');
Route::post('cart/add', [CartController::class, 'addCart'])->name('cart.add');
Route::post('cart/delete', [CartController::class, 'deleteCart'])->name('cart.delete');
Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');

//blog
Route::get('blog/{article}', [AdminController::class, 'showBlog'])->name('blog.index');
//Route::get('test', function() {
//    return view('mail.login');
//});
Route::get('send-mail', function() {
    return view('mail.login');
})->name('admin.login');
Route::post('send-mail', [AdminController::class, 'sendMail'])->name('admin.send-mail');
Route::get('convert', [AdminController::class, 'convertLower']);

Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToProvider'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::get('test', function() {
    return view('auth.https.login');
});




