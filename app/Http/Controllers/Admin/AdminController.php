<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\UserType;
class AdminController extends Controller
{


  public function index()
  {



       return view('AdminIndex',['username'=>session('adminuser'),'rolename'=>session('role')]);
  }

  public function indexPage(){


       return view('admin/index');
  }
}
