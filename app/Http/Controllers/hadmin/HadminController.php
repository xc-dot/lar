<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Tools\Tools;
use App\Model\Curl;
use App\Model\Wechat;
class HadminController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    /**
     * 
     * 登入页面
     */
    public function login()
    {
         return view ('hadmin/login');
    }
    //登录
    public function login_do(Request $request)
    {
        $username = request('username');
        $password = request('password');
        //用户名错误 密码错误 用户名或者错误
        $adminInfo = DB::table('users')->where(['username'=>$username,'password'=>$password])->first();
        if(!$adminInfo){
            //报错登录失败;
            
            return view('hadmin/login');
        }
        //验证码判断
        $code = request('code');
        $trueCode = session("code");
        if($code != $trueCode){
            //报错登录失败；
        }
        // $adminInfo = $adminInfo->toArray();
        //登录成功 存储到session中
        session(['adminInfo'=>$adminInfo]);
        return redirect('hindex/hindex');

    }
    /**
     * 发送短信验证码
     */
    public function send(Request $request)
    {
          //接受用户名 密码
          $username =  request('username');
          $password =  request('password');
          //查询数据库
          $adminData = '';
          $openid = $adminData['openid'];
          //发送的验证码 4位 6位
          $code =rand(1000,9999);
          $url =  'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
          $arsg = '{
                
                "touser":"oeCJI0RjFEbnj5UEazbgqK2tFkBM",
                "template_id":"6OlMnK9d7Ogp6GyAI5hneNRlsarxQaVvhL8Iq4yugFE",      
                "data":{
                        "code": {
                            "value":"'.$code.'",
                            "color":"#173177"
                        },
                        "name":{
                            "value":"'.$username.'",
                            "color":"#173177"
                        },
                        "time":{
                            "value":"'.time().'",
                            "color":"#173177"
                        },
                       
                }

            }'; 
            Curl::post($url,$args);
    }
    /**
     * 微信账号绑定页面
     */
    public function bind()
    {   
        $openid = Wechat::getOpenid();
        var_dump($openid);die;
        return view('hadmin/bind');
    }
    public function bind_do()
    {
        $openid = Wechat::getOpenid();
        var_dump($openid);die;
    } 
}
