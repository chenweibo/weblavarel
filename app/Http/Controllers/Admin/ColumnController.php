<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Column;

class ColumnController extends Controller
{
    public function Column()
    {
        $column = new Column();
        $list = $column->where('lang', 'cn')->orderBy('sort', 'asc')->get()->toArray();
        $list = unlimitedForLever($list, '└―');
        $list1 = $column->where('lang', 'en')->orderBy('sort', 'asc')->get()->toArray();
        $list1 = unlimitedForLever($list1, '└―');
        return view('admin/column/Column', ['list'=>$list,'list1'=>$list1]);
    }
    public function ColumnCreate(Request $request)
    {
        $Column = new Column();
        if ($request->ajax()) {
            $param = $request->all();
            $param['pid']=explodepath($param['path']);
            $flag=$Column->ComlunInsert($param);
            return ['code' => $flag['code'], 'data' => route('Column'), 'msg' => $flag['msg']];
        }
        $list = $Column->orderBy('sort', 'asc')->get()->toArray();
        $list = unlimitedForLever($list, '--');
        return view('admin/column/ColumnCreate', ['data'=>$list]);
    }
    public function ColumnEdit(Request $request)
    {
        $Column = new Column();
        if ($request->ajax()) {
            $param = $request->all();
            $param['pid']=explodepath($param['path']);
            $flag=$Column->ComlunEdit($param);

            return ['code' => $flag['code'], 'data' => route('Column'), 'msg' => $flag['msg']];
        }
        $list = $Column->orderBy('sort', 'asc')->get()->toArray();
        $list = unlimitedForLever($list, '--');
        $str=Column::find($request->id);
        return view('admin/column/ColumnEdit', ['data'=>$list,'str'=>$str]);
    }

    public function ColumnDelete(Request $request)
    {
        $Column = new Column();
        if ($request->ajax()) {
            $flag=$Column->ComlunDelete($request->id);
            return ['code' => $flag['code'], 'data' => route('Column'), 'msg' => $flag['msg']];
        }
    }
}
