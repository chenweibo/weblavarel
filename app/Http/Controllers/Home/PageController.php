<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Content;
use Validator;
use Illuminate\Support\Facades\Storage;
use File;
use App\User;
use Hash;

class PageController extends Controller
{
    public function about()
    {
        return view('home/about');
    }
    public function culture()
    {
        return view('home/culture');
    }
    public function honor()
    {
        $content = new Content();
        $list = $content->where(['show'=>1,'type'=>4,'lid'=>1,'lang'=>'cn'])->orderBy('sort', 'asc')->get();
        return view('home/honor', ['list'=>$list]);
    }
    public function device()
    {
        $content = new Content();
        $list = $content->where(['show'=>1,'type'=>4,'lid'=>7,'lang'=>'cn'])->orderBy('sort', 'asc')->get();
        return view('home/device', ['list'=>$list]);
    }
    public function news()
    {
        $content = new Content();
        $list = $content->where(['show'=>1,'type'=>3,'lid'=>8,'lang'=>'cn'])->orderBy('sort', 'asc')->get();
        return view('home/news', ['list'=>$list]);
    }
    public function newsview($id)
    {
        $content = new Content();
        $data = $content->where(['show'=>1,'id'=>$id,'lang'=>'cn'])->orderBy('sort', 'asc')->get()->first();
        $next = $content->where(['show'=>1,'type'=>3,'lang'=>'cn'])->where('id', '>', $id)->orderBy('sort', 'asc')->limit(1)->get()->first();
        $prev = $content->where(['show'=>1,'type'=>3,'lang'=>'cn'])->where('id', '<', $id)->orderBy('sort', 'asc')->limit(1)->get()->first();
        return view('home/newsview', ['data'=>$data,'prev'=>$prev,'next'=>$next]);
    }
    public function feedback(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),
              [
                  'title' => 'required',
                  'telephone' => 'required',
                  'content' => 'required',
                  'telephone'=>'regex:/^1[34578][0-9]{9}$/',

              ], [
                  'title.required' => '您的姓名不能为空',
                  'telephone.required' => '联系号码不能为空',
                  'content.required' => '内容不能为空',
                  'telephone.regex' => '手机格式不对',
              ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return ['code' => -1, 'msg' => $errors];
            } else {
                DB::table('gbooks')->insert($request->all());
                return ['code' => 1, 'msg' => '留言成功'];
            }
        }
        $time=date("Y-m-d H:i:s");
        return view('home/feedback', ['time'=>$time]);
    }
    public function order(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'telephone' => 'required',
                'content' => 'required',
                'telephone'=>'regex:/^1[34578][0-9]{9}$/',

            ], [
                'name.required' => '您的姓名不能为空',
                'telephone.required' => '联系号码不能为空',
                'content.required' => '内容不能为空',
                'telephone.regex' => '手机格式不对',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->first();
                return ['code' => -1, 'msg' => $errors];
            } else {
                DB::table('gbooks')->insert($request->all());
                return ['code' => 1, 'msg' => '留言成功'];
            }
        }
        $time=date("Y-m-d H:i:s");
        return view('home/order', ['time'=>$time]);
    }
    public function contact()
    {
        return view('home/contact');
    }
    public function map()
    {
        return view('home/map');
    }
    public function download()
    {
        $path = public_path('uploads');
        $content = new Content();
        $list = $content->where(['show'=>1,'type'=>5,'lang'=>'cn'])->orderBy('sort', 'asc')->get()->toArray();

        foreach ($list as $v=>$val) {
            $list[$v]['filesize'] =Storage::disk('uploads')->size($val['down'])/1024/1024;
        }


        return view('home/download', ['list'=>$list]);
    }
    public function userdown(Request $request)
    {
        if (!session('memberusername')) {
            return ['code' => 0];
        } else {
            $content = new Content();
            $down = $content->where(['lang'=>'cn','id'=>$request->id])->get()->first();
            return ['code' => 1,'url'=>asset('static/uploads').'/'.$down->down];
        }
    }
    public function userlogin(Request $request)
    {
        $user = new User();
        $result = $user->where('email', $request->username)->get()->first();
        if (empty($result)) {
            return ['code' => 0, 'msg' => '用户不存在'];
        } elseif (!Hash::check($request->password, $result->password)) {
            return ['code' => 0, 'msg' => '密码错误请重新输入'];
        } else {
            session(['memberusername' => $request->username]);
            return ['code' => 1];
        }
    }
    public function userloginout(Request $request)
    {
        $request->session()->forget('memberusername');
        return back();
    }
}
