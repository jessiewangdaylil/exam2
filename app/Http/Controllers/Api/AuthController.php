<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login'); //除了 login() ，其餘都要採用 jwt 驗證機制
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        try {
            if (!$token =auth()->guard('api')->attempt($credentials)) {
                return response()->json(['status' => 0, 'message' => '無效的驗證資料'], 401); //生成 Json 字串後回傳
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => '無法建立 Token'
            ], 500);
        }

        return response()->json(['status' => 1, 'token' => $token]);
    }

    public function me()
    {
        //App/Models/User 
        return response()->json(auth()->user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['status' => 1]);
    }
}
