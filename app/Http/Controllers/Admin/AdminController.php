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
     return view('AdminIndex',['username'=>session('adminuser'),'rolename'=>session('role'),'menu'=>$node->getMenu(session('rule'))]);
  }

  public function indexPage(){

     return view('admin/index');
  }

  public function site(Request $request)
  {

    if($request->ajax())
    {
         $param = $request->all();
      }
     $data=File::getRequire(config_path().'\site.php');
     return view('admin/site',['data'=>$data]);
  }
  public function error(){


       return view('error');
  }

}
