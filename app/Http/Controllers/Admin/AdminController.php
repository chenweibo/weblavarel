<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


  public function index()
  {

       return view('AdminIndex');
  }

  public function indexPage(){


       return view('admin/index');
  }
}
