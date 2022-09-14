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

    }

    public function forgotPasswordPage() {
        return view('authentication.forgot_password');
    }

    public function forgotPassword(Request $request) {

    }
}
