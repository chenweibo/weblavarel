<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserType;

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
    public function UserCreate()
    {
        $role = UserType::all();

        return view('admin.user.UserCreate', ['role'=>$role]);
    }


    public function UserEdit()
    {
        return view('admin.user.UserEdit');
    }
    public function UserDelete()
    {
    }
}
