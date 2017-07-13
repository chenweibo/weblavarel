<?php

namespace App\Http\Controllers\Admin;

use App\Node;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserType;



class AdminController extends Controller
{


  public function index()
  {
     $node= new Node();
     $path=config_path().'\site.php';

      return view('AdminIndex',['username'=>session('adminuser'),'rolename'=>session('role'),'menu'=>$node->getMenu(session('rule'))]);
  }

  public function indexPage(){


       return view('admin/index');
  }
}
