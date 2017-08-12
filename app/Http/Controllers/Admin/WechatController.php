<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Log;

class WechatController extends Controller
{
    public function serve()
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注本公众号！";
        });
        return $wechat->server->serve();
    }

    public function WechatConfig(Request $request)
    {
        $data=config('wechat');
        if ($request->ajax()) {
            $param = $request->only(['app_id', 'secret','token']);
            $data=[
               'WECHAT_APPID'=>$param['app_id'],
               'WECHAT_SECRET'=>$param['secret'],
               'WECHAT_TOKEN'=>$param['token'],
               ];
            modifyEnv($data);
            return ['code'=>1,'data'=>route('WechatConfig')];
        }
        //modifyEnv($data);
        return view('admin/wechat/ConfigPage', ['data'=>$data]);
    }

    public function WechatIndex(Application $wechat, Request $request)
    {
        if ($request->ip() == '127.0.0.1') {
            echo '因为公众号的特殊规则，此功能需上线后才能使用,如果公众号配置填写正确后会自动启用';
            die;
        } else {
            $menu = $wechat->menu;
            $menus = $menu->all();


            dd($menus);
        }

        return view('admin/wechat/WechatIndex');
    }

    public function user(Application $wechat)
    {
        //发送模版信息


        //发送模版信息
        //$messageId = $wechat->notice->to('oE9NywJw0oSfxN03wPyjqd8rWVfA')->uses('BBXeR0vcb_Vhh2ClKKZQcFI33zE7juK44xq2Uj2ZmM8')->send();
    }
}
