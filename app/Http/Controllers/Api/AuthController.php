<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 'failed',
                'message'   => $validator->errors()->first(),
            ]);
        }

        DB::beginTransaction();
        try {
            $user           = new User;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->name     = $request->name;
            $user->roles    = 'admin';

            $user->save();

            if ($user->save()) {
                $token =auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password]);
            }

            $response = [
                'status'    => 'success',
                'token'     => $token,
                'user'      => $user,
            ];

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();

            $response = [
                'status'    => 'failed',
                'message'   => $e->getMessage(),
            ];
        }

        return response()->json($response, 200);
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 'failed',
                'message'   => $validator->errors()->first(),
            ], 500);
        };

        $check_user = User::where('email', $request->email)->first();

        if ($check_user) {
            if (Hash::check($request->password, $check_user->password)) {

                $login = auth()->guard('api')->attempt(['email' => $check_user->email, 'password' => $request->password]);

                if($login) {
                   
                    $response = [
                        'status'        => 'success',
                        'message'       => 'login is successful',
                        'access_token'  => $login,
                        'user'          => $check_user,
                    ];
                } else {
                    $response = [
                        'status'    => 'failed',
                        'message'   => 'Login is not successful',
                    ];
                }

            } else {
                $response = [
                    'status'    => 'failed',
                    'message'   => 'Password is invalid',
                ];
            }
        } else {
            $response = [
                'status'    => 'failed',
                'message'   => 'User not registered!',
            ];
        }

        return response()->json($response, 200);
    }

    public function logout(Request $request) {

       $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

       if ($removeToken) {
           $response = [
               'status'     => 'success',
               'message'    => 'Logout Berhasil!',
           ];
        } else {
            $response = [
                'status'    => 'failed',
                'message'   => 'Logout belum berhasil!',
            ];
        }

        return response()->json($response, 200);
    }
}
