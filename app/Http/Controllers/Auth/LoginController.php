<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);
        $username = $request->input('email');
        $password = $request->input('password');
        if( Auth::attempt(['email' => $username, 'password' => $password]) || Auth::attempt(['phone' => $username, 'password' => $password])) {
            return redirect()->route('login.show')->with('success', 'Bạn đã đăng nhập thành công!');
        }
        else{
            return redirect()->route('login.show')->with('error', 'Tài khoản không hợp lệ!');
        }
    }

    public function createAccount() {
        return view('auth.create_account');
    }

    public function updateAccount(Request $request, $id) {
        $validated = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
        ]);
        User::find($id)->update($validated);
        return redirect()->route('login.show')->with('success', 'Bạn đã cập nhật thông tin thành công!');
    }
}
