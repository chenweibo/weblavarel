<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class FilesController extends Controller
{
    public function Files()
    {
        return view('admin/files/index');
    }
    public function GetFiles(Request $request)
    {
        $file=File::files(base_path($request->path));
        $dir = File::directories(base_path($request->path));
        foreach ($file as $v) {
            $handle = fopen($v, "r");
            $fstat = fstat($handle);
            $fileResult[]=basename($v).';'.round($fstat["size"]/1024, 2).';'.$fstat["mtime"];
            //$fileResult[]=  File::type($v);
        }
        foreach ($dir as $v) {
            $dirResult[]=basename($v).';'.round(filesize($v)/1024, 2).';'.filemtime($v);
            //$fileResult[]=  File::type($v);
        }


        return ['dir'=>$dirResult,'file'=>$fileResult,'path'=>base_path($request->path) ];
    }
}
