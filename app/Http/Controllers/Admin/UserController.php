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
            $user = new AdminUser();
            $flag=$user->InsertUser($param);
            return ['code' => $flag['code'], 'data' => route('UserIndex'), 'msg' => $flag['msg']];
        }
        $role = UserType::all();
        $status = config('admin.user_status');
        return view('admin.user.UserCreate', ['role'=>$role,'status'=>$status]);
    }


    public function UserEdit(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            $param['password']=Crypt::encryptString($param['password']);
            $user = new AdminUser();
            $flag=$user->EditUser($param);
            return ['code' => $flag['code'], 'data' => route('UserIndex'), 'msg' => $flag['msg']];
        }

        $role = UserType::all();
        $status = config('admin.user_status');
        $data = DB::table('admin_user')->where('id', $request->id)->get()->first();
        return view('admin.user.UserEdit', ['role'=>$role,'status'=>$status,'data'=>$data]);
    }
    public function UserDelete(Request $request)
    {
        if ($request->ajax()) {
            DB::table('admin_user')->where('id', $request->id)->delete();
            return ['code' => 1];
        }
    }
}
