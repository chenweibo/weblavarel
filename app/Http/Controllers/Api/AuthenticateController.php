<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\AdminUser;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = new AdminUser();

        // $dd= $user->get()->first();
        // $token = JWTAuth::fromUser($dd);
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        // JWTAuth::parseToken();// and you can continue to chain methods
        // $user = JWTAuth::parseToken()->authenticate();

        // all good so return the token
        return response()->json(compact('token'));
    }
    public function text(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }



    // public function authenticate(Request $request)
    // {
    //     config(['jwt.user' => '\App\AdminUser']);    //重要用于指定特定model
    //     config(['auth.providers.users.model' => \App\AdminUser::class]);//重要用于指定特定model！！！！
    //     $payload = [
    //        'username' => $request->get('username'),
    //        'password' => $request->get('password')
    //    ];
    //     try {
    //         if (!$token = JWTAuth::attempt($payload)) {
    //             return response()->json(['error' => 'token_not_provided'], 401);
    //         }
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => '不能创建token'], 500);
    //     }
    //     return response()->json(compact('token'));
    // }
}
