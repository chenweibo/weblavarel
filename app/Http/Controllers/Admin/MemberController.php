<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class MemberController extends Controller
{
    public function MemberIndex()
    {
        $user = new User();
        $list = $user->get();
        return view('admin/member/MemberIndex', ['list'=>$list]);
    }
    public function MemberCreate(Request $request)
    {
        $user = new User();
        if ($request->ajax()) {
            $param=$request->all();
            $param['password'] = bcrypt($param['password']);
            if ($user->insert($param)) {
                return ['code'=>1,'data'=>route('MemberIndex'),'msg'=>""];
            } else {
                return ['code'=>0];
            }
        }
        $status = config('admin.user_status');
        return view('admin/member/MemberCreate', ['status'=>$status]);
    }
    public function MemberEdit(Request $request)
    {
        $user = new User();

        if ($request->ajax()) {
            $param=$request->all();
            $param['password'] = bcrypt($param['password']);
            if ($user->where('id', $param['id'])->update($param)) {
                return ['code'=>1,'data'=>route('MemberIndex'),'msg'=>""];
            } else {
                return ['code'=>0];
            }
        }
        $data = $user->find($request->id);
        $status = config('admin.user_status');
        return view('admin/member/MemberEdit', ['status'=>$status,'data'=>$data]);
    }
    public function MemberDelete(Request $request)
    {
        $user = new User();
        if ($request->ajax()) {
            $id=$request->id;
            $flag=$user->where('id', $id)->delete();
            return ['code' => 1, 'data' => route('MemberIndex'), 'msg' => ''];
        }
    }
}
