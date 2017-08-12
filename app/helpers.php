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

 function explodepath($param)
 {
     $str=explode('-', $param);
     $result=$str[count($str)-1];

     return $result;
 }

 function make_tree($list, $pk='id', $pid='pid', $child='children', $root=0)
 {
     $tree=array();
     $packData=array();
     foreach ($list as  $data) {
         $packData[$data[$pk]] = $data;
     }
     foreach ($packData as $key =>$val) {
         if ($val[$pid]==$root) {//代表跟节点
             $tree[]=& $packData[$key];
         } else {
             //找到其父类
             $packData[$val[$pid]][$child][]=& $packData[$key];
         }
     }
     return $tree;
 }

 function subTree($param, $pid)
 {
     static $res = [];

     foreach ($param as $key=>$vo) {
         if ($pid == $vo['pid']) {
             $res[] = $vo;

             subTree($param, $vo['id']);
         }
     }

     return $res;
 }

 function level($str)
 {
     foreach ($str as $v) {
         $count= count(explode('-', $v['path']));
         if ($count == 2) {
             $res=explodepath($v['path']);
             break;
         }
     }
     return $res;
 }


 function codeimg($str)
 {
     $d=array_filter(explode('<img src="', $str));

     foreach ($d as  $key=>$vo) {
         $d[$key]=str_replace('">', '', $vo);
     }



     return $d;
 }

 function modifyEnv(array $data)
 {
     $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

     $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

     $contentArray->transform(function ($item) use ($data) {
         foreach ($data as $key => $value) {
             if (str_contains($item, $key)) {
                 return $key . '=' . $value;
             }
         }

         return $item;
     });

     $content = implode($contentArray->toArray(), "\n");

     \File::put($envPath, $content);
 }
