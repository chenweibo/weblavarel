<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\UserType;
use App\AdminUser;

class UserController extends Controller
{
    public function UserIndex()
    {
        $str=DB::table('admin_user')
            ->join('role', 'admin_user.typeid', '=', 'role.id')
            ->select('admin_user.*', 'role.rolename')
            ->get();
        return view('admin.user.User', ['str'=>$str]);
    }
    public function UserCreate(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            $param['password']=Crypt::encryptString($param['password']);
            $flag=AdminUser::InsertUser($param);
            return ['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']];
        }
        $role = UserType::all();
        $status = config('admin.user_status');
        return view('admin.user.UserCreate', ['role'=>$role,'status'=>$status]);
    }


    public function UserEdit()
    {
        return view('admin.user.UserEdit');
    }
    public function UserDelete()
    {
    }
}
