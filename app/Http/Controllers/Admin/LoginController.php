<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
class LoginController extends Controller
{

    /**
     * login
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $param = $request->except('_token');
            $user = DB::table('admin_user')->where('username',$param['username'])->get();

            $validator = Validator::make($param,
                [
                    'username' => 'required',
                    'password' => 'required',
                    'captcha' => 'required|captcha',
                ], [
                    'username.required' => '用户名不能为空',
                    'password.required' => '密码不能为空',
                    'captcha.required' => '验证码不能为空',
                    'captcha.captcha' => '验证码错误',
                ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return ['code' => -1, 'msg' => $errors];
            }

            if($user->isEmpty()){

              return ['code' => -1, 'msg' => '用户不存在'];
            }



            return ['code' => 1, 'msg' => '验证通过'];

            }
        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();

        return view('admin/login');

    }

    public function loginout()
    {


    }


}
