<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function createUser(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'phone'       => 'required|numeric|unique:users',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:6',
            're-password' => ['required', 'same:password'],
        ]);
        $data = $request->all();
        if ( $request->has('mail-check') ) {
            User::insert([
                'name'      => $data['name'],
                'phone'     => $data['phone'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'send_mail' => 1,
            ]);
        }
        else {
            User::insert([
                'name'      => $data['name'],
                'phone'     => $data['phone'],
                'email'     => $data['email'],
                'password'  => Hash::make($data['password']),
                'send_mail' => 0,
            ]);
        }

        return redirect()->route('login.create')->with('success', 'Tài khoản của bạn đã đăng kí thành công!');
    }
}
