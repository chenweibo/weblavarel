<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

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
        $list = $content->where('type', 2)->paginate(10);
        return view('admin/content/Product', ['list'=>$list]);
    }
    public function ProductCreate()
    {
        return view('admin/content/ProductCreate');
    }
    public function ProductEdit()
    {
        return view('admin/content/ProductEdit');
    }
    public function ProductDelete()
    {
    }
}
