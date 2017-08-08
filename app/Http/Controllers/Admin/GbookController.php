<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gbook;

class GbookController extends Controller
{
    public function GbookIndex()
    {
        $gbook = new Gbook();
        $list = $gbook->get();
        return view('admin/gbook/GbookIndex', ['list'=>$list]);
    }
    public function GbookEdit(Request $request)
    {
        $gbook = new Gbook();

        if ($request->ajax()) {
            $param=$request->all();
            if ($gbook->where('id', $param['id'])->update($param)) {
                return ['code'=>1,'data'=>route('MemberIndex'),'msg'=>""];
            } else {
                return ['code'=>0];
            }
        }
        $data = $gbook->find($request->id);
        return view('admin/gbook/GbookEdit', ['data'=>$data]);
    }
    public function GbookDelete(Request $request)
    {
        $gbook = new Gbook();
        if ($request->ajax()) {
            $id=$request->id;
            $flag=$gbook->where('id', $id)->delete();
            return ['code' => 1, 'data' => route('GbookIndex'), 'msg' => ''];
        }
    }
}
