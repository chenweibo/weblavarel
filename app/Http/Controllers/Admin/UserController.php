<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\UserType;
use App\AdminUser;
use App\Node;

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
            $user = new AdminUser();
            $flag = $user->DelUser($request->id);
            return ['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg'],'url'=>$request->getRequestUri()];
        }
    }
    public function Role()
    {
        $user = new UserType();
        $str = $user->getRole();
        return view('admin.user.Role', ['str'=>$str]);
    }
    public function RoleCreate(Request $request)
    {
        if ($request->ajax()) {
            $role = new UserType();
            $flag = $role->insertRole($request->all());
            return ['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']];
        }

        return view('admin.user.RoleCreate');
    }
    public function RoleEdit(Request $request)
    {
        if ($request->ajax()) {
            $role = new UserType();
            $flag = $role->editRole($request->all());
            return ['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']];
        }
        $str=DB::table('role')->where('id', $request->id)->get()->first();
        return view('admin.user.RoleEdit', ['str'=>$str]);
    }
    public function RoleDelete(Request $request)
    {
        if ($request->ajax()) {
            $role = new UserType();
            $flag = $role->delRole($request->id);
            return ['code' => $flag['code'], 'data' => route('Role'), 'msg' => $flag['msg']];
        }
    }
    public function giveAccess(Request $request)
    {
        $param = $request->all();
        $node = new Node();
        //获取现在的权限
        if ('get' == $param['type']) {
            $nodeStr = $node->getNodeInfo($param['id']);
            return ['code' => 1, 'data' => $nodeStr, 'msg' => 'success'];
        }
        //分配新权限
        if ('give' == $param['type']) {
            $doparam = [
              'id' => $param['id'],
              'rule' => $param['rule']
          ];
            $user = new UserType();
            $flag = $user->editAccess($doparam);
            return ['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']];
        }
    }
}
