<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm() {
        // if (!session()->has('from')) {
        //     session()->put('from', URL::previous());
        // }

        return view('auth.login');
    }
    public function createAccount() {

        return view('auth.create_account');
    }
}
