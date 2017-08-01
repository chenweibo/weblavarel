<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';
    public $timestamps = false;


    public function ComlunInsert($param)
    {
        try {
            $this->insert($param);
            return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function ComlunEdit($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function ComlunDelete($id)
    {
        try {
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
}
