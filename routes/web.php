<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::get('login/create', [LoginController::class, 'createAccount'])->name('login.create');
Route::post('create/account', [RegisterController::class, 'createUser'])->name('user.create');
Route::post('login', [LoginController::class, 'login'])->name('login.auth');
