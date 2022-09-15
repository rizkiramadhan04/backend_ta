<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->route('login-page')->withErrors($validator)->withInput();
        }
        
        $check_user = User::where('email', $request->email)->first();
        // dd(Hash::check($request->password, $check_user->password));

        if ($check_user) {
            if (Hash::check($request->password, $check_user->password)) {

               $login = Auth::attempt(['email' => $check_user->email, 'password' => $request->password]);

            //    dd($login);

                return redirect()->route('admin.home');
                
            } else {
                return redirect()->route('login-page')->with('error', 'Password anda salah !')->withInput();
            } 
        } else {
                 return redirect()->route('login-page')->with('error', 'Maaf anda bukan administrator !')->withInput();
            }

    }

    public function forgotPasswordPage() {
        return view('authentication.forgot_password');
    }

    public function forgotPassword(Request $request) {

    }
}
