<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Log;
use App\WechatMenu;

class WechatController extends Controller
{
    public function serve(Application $wechat)
    {
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

                    $data['OpenID'] = $message->FromUserName;
                    $data['content'] =  $message->Content;
                    $data['time'] = $message->CreateTime;
                    $data['MsgId'] = $message->MsgId;
                    if ($message->Content =='天气') {
                        return '今天天气不错';
                    }
                    DB::table('wechatmessage')->insert([  'OpenID'=>$message->FromUserName,'content'=>$message->Content,'time'=>$message->CreateTime,'MsgId'=>$message->MsgId]);

                    return '已经收到你发的信息';
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

    public function MenuEdit(Request $request)
    {
        $menu = new WechatMenu();
        if ($request->ajax()) {
            if ($menu->where('id', $request->id)->update($request->all())) {
                return ['code'=>1,'msg'=>'','data'=>route('WechatIndex')];
            } else {
                return ['code'=>0,'msg'=>'编辑失败'];
            }
        }


        $list =$menu->get()->toArray();
        $str = unlimitedForLever($list, '--');
        $data = $menu->where('id', $request->id)->get()->first();
        return view('admin/wechat/MenuEdit', ['str'=>$str,'data'=>$data]);
    }
    public function MenuDelete(Request $request)
    {
        $menu = new WechatMenu();
        if ($request->ajax()) {
            if ($menu->where('id', $request->id)->delete()) {
                return ['code'=>1,'msg'=>'','data'=>route('WechatIndex')];
            } else {
                return ['code'=>0,'msg'=>'删除失败'];
            }
        }
    }
    public function MenuChange(Application $wechat, Request $request)
    {
        if ($request->ip()=='127.0.0.1') {
            echo '本地同步不了，需上线部署后才能同步';
            die;
        } else {
            $menu = new WechatMenu();
            $list =$menu->get()->toArray();
            $d=make_tree1($list);
            foreach ($d as $key => $value) {
                foreach ($value['sub_button'] as $v) {
                    $q[]=['type'=>'view','name'=>$v['name'],'url'=>$v['url']];
                    $z[]=['name'=>$value['name'], "sub_button" =>$q];
                    unset($q);
                }
            }

            $menu = $wechat->menu;
            $menus = $menu->current();
            if ($menu->add($z)) {
                return redirect()->route('WechatIndex')->with('tongbu', '同步成功');
            } else {
                return redirect()->route('WechatIndex')->with('tongbu', '同步失败');
            }
        }
    }

    public function Message()
    {
        return view('admin/wechat/Message');
    }
    public function Reply()
    {
        return view('admin/wechat/Reply');
    }
}
