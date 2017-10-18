<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Zipper;

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
    public function RenameFile(Request $request)
    {
        $oldname = $request->path.'/'.$request->oldname;
        $name = $request->path.'/'.$request->name;
        $result = rename($oldname, $name);
        if ($result) {
            return ['code'=>1];
        } else {
            return ['code'=>0];
        }
    }
    public function DelFile(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type =='dir') {
                File::deleteDirectory($request->path.'/'.$request->name, $preserve = false);

                return ['code'=>1];
            }
            if ($request->type =='file') {
                unlink($request->path.'/'.$request->name);
                return ['code'=>1];
            }
        }
    }
    public function DeleteDir(Request $request)
    {
        //File::cleanDirectory('directory');
    }
    public function ZipFile(Request $request)
    {
        $name=explode('.', $request->name);
        $files = glob($request->path.'/'.$request->name);
        Zipper::make($request->path.'/'.$name[0].'.zip')->add($files)->close();
        return ['code'=>1];
    }
    public function GetFileContent(Request $request)
    {
        if ($request->ajax()) {
            $data=file_get_contents($request->file);
            return ['code'=>1,'data'=>$data];
        }
    }

    public function EditFile(Request $request)
    {
        if ($request->ajax()) {
            $data=File::put($request->file, $request->content);
            return ['code'=>1];
        }
    }
}
