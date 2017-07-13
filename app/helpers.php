<?php


//Arrangement menu

function prepareMenu($param)

{
    $parent = []; //father
    $child = [];  //son

    foreach($param as $key=>$vo){
        if($vo['typeid'] == 0){

            $vo['href'] = '#';
            $parent[] = $vo;

        }else{

            $vo['href'] = route('AdminIndex'); // 
            $child[] = $vo;

        }

    }

    foreach($parent as $key=>$vo){

        foreach($child as $k=>$v){

            if($v['typeid'] == $vo['id']){
                $parent[$key]['child'][] = $v;

            }

        }

    }
    unset($child);
    return $parent;

}

//Rewrite Config

function ConfigBack($str){

$a ="<?php

return [
".PHP_EOL;
    foreach ($str as $key => $vo) {
$a.= "'".$key."'".'=>'."'".$vo."'".','.PHP_EOL;
    }

       $a.=PHP_EOL."];";
   return $a;
}
