<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Content;

class ContentController extends Controller
{
    public function Page()
    {
        $content= new Content();
        $list = $content->where('type', 1)->orderBy('sort', 'asc')->get();
        return view('admin/content/Page', ['str'=>$list]);
    }
    public function PagedEdit()
    {
        return view('admin/content/PageEdit');
    }
}
