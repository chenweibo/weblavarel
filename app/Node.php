<?php

namespace app;

use Illuminate\Database\Eloquent\Model;
use App\UserType;

class Node extends Model
{
    protected $table = 'node';

    public function getMenu($nodeStr = '')
    {
        $where = empty($nodeStr) ? 'is_menu = 2' : 'is_menu = 2 and id in('.$nodeStr.')';
        if (empty($nodeStr)) {
            $result = $this->where('is_menu', 2)->orderBy('sort', 'asc')->get()->toArray();
        } else {
            $result = $this->where('is_menu', 2)->whereIn('id', explode(',', session('rule')))->orderBy('sort', 'asc')->get()->toArray();
        }
        $menu = prepareMenu($result);
        return $menu;
    }

    public function getNodeInfo($id)
    {
        $result = $this->select('id', 'node_name', 'typeid')->get()->toArray();
        $str = "";

        $role = new UserType();
        $rule = $role->getRuleById($id);

        if (!empty($rule)) {
            $rule = explode(',', $rule);
        }
        foreach ($result as $key=>$vo) {
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['typeid'] . '", "name":"' . $vo['node_name'].'"';

            if (!empty($rule) && in_array($vo['id'], $rule)) {
                $str .= ' ,"checked":1';
            }

            $str.= '},';
        }

        return "[" . substr($str, 0, -1) . "]";
    }
}
