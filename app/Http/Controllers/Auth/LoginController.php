<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        // if (!session()->has('from')) {
        //     session()->put('from', URL::previous());
        // }

        return view('auth.login');
    }
    protected function login(Request $request)
    {
//        $request->validate([
//            'user-name'    => 'required|email',
////            'phone'    => 'required|numeric',
//            'password-login' => 'required|min:6',
//        ]);
//        $credentials = $request->only('email', 'password');
        $username = $request->input('user-name');
        $password = $request->input('password-login');
        if( Auth::attempt(['email' => $username, 'password' => $password]) || Auth::attempt(['phone' => $username, 'password' => $password]) ) {
            return redirect()->route('login.show')->with('success', 'Bạn đã đăng nhập thành công!');
        }
        else{
            return redirect()->route('login.show')->with('error', 'Tài khoản không hợp lệ!');
        }
    }

    public function createAccount() {
        return view('auth.create_account');
    }
}
