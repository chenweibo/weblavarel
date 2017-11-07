<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use EasyWeChat\Message\Text;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\DB;
use \GuzzleHttp\Client;
use Log;
use App\WechatMenu;

class WechatController extends Controller
{
    public function serve(Application $wechat)
    {
        $app = app('wechat');
        $app->server->setMessageHandler(function ($message) {
            $user_openid = $message->FromUserName;
            if ($message->Event=='subscribe') {
                return '欢迎关注我哦';
            }
            if ($message->Event=='unsubscribe') {
                $z=$userService->get($message->FromUserName);
                return '已取消关注';
            }
            switch ($message->MsgType) {
                case 'event':

                     return '';


                    break;
                case 'text':
                    $data['OpenID'] = $message->FromUserName;
                    $data['content'] =  $message->Content;
                    $data['time'] = $message->CreateTime;
                    $data['MsgId'] = $message->MsgId;
                    $app = app('wechat');
                    $userService = $app->user;
                    $z=$userService->get($message->FromUserName);
                    DB::table('wechatmessage')->insert([ 'name'=>$z->nickname, 'OpenID'=>$message->FromUserName,'content'=>$message->Content,'time'=>$message->CreateTime,'MsgId'=>$message->MsgId]);
                    $list = DB::table('reply')->where('name', $message->Content)->get()->first();
                    if (empty($list)) {
                        return '你的留言我们已经收到';
                    } else {
                        return $list->content;
                    }
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
            foreach ($d as $v) {
                foreach ($v['sub_button'] as $vo) {
                    $q[]=['type'=>'view','name'=>$vo['name'],'url'=>$vo['url']];
                }
                $z[]=['name'=>$v['name'], "sub_button" =>$q];
                unset($q);
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

    public function Message(Application $wechat)
    {
        $list = DB::table('wechatmessage')->get();
        return view('admin/wechat/Message', ['list'=>$list]);
    }
    public function MessageRead(Application $wechat, $id)
    {
        $list = DB::table('wechatmessage')->where('id', $id)->get()->first();
        return view('admin/wechat/MessageRead', ['data'=>$list]);
    }
    public function MessageDelete(Request $request)
    {
        if ($request->ajax()) {
            $id=$request->id;
            DB::table('wechatmessage')->where('id', $id)->delete();
            return ['code' => 1, 'data' => route('Message'), 'msg' => ''];
        }
    }
    public function userReply(Request $request, Application $wechat)
    {
        $id=$request->id;
        $data = DB::table('wechatmessage')->where('id', $id)->get()->first();
        $openid=$data->OpenID;
        $content = $request->content;
        $message = new Text(['content' => $content]);
        $result = $wechat->staff->message($message)->to($openid)->send();

        if (!$result) {
            return ['code'=>0];
        }
        DB::table('wechatmessage')->where('id', $id)->update(['recontent'=>$content]);
        return ['code'=>1];
    }


    public function Reply()
    {
        $list = DB::table('reply')->get();
        return view('admin/wechat/Reply', ['list'=>$list]);
    }
    public function ReplyCreate(Request $request)
    {
        if ($request->ajax()) {
            $info = DB::table('reply')->insert($request->all());
            if ($info) {
                return ['code'=>1,'data'=>route('Reply'),'msg'=>''];
            } else {
                return ['code'=>0,'msg'=>'添加失败'];
            }
        }
        return view('admin/wechat/ReplyCreate');
    }
    public function ReplyEdit(Request $request)
    {
        $data = DB::table('reply')->where('id', $request->id)->get()->first();
        if ($request->ajax()) {
            # code...
            if (DB::table('reply')->where('id', $request->id)->update($request->all())) {
                return ['code'=>1,'data'=>route('Reply'),'msg'=>''];
            } else {
                return ['code'=>0,'msg'=>'编辑失败'];
            }
        }
        return view('admin/wechat/ReplyEdit', ['data'=>$data]);
    }
    public function ReplyDelete(Request $request)
    {
        if ($request->ajax()) {
            $id=$request->id;
            DB::table('reply')->where('id', $id)->delete();
            return ['code' => 1, 'data' => route('Reply'), 'msg' => ''];
        }
    }
}
