<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserType extends Model
{
    protected $table = 'role';

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
        return $this->get();
    }
}
