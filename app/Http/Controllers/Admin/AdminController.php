<?php

namespace App\Http\Controllers\Admin;

use App\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserType;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{


  public function index()
  {
     $node= new Node();
     $path=config_path().'\text.php';
     
      return view('AdminIndex',['username'=>session('adminuser'),'rolename'=>session('role'),'menu'=>$node->getMenu(session('rule'))]);
  }

  public function indexPage(){


       return view('admin/index');
  }
}
