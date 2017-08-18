<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;
use App\Column;

class ProductController extends Controller
{
    public function product()
    {
        $Column = new  Column();
        $cate  = $Column->getWhereComlun(['type'=>2,'lang'=>'cn','state'=>1]);
        $cate = make_tree($cate, $pk='id', $pid='pid', $child='children', $root=level($cate));
        return view('home/product', ['cate'=>$cate]);
    }
    public function productlist(Request $request, $rewrite)
    {
        $Column = new  Column();
        $catename = $Column->where('rewrite', $rewrite)->get()->first();
        if (empty($catename)) {
            abort(404);
        }
        $content = new Content();
        $list = $content->where(['lid'=>$catename->id ,'show'=>1,'lang'=>'cn'])->get();
        $cate  = $Column->getWhereComlun(['type'=>2,'lang'=>'cn','state'=>1]);
        $cate = make_tree($cate, $pk='id', $pid='pid', $child='children', $root=level($cate));
        $nn = $Column->where('id', $catename->pid)->get()->first();
        return view('home/productlist', ['cate'=>$cate,'list'=>$list,'nn'=>$nn,'catename'=>$catename]);
    }
    public function productview(Request $request, $rewrite)
    {
        $Column = new  Column();
        $content = new Content();
        $data = $content->where(['lang'=>'cn','show'=>1,'rewrite'=>$rewrite])->get()->first();
        $cate  = $Column->getWhereComlun(['type'=>2,'lang'=>'cn','state'=>1]);
        $catename = $Column->where('id', $data->lid)->get()->first();
        $nn = $Column->where('id', $catename->pid)->get()->first();
        $cate = make_tree($cate, $pk='id', $pid='pid', $child='children', $root=level($cate));

        return view('home/productview', ['cate'=>$cate,'data'=>$data,'catename'=>$catename,'nn'=>$nn]);
    }

    public function search(Request $request)
    {
        $Column = new  Column();
        $content = new Content();
        $map[]=['name','like','%'.$request->keys.'%'];
        $map[]=['lang','=','cn'];
        $map[]=['show','=',1];
        $map[]=['type','=',2];
        $list = $content->where($map)->get();
        $cate  = $Column->getWhereComlun(['type'=>2,'lang'=>'cn','state'=>1]);
        $cate = make_tree($cate, $pk='id', $pid='pid', $child='children', $root=level($cate));

        return view('home/search', ['cate'=>$cate,'list'=>$list,'keys'=>$request->keys]);
    }
}
