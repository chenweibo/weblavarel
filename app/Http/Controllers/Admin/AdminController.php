<?php

namespace App\Http\Controllers\Admin;

use App\Node;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserType;
use Route;

class AdminController extends Controller
{
    public function index()
    {
        $node= new Node();
        $path=config_path().'\site.php';
        $route = Route::current();
        $name = Route::currentRouteName();
        $usertype= new UserType();
        $info=$usertype->getRoleInfo(2);
        $action = Route::currentRouteAction();
        return view('AdminIndex', ['username'=>session('adminuser'),'rolename'=>session('role'),'menu'=>$node->getMenu(session('rule'))]);
    }

    public function indexPage()
    {
        return view('admin/index');
    }


    public function site(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            if (File::put(config_path().'\site.php', ConfigBack($param))) {
                return ['code'=>'1','msg'=>'操作成功'];
            } else {
                return ['code'=>'0','msg'=>'发生未知错误联系管理员'];
            }
        }
        $data=File::getRequire(config_path().'\site.php');
        return view('admin/site/site', ['data'=>$data]);
    }

    public function SlideIndex($value='')
    {
        return view('admin/site/slide', ['data'=>$data]);
    }


    public function error()
    {
        return view('error');
    }
}
