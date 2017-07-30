<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Overtrue\Pinyin\Pinyin;

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
    public function rewrite(Request $request)
    {
        if ($request->isMethod('post')) {
            $pinyin = new Pinyin(); // 默认
            $res=$pinyin->permalink($request->name, '');
            return ['code'=>1,'res'=>$res];
        }
    }
}
