<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Events\MoveRecycle;
use App\Events\FieldEvent;
use App\Recycle;
use App\Content;
use App\Column;
use App\Field;

class ContentController extends Controller
{
    public function Page()
    {
        $content= new Content();
        $list = $content->where('type', 1)->orderBy('sort', 'asc')->get();
        return view('admin/content/Page', ['str'=>$list]);
    }
    public function PageEdit(Request $request)
    {
        $content= new Content();
        $field= new Field();
        if ($request->ajax()) {
            $data=$content->where('id', $request->id)->update($request->all());
            if ($data) {
                return ['code' => 1, 'data' => route('Page'), 'msg' => '编辑成功'];
            } else {
                return ['code' => 0,  'msg' => '编辑失败'];
            }
        }
        $file= $field->where('type', 1)->orderBy('sort', 'asc')->get();
        $data = $content->where('id', $request->id)->get()->first()->toArray();
        //dd($data->info);
        return view('admin/content/PageEdit', ['data'=>$data,'file'=>$file]);
    }

    public function Product(Request $request, $id="", $keys="")
    {
        $Column = new Column();
        $content= new Content();
        $map[] = ['content.type','=',2];
        if (!empty($request->path) && empty($request->keys)) {
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        if (empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
        }
        if (!empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        $list=$content
          ->where($map)
          ->join('columns', 'content.lid', '=', 'columns.id')
          ->select('content.*', 'columns.name as colums')
          ->paginate(10);
        $menu  = $Column->getTypeComlun(2);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        return view('admin/content/Product', ['list'=>$list,'cate'=>$menu,'keys'=>$request->keys,'id'=>$request->path]);
    }
    public function ProductCreate(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $pid = $request->pid;
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=2;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentInsert($param);
            return ['code' => $flag['code'], 'data' => route('Product').'?path='.$param['lid'], 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 2)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(2);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }

        return view('admin/content/ProductCreate', ['str'=>$menu ,'file'=>$file,'pid'=>$request->pid]);
    }
    public function ProductEdit(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->except('lastUrl');
            $param['type']=2;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentUpdate($param);
            return ['code' => $flag['code'], 'data' => $request->lastUrl, 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 2)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(2);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        $data = $content->where('id', $request->id)->get()->first()->toArray();
        return view('admin/content/ProductEdit', ['str'=>$menu,'data'=>$data,'file'=>$file]);
    }
    public function ProductDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            $list=$content->where('id', $id)->get()->first()->toArray();
            $content->where('id', $id)->delete();
            event(new MoveRecycle($list));
            return ['code' => 1, 'data' => route('Product'), 'msg' => ''];
        }
    }
    public function ProductMoreDelete(Request $request)
    {
        $content= new Content();

        if ($request->ajax()) {
            $id=$request->id;
            foreach ($id as $v) {
                $list=$content->where('id', $v)->get()->first()->toArray();
                $content->destroy($v);
                event(new MoveRecycle($list));
            }
            return ['code' => 1, 'data' => route('Product'), 'msg' => ''];
        }
    }

    public function RecycleIndex()
    {
        $recycle = new Recycle();
        $list = $recycle->paginate(10);

        return view('admin/content/RecycleIndex', ['list'=>$list]);
    }
    public function RecycleRecover(Request $request)
    {
        $content= new Content();
        $id=$request->id;
        $recycle = new Recycle();
        $data= $recycle->where('id', $id)->get()->first()->toArray();
        if ($request->ajax()) {
            if ($content->insert($data)) {
                $recycle->destroy($id);
                return ['code' => 1, 'data' => route('RecycleIndex'), 'msg' => ''];
            } else {
                return ['code' => 0];
            }
        }
    }

    public function RecycleDelete(Request $request)
    {
        $recycle = new Recycle();
        if ($request->ajax()) {
            $id=$request->id;
            $recycle->where('id', $id)->delete();
            return ['code' => 1, 'data' => route('RecycleIndex'), 'msg' => ''];
        }
    }

    public function FieldIndex(Request $request)
    {
        $field = new Field();
        $list = $field->get();
        $dd= new Schema();
        return view('admin/content/FieldIndex', ['list'=>$list]);
    }
    public function FieldCreate(Request $request)
    {
        $field = new Field();
        if ($request->ajax()) {
            $param = $request->all();
            if ($request->type!=6) {
                if (Schema::hasColumn('content', $param['column_name'])) {
                    return ['code' => 0,  'msg' => '表字段已存在，换个名称'];
                } else {
                    $field->insert($param);
                    event(new FieldEvent($param['column_name'], $param['column_type'], $param['type']));
                    return ['code' => 1, 'data' => route('FieldIndex'), 'msg' => ''];
                }
            } else {
                if (Schema::hasColumn('gbook', $param['column_name'])) {
                    return ['code' => 0,  'msg' => '表字段已存在，换个名称'];
                } else {
                    $field->insert($param);
                    event(new FieldEvent($param['column_name'], $param['column_type'], $param['type']));

                    return ['code' => 1, 'data' => route('FieldIndex'), 'msg' => ''];
                    # code...
                }
            }
        }
        return view('admin/content/FieldCreate');
    }
    public function FieldDelete(Request $request)
    {
        $field = new Field();
        $data = $field->find($request->id);
        if ($request->isMethod('post')) {
            if ($data->type!=6) {
                $field->where('id', $request->id)->delete();
                DB::statement('alter table content drop column '.$data->column_name);
                DB::statement('alter table recycles drop column '.$data->column_name);
                return ['code' => 1, 'data' => route('FieldIndex'), 'msg' => ''];
            } else {
                $field->where('id', $request->id)->delete();
                DB::statement('alter table gbooks drop column '.$data->column_name);
                return ['code' => 1, 'data' => route('FieldIndex'), 'msg' => ''];
            }
        }
    }


    public function Aritcle(Request $request, $id="", $keys="")
    {
        $Column = new Column();
        $content= new Content();
        $map[] = ['content.type','=',3];
        if (!empty($request->path) && empty($request->keys)) {
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        if (empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
        }
        if (!empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        $list=$content
          ->where($map)
          ->join('columns', 'content.lid', '=', 'columns.id')
          ->select('content.*', 'columns.name as colums')
          ->paginate(10);
        $menu  = $Column->getTypeComlun(3);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }

        return view('admin/content/Aritcle', ['list'=>$list,'cate'=>$menu,'keys'=>$request->keys,'id'=>$request->path]);
    }
    public function AritcleCreate(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $pid = $request->pid;
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=3;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentInsert($param);
            return ['code' => $flag['code'], 'data' => route('Aritcle').'?path='.$param['lid'], 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 3)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(3);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        return view('admin/content/AritcleCreate', ['str'=>$menu ,'file'=>$file,'pid'=>$request->pid]);
    }
    public function AritcleEdit(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=3;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentUpdate($param);
            return ['code' => $flag['code'], 'data' => route('Aritcle'), 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 3)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(3);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        $data = $content->where('id', $request->id)->get()->first()->toArray();
        return view('admin/content/AritcleEdit', ['str'=>$menu,'data'=>$data,'file'=>$file]);
    }
    public function AritcleDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            $list=$content->where('id', $id)->get()->first()->toArray();
            $content->where('id', $id)->delete();
            event(new MoveRecycle($list));
            return ['code' => 1, 'data' => route('Aritcle'), 'msg' => ''];
        }
    }
    public function AritcleMoreDelete(Request $request)
    {
        $content= new Content();

        if ($request->ajax()) {
            $id=$request->id;
            foreach ($id as $v) {
                $list=$content->where('id', $v)->get()->first()->toArray();
                $content->destroy($v);
                event(new MoveRecycle($list));
            }
            return ['code' => 1, 'data' => route('Aritcle'), 'msg' => ''];
        }
    }

    public function Image(Request $request, $id="", $keys="")
    {
        $Column = new Column();
        $content= new Content();
        $map[] = ['content.type','=',4];
        if (!empty($request->path) && empty($request->keys)) {
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        if (empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
        }
        if (!empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        $list=$content
          ->where($map)
          ->join('columns', 'content.lid', '=', 'columns.id')
          ->select('content.*', 'columns.name as colums')
          ->paginate(10);
        $menu  = $Column->getTypeComlun(4);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menued = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menued = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
            if (count($menu)!=count($menued)) {
                foreach ($menu as $key => $value) {
                    $menu[$key]['html']='';
                }
                $menu = $menu;
            } else {
                $menu = $menued;
            }
        }

        return view('admin/content/Image', ['list'=>$list,'cate'=>$menu,'keys'=>$request->keys,'id'=>$request->path]);
    }
    public function ImageCreate(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $pid = $request->pid;
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=4;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentInsert($param);
            return ['code' => $flag['code'], 'data' => route('Image').'?path='.$param['lid'], 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 4)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(4);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menued = unlimitedForLever($menu, $html = '|-');
                    break;
                } else {
                    $menued = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
            if (count($menu)!=count($menued)) {
                foreach ($menu as $key => $value) {
                    $menu[$key]['html']='';
                }
                $menu = $menu;
            } else {
                $menu = $menued;
            }
        }
        return view('admin/content/ImageCreate', ['str'=>$menu ,'file'=>$file,'pid'=>$pid]);
    }
    public function ImageEdit(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=4;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentUpdate($param);
            return ['code' => $flag['code'], 'data' => route('Image'), 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 4)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(4);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menued = unlimitedForLever($menu, $html = '|-');
                    break;
                } else {
                    $menued = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
            if (count($menu)!=count($menued)) {
                foreach ($menu as $key => $value) {
                    $menu[$key]['html']='';
                }
                $menu = $menu;
            } else {
                $menu = $menued;
            }
        }

        $data = $content->where('id', $request->id)->get()->first()->toArray();
        return view('admin/content/ImageEdit', ['str'=>$menu,'data'=>$data,'file'=>$file]);
    }
    public function ImageDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            $list=$content->where('id', $id)->get()->first()->toArray();
            $content->where('id', $id)->delete();
            event(new MoveRecycle($list));
            return ['code' => 1, 'data' => route('Image'), 'msg' => ''];
        }
    }
    public function ImageMoreDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            foreach ($id as $v) {
                $list=$content->where('id', $v)->get()->first()->toArray();
                $content->destroy($v);
                event(new MoveRecycle($list));
            }
            return ['code' => 1, 'data' => route('Image'), 'msg' => ''];
        }
    }

    public function Down(Request $request, $id="", $keys="")
    {
        $Column = new Column();
        $content= new Content();
        $map[] = ['content.type','=',5];
        if (!empty($request->path) && empty($request->keys)) {
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        if (empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
        }
        if (!empty($request->path) && !empty($request->keys)) {
            $map[]=['content.name','like','%'.$request->keys.'%'];
            $map[]=['content.path','like','%-'.$request->path.'%'];
        }
        $list=$content
          ->where($map)
          ->join('columns', 'content.lid', '=', 'columns.id')
          ->select('content.*', 'columns.name as colums')
          ->paginate(10);
        $menu  = $Column->getTypeComlun(5);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }

        return view('admin/content/Down', ['list'=>$list,'cate'=>$menu,'keys'=>$request->keys,'id'=>$request->path]);
    }
    public function DownCreate(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $pid = $request->pid;
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=5;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentInsert($param);
            return ['code' => $flag['code'], 'data' => route('Down').'?path='.$param['lid'], 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 5)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(5);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        return view('admin/content/DownCreate', ['str'=>$menu ,'file'=>$file,'pid'=>$request->pid]);
    }
    public function DownEdit(Request $request)
    {
        $Column = new Column();
        $content= new Content();
        $field= new Field();
        if ($request->ajax()) {
            $param=$request->all();
            $param['type']=5;
            $param['lid']=explodepath($param['path']);
            $flag=$content->contentUpdate($param);
            return ['code' => $flag['code'], 'data' => route('Down'), 'msg' => $flag['msg']];
        }
        $file= $field->where('type', 5)->orderBy('sort', 'asc')->get();
        $menu  = $Column->getTypeComlun(5);
        if (empty($menu)) {
            $menu = [];
        } else {
            foreach ($menu as $v) {
                if ($v['pid']==0) {
                    $menu = unlimitedForLever($menu, $html = '|-');
                } else {
                    $menu = unlimitedForLever($menu, $html = '|-', $pid=level($menu));
                }
            }
        }
        $data = $content->where('id', $request->id)->get()->first()->toArray();
        return view('admin/content/DownEdit', ['str'=>$menu,'data'=>$data,'file'=>$file]);
    }
    public function DownDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            $list=$content->where('id', $id)->get()->first()->toArray();
            $content->where('id', $id)->delete();
            event(new MoveRecycle($list));
            return ['code' => 1, 'data' => route('Down'), 'msg' => ''];
        }
    }
    public function DownMoreDelete(Request $request)
    {
        $content= new Content();
        if ($request->ajax()) {
            $id=$request->id;
            foreach ($id as $v) {
                $list=$content->where('id', $v)->get()->first()->toArray();
                $content->destroy($v);
                event(new MoveRecycle($list));
            }
            return ['code' => 1, 'data' => route('Down'), 'msg' => ''];
        }
    }
}
