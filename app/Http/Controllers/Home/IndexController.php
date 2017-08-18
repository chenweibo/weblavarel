<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class IndexController extends Controller
{
    public function index()
    {
        $content = new Content();
        $news = $content->where(['show'=>1,'type'=>3,'lid'=>8,'lang'=>'cn'])->orderBy('sort', 'asc')->limit(8)->get();
        return view('home/index', ['news'=>$news]);
    }
}
