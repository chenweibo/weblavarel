<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Log;
use App\WechatMenu;

class WechatController extends Controller
{
    public function serve()
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            if ($message->Event=='subscribe') {
                return '欢迎关注我哦';
            }
            if ($message->Event=='unsubscribe') {
                return '已取消关注';
            }
            switch ($message->MsgType) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '你发了'.$message->Content;
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
}
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
        $menu = new WechatMenu();
        $list =$menu->get()->toArray();
        $str = unlimitedForLever($list, '|-');
        return view('admin/wechat/WechatMenu', ['str'=>$str]);
    }

    public function MenuCreate(Request $request)
    {
        $menu = new WechatMenu();
        if ($request->ajax()) {
            if ($menu->insert($request->all())) {
                return ['code'=>1,'msg'=>'','data'=>route('WechatIndex')];
            } else {
                return ['code'=>0,'msg'=>'添加失败'];
            }
        }

        $list =$menu->get()->toArray();
        $str = unlimitedForLever($list, '--');
        return view('admin/wechat/MenuCreate', ['str'=>$str]);
    }

    public function user(Application $wechat)
    {
        //发送模版信息


        //发送模版信息
        //$messageId = $wechat->notice->to('oE9NywJw0oSfxN03wPyjqd8rWVfA')->uses('BBXeR0vcb_Vhh2ClKKZQcFI33zE7juK44xq2Uj2ZmM8')->send();
    }
}
