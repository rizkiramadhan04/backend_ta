<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginPage() {
        return view('authentication.login');
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

        $check_user = User::where('email', $request->email)->first();

        if ($check_user->roles == 'admin') {
            if (Hash::check($request->password, $check_user->password)) {

                $login = Auth::attempt(['email' => $check_user->email, 'password' => $request->password]);

                return redirect()->route('admin.home');
                
            } else {
                return redirect()->route('admin.login-page')->with('error', 'Password anda salah !');
            } 
        } else {
                 return redirect()->route('admin.login-page')->with('error', 'Maaf anda bukan administrator !');
            }

    }

    public function forgotPasswordPage() {
        return view('authentication.forgot_password');
    }

    public function forgotPassword(Request $request) {

    }
}
