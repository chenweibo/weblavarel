<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Content;
use App\Column;

class ContentController extends Controller
{
    public function Page()
    {
        $content= new Content();
        $list = $content->where('type', 1)->orderBy('sort', 'asc')->get();
        return view('admin/content/Page', ['str'=>$list]);
    }
    public function PageEdit(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $data=$content->where('id', $request->id)->update($request->all());
            if ($data) {
                return ['code' => 1, 'data' => route('Page'), 'msg' => '编辑成功'];
            } else {
                return ['code' => 0,  'msg' => '编辑失败'];
            }
        }
        $data = $content->where('id', $request->id)->get()->first();
        //dd($data->info);
        return view('admin/content/PageEdit', ['data'=>$data]);
    }

    public function Product(Request $request)
    {
        $content= new Content();
        $list=$content
            ->where('content.type', 2)
            ->join('columns', 'content.lid', '=', 'columns.id')
            ->select('content.*', 'columns.name as colums')
            ->paginate(10);
        return view('admin/content/Product', ['list'=>$list]);
    }
    public function ProductCreate(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=2;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentInsert($param);
            return ['code' => $flag['code'], 'data' => route('Product'), 'msg' => $flag['msg']];
        }

        $menu  = $Column->getTypeComlun(2);
        $menu = unlimitedForLever($menu, $html = '|-', level($menu), $level = 0);
        return view('admin/content/ProductCreate', ['str'=>$menu]);
    }
    public function ProductEdit(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=2;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentUpdate($param);
            return ['code' => $flag['code'], 'data' => route('Product'), 'msg' => $flag['msg']];
        }
        $menu  = $Column->getTypeComlun(2);
        $menu = unlimitedForLever($menu, $html = '|-', level($menu), $level = 0);
        $data = $content->where('id', $request->id)->get()->first();
        return view('admin/content/ProductEdit', ['str'=>$menu,'data'=>$data]);
    }
    public function ProductDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            $flag=$content->contentDelete($id);
            return ['code' => $flag['code'], 'data' => route('Product'), 'msg' => $flag['msg']];
        }
    }
}
