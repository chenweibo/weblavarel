<?php


//整理菜单

function prepareMenu($param)

{

    $parent = []; //父类

    $child = [];  //子类



    foreach($param as $key=>$vo){



        if($vo['typeid'] == 0){

            $vo['href'] = '#';

            $parent[] = $vo;

        }else{

            $vo['href'] = url($vo['control_name'] .'/'. $vo['action_name']); //跳转地址

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

