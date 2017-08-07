<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Overtrue\Pinyin\Pinyin;
use App\Column;
use App\Content;

class CommonController extends Controller
{
    public function uploads(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $originalName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $realPath = $file->getRealPath();//临时文件的绝对路径
                $type = $file->getClientMimeType();
                $filename = uniqid() . '.' . $ext;
                $bool = Storage::disk('uploads')->put('', $file);
                return $bool;
            }
        }
    }
    public function EditUploads(Request $request)
    {
        $file = $request->file('images');
        $data=[];
        foreach ($file as $v) {
            $bool = Storage::disk('uploads')->put('', $v);
            $data[]=asset('static/uploads').'/'.$bool;
        }
        return ['errno'=>0,'data'=>$data ] ;
    }

    public function rewrite(Request $request)
    {
        if ($request->isMethod('post')) {
            $pinyin = new Pinyin(); // 默认
            $res=$pinyin->permalink($request->name, '');
            return ['code'=>1,'res'=>$res];
        }
    }

//common ajax state
    public function ajaxState(Request $request)
    {
        $content= new Content();
        $Column = new Column();
        if ($request->ajax()) {
            if ($request->type == 'column') {
                $flag=$Column->updateState($request->id, ['state'=>$request->num]);
                return ['code' => $flag['code'], 'msg' => $flag['msg']];
            }
            if ($request->type == 'content_show') {
                $flag=$content->where('id', $request->id)->update(['show'=>$request->num]);
                return ['code' => 1, 'msg' => '成功'];
            }
            if ($request->type == 'content_recommend') {
                $flag=$content->where('id', $request->id)->update(['recommend'=>$request->num]);
                return ['code' => 1, 'msg' => '成功'];
            }
        }
    }
    public function ajaxSort(Request $request)
    {
        $Column = new Column();
        if ($request->ajax()) {
            if ($request->type == 'column') {
                $flag=$Column->updateState($request->id, ['sort'=>$request->sort]);
                return ['code' => $flag['code'], 'msg' => $flag['msg']];
            }

            if ($request->type == 'content') {
                $content = new Content();
                $content->where('id', $request->id)->update(['sort'=>$request->sort]);
                return ['code' => 1, 'msg' => '成功'];
            }
        }
    }

    public function weup(Request $request)
    {
        $file = $request->file('file');
        if ($file->isValid()) {
            $originalName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $realPath = $file->getRealPath();//临时文件的绝对路径
            $type = $file->getClientMimeType();
            $filename = uniqid() . '.' . $ext;
            $bool = Storage::disk('uploads')->put('', $file);
            return $bool;
        }
    }

    public function delImg(Request $request)
    {
        $img = $request->img;
        if ($request->ajax()) {
            $path = public_path('static/uploads').'/'.$img;
            Storage::disk('uploads')->delete($img);
            return 1;
        }
    }
}
