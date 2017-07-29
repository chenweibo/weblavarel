<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Route;

class UserType extends Model
{
    protected $table = 'role';
    public $timestamps = false;
    public function getRoleInfo($id)
    {
        $result = $this->where('id', $id)->get()->first()->toArray();
        if (empty($result['rule'])) {
            $where = '';
        } else {
            $where =$result['rule'];
        }
        $res = DB::table('node')->whereIn('id', explode(',', $where))->get();
//      $res = get_object_vars($res);
        foreach ($res as $key) {
            if ('#' != $key->mark) {
                $result['route'][] = $key->route;
            }
        }
        return $result;
    }
    public function getRole()
    {
        $result = $this->get();
        return $result;
    }

    public function getRuleById($id)
    {
        $res = $this->where('id', $id)->select('rule')->get()->first()->toArray();

        return $res['rule'];
    }

    public function editAccess($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            return ['code' => 1, 'data' => '', 'msg' => '分配权限成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function delRole($id)
    {
        try {
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除角色成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function insertRole($param)
    {
        try {
            $this->insert($param);
            return ['code' => 1, 'data' => route('Role'), 'msg' => '添加成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    public function editRole($param)
    {
        try {
            $this->where('id', $param['id'])->update($param);
            return ['code' => 1, 'data' => route('Role'), 'msg' => '编辑成功'];
        } catch (PDOException $e) {
            return ['code' => 0, 'data' => route('Role'), 'msg' => $e->getMessage()];
        }
    }
}
