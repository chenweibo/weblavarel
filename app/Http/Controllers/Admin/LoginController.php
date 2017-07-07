<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    /**
     * login
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $param = $request->except('_token');

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
            return ['code' => 1, 'msg' => '验证通过'];

            }
        return view('admin/login');

    }

    public function loginout()
    {


    }


}
