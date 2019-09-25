<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class LoginController extends Controller
{
    public function login()
    {
        return view('wechat/login');
    }
    /**
     * 微信登陆
     */
    public function wechat_login()
    {
        $redirect_uri = env('APP_URL').'/wechat/code'; 
        // dd($redirect_uri);    
        // dd(env('WECHAT_APPID'));  
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        // dd($url);
        header('Location:'.$url);
    }

    public function code(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        // dd($result);
        $re = json_decode($result,1);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
        // dd($wechat_user_info);
        $openid = $re['openid'];
        $wechat_info = DB::table('wechat')->where(['openid'=>$openid])->first();
        // dd($wechat_info);
        if(!empty($wechat_info)){
            //存在，登陆
            $request->session()->put('uid',$wechat_info->uid);
            echo 'ok';
            // return redirect(''); //主页
        }else{
            //不存在，注册。登陆
            //插入user表数据一条
            DB::connection('mysql')->beginTransaction();//打开事物
            $uid = DB::table('user')->insertGetId([
                'name'=>$wechat_user_info['nickname'],
                'password'=>'',
                'reg_time'=>time()
            ]);
            // dd($uid);
           $insert_result = DB::table('wechat')->insert([
                'uid'=>$uid,
                'openid'=>$openid
            ]);
            //登陆操作
            $request->session()->put('uid',$wechat_info['uid']);
            echo 'ok';
            // return redirect(''); //主页
        }
    }
}
