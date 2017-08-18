<?php

namespace App\Http\Controllers\Admin;

use App\Node;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\UserType;
use App\Content;
use App\Gbook;
use Route;

class AdminController extends Controller
{
    public function index()
    {
        $node= new Node();
        $usertype= new UserType();
        $info=$usertype->getRoleInfo(2);

        return view('AdminIndex', ['username'=>session('adminuser'),'rolename'=>session('role'),'menu'=>$node->getMenu(session('rule'))]);
    }

    public function indexPage(Request $request)
    {
        $content= new Content();
        $gbook = new Gbook();
        $page = $content->where('type', 1)->count();
        $product = $content->where('type', 2)->count();
        $article = $content->where('type', 3)->count();
        $image = $content->where('type', 4)->count();
        $down = $content->where('type', 5)->count();
        $book = $gbook->count();
        $data = unserialize(file_get_contents(public_path('tongji.db')));
        return view('admin/index', ['data'=>$data,'page'=>$page,'product'=>$product,'article'=>$article,'image'=>$image,'down'=>$down,'gbook'=>$book]);
    }

    public function site(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            if (File::put(config_path().'/site.php', ConfigBack($param))) {
                return ['code'=>'1','msg'=>'操作成功'];
            } else {
                return ['code'=>'0','msg'=>'发生未知错误联系管理员'];
            }
        }
        $data=File::getRequire(config_path().'/site.php');
        return view('admin/site/Site', ['data'=>$data]);
    }

    public function SlideIndex($value='')
    {
        $str=DB::table('slide')->get();
        return view('admin/site/Slide', ['str'=>$str]);
    }

    public function SlideCreate(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            $data=DB::table('slide')->insert($param);
            if ($data) {
                return ['code'=>'1','msg'=>'操作成功','data'=> route('SlideIndex') ];
            } else {
                return ['code'=>'0','msg'=>'操作失败联系管理员'];
            }
        }
        $slide_type=$request->slide_type;
        return view('admin/site/SlideCreate')->with('slide_type', $slide_type);
    }

    public function SlideEdit(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            $data=DB::table('slide')->where('id', $param['id'])->update($param);
            if ($data) {
                return ['code'=>'1','msg'=>'操作成功','data'=> route('SlideIndex') ];
            } else {
                return ['code'=>'0','msg'=>'操作失败联系管理员'];
            }
        }
        $data = DB::table('slide')->where('id', $request->id)->get()->first();
        return view('admin/site/SlideEdit')->with('data', $data);
    }

    public function SlideDelete(Request $request)
    {
        if ($request->ajax()) {
            $id=$request->id;
            if (DB::table('slide')->where('id', $id)->delete()) {
                return ['code'=>'1'];
            } else {
                return ['code'=>'0'];
            }
        }
        return ['code'=>1];
    }


    public function error()
    {
        return view('error');
    }

    public function Statistics(Request $request)
    {
        $param= $request->all();
        if (!empty($param)) {
            return ['data'=>'傻逼别访问了。'];
        }
        $file = public_path('tongji.db');
//$data = unserialize(file_get_contents($file));
 $fp=fopen($file, 'r+');
        $content='';

        if (flock($fp, LOCK_EX)) {
            while (($buffer=fgets($fp, 1024))!=false) {
                $content=$content.$buffer;
            }
            $data=unserialize($content);

//设置记录键值
     $total = 'total';
            $month = date('Ym');
            $today = date('Ymd');
            $yesterday = date('Ymd', strtotime("-1 day"));
            $tongji = array();
// 总访问增加
     $tongji[$total] = $data[$total] + 1;
// 本月访问量增加
     $tongji[$month] = $data[$month] + 1;
// 今日访问增加
     $tongji[$today] = $data[$today] + 1;
//保持昨天访问
     $tongji[$yesterday] = $data[$yesterday];

//保存统计数据
     ftruncate($fp, 0); // 将文件截断到给定的长度
     rewind($fp); // 倒回文件指针的位置
     fwrite($fp, serialize($tongji));
            flock($fp, LOCK_UN);
            fclose($fp);

//输出数据
     $total = $tongji[$total];
            $month = $tongji[$month];
            $today = $tongji[$today];
            $yesterday = $tongji[$yesterday]?$tongji[$yesterday]:0;
        }
    }
}
