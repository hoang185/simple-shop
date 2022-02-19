<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $info = Socialite::driver('facebook')->user();
        session(['name' => $info->name, 'email' => $info->email]);
//        $data = session('name');
//                dd($info, $data);
        return view('auth.httpsFD.login')->with('success', 'Bạn đã đăng nhập thành công');
    }
}
