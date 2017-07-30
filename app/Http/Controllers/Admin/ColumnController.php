<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Column;

class ColumnController extends Controller
{
    public function Column()
    {
        $column = new Column();
        $list = $column->orderBy('sort', 'asc')->get()->toArray();
        $list = unlimitedForLever($list, '└―');
        return view('admin/column/Column', ['list'=>$list]);
    }
    public function ColumnCreate(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            $Column = new Column();
            $flag=$Column->ComlunInsert($param);
            return ['code' => $flag['code'], 'data' => route('Column'), 'msg' => $flag['msg']];
        }
        return view('admin/column/ColumnCreate');
    }
}
