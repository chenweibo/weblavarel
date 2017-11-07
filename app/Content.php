<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Content extends Model
{
    protected $table = 'content';

    public function column()
    {
        return $this->belongsTo('App\Column', 'lid', 'id');
    }
    public function contentInsert($param)
    {
        try {
            $this->insert($param);
            return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    public function contentUpdate($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function contentDelete($id)
    {
        try {
            $this->where('id', $id)->delete();

            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function click($id)
    {
        DB::table('content')->where('id', $id)->increment('click', 1);
    }
}
