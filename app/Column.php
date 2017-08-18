<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Column extends Model
{
    protected $table = 'columns';
    public $timestamps = false;


    public function content()
    {
        return $this->hasOne('App\Content', 'lid');
    }

    public function ComlunInsert($param)
    {
        try {
            $id=$this->insertGetId($param);
            if ($param['type']==1) {
                $str= ['name'=>$param['name'],'lid'=>$id,'type'=>$param['type'],'path'=>$param['path']];
                DB::table('content')->insert($str);
            }
            return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function ComlunEdit($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            if ($param['type']==1) {
                $c=DB::table('content')->where('lid', $param['id'])->get();
                if ($c->isEmpty()) {
                    $str= ['name'=>$param['name'],'lid'=>$param['id'],'type'=>$param['type'],'path'=>$param['path']];
                    DB::table('content')->insert($str);
                } else {
                    $str= ['name'=>$param['name'],'lid'=>$param['id'],'type'=>$param['type'],'path'=>$param['path']];
                    DB::table('content')->where('id', $c->first()->id)->update($str);
                }
            }
            return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function ComlunDelete($id)
    {
        try {
            $param =  $this->where('id', $id)->get()->first();
            if ($param->type==1) {
                DB::table('content')->where('lid', $id)->delete();
            }
            $this->where('id', $id)->delete();

            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function updateState($id, $param)
    {
        try {
            $this->where('id', $id)->update($param);
            return ['code' => 1, 'data' => '', 'msg' => '更新成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function getTypeComlun($type)
    {
        return $this->where('type', $type)->orderBy('sort', 'asc')->get()->toArray();
    }
    public function getWhereComlun($where)
    {
        return $this->where($where)->orderBy('sort', 'asc')->get()->toArray();
    }
}
