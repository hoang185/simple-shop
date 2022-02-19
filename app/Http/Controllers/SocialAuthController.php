<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider(Request $request)
    {
        $social = $request->social;
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(Request $request)
    {
        $social = $request->social;
        $info = Socialite::driver($social)->user();
        dd($info);
        session(['name' => $info->name, 'email' => $info->email]);
//        $data = session('name');
//                dd($info, $data);
        $success = 'success';
        return view('auth.https.login')->with($success, 'Bạn đã đăng nhập thành công');
    }
}
