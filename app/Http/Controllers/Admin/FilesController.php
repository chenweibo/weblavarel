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
        if ($request->path=='/' or '') {
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
            $path = base_path();
        } else {
            $file=File::files($request->path);
            $dir = File::directories($request->path);
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
            $path = $request->path;
        }

        return ['dir'=>empty($dir) ? $dir : $dirResult,'file'=>empty($file) ? $file : $fileResult,'path'=>$path,'root'=>base_path() ];
    }
    public function RenameFile()
    {
    }
    public function DelFile()
    {
    }
    public function DeleteDir()
    {
    }
    public function EditFile()
    {
    }
}
