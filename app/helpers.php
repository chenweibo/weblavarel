<?php


//Arrangement menu

function prepareMenu($param)
{
    $parent = []; //father
    $child = [];  //son

    foreach ($param as $key => $vo) {
        if ($vo['typeid'] == 0) {
            $vo['href'] = '#';
            $parent[] = $vo;
        } else {
            $vo['href'] = empty($vo['route']) ? '#' : route($vo['route']); //
            $child[] = $vo;
        }
    }

    foreach ($parent as $key => $vo) {
        foreach ($child as $k => $v) {
            if ($v['typeid'] == $vo['id']) {
                $parent[$key]['child'][] = $v;
            }
        }
    }
    unset($child);

    return $parent;
}

//Rewrite Config

function ConfigBack($str)
{
    $a = '<?php

return [
'.PHP_EOL;
    foreach ($str as $key => $vo) {
        $a .= "'".$key."'".'=>'."'".$vo."'".','.PHP_EOL;
    }

    $a .= PHP_EOL.'];';

    return $a;
}

function columnMenu($result, $parentid=0, $format="|--")
{
    /*记录排序后的类别数组*/
    static $list=array();
    foreach ($result as $k => $v) {
        if ($v['pid']==$parentid) {
            if ($parentid!=0) {
                $v['name']=$format.$v['name'];
            }
            /*将该类别的数据放入list中*/
            $list[]=$v;
            columnMenu($result, $v['id'], "  ".$format);
        }
    }
    return $list;
}
 function unlimitedForLever($cate, $html = '|-', $pid=0, $level = 0)
 {
     $arr=array();
     foreach ($cate as $v) {
         if ($v['pid'] == $pid) {
             $v['level'] = $level + 1;
             $v['html'] = str_repeat($html, $level);
             $arr[] = $v ;
             $arr = array_merge($arr, unlimitedForLever($cate, $html, $v['id'], $level+1));
         }
                  # code...
     }
     return $arr;
 }
