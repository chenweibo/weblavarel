<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $table = 'node';


    public function getMenu($nodeStr = '')

    {

        //超级管理员没有节点数组

        $where = empty($nodeStr) ? 'is_menu = 2' : 'is_menu = 2 and id in('.$nodeStr.')';



        $result = db('node')->field('id,node_name,typeid,control_name,action_name,style,sort')

            ->where($where)->order('sort asc')->select();

        $menu = prepareMenu($result);



        return $menu;

    }
}
