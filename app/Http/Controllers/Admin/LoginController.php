<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\UserType;
class LoginController extends Controller
{

    /**
     * login
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $param = $request->except('_token');
            $user = DB::table('admin_user')->where('username',$param['username'])->get()->first();

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
                return ['code' => -1, 'msg' => $errors ];
            }

            if(empty($user)){

              return ['code' => -1, 'msg' => '用户不存在'];
            }
            if($param['password'] != $user->password ){
            return ['code' => -1, 'data' => '', 'msg' => '密码错误'];
           }

             if(1 != $user->status){
                 return ['code' => -6, 'data' => '', 'msg' => '该账号被禁用'];
             }
            $usertype= new UserType();
            $info=$usertype->getRoleInfo($user->typeid);

            session(['adminuser'=>$request['username'],'id'=>$request['id'],'role'=>$info['rolename'],'rule'=>$info['rule'],'action'=>$info['action']]);
            $param1 = [
                'loginnum' => $user->loginnum + 1,
                'last_login_ip' => $request->ip(),
                'last_login_time' => time()
            ];


            DB::table('admin_user')->where('id', $user->id)->update($param1);
            return ['code' => 1,'data'=>route('AdminIndex'),'msg' => '验证通过'];

            }


            return view('admin/login');

    }

    public function loginout(Request $request)
    {

         $request->session()->forget(['adminuser','id']);
         return redirect()->route('jksm');

    }


}
