<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

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
}
