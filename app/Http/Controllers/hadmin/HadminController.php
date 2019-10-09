<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Tools\Tools;
use App\Model\Curl;
use App\Model\Wechat;
use Illuminate\Support\Facades\Cache;
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
        $code = $request->input('code');
    //    dd($code);
        $value = Cache::get('code'.$username);
//         dd($value);/
        // $red = session('code');
        // dd($red);
        if($value != $code){
            echo "<script>alert('验证码不正确');location.href='login';</script>";die;
        }
        // 用户名错误 密码错误 用户名或者错误
        $adminInfo = DB::table('users')->where(['username'=>$username,'password'=>$password])->first();
        if(!$adminInfo){
            //报错登录失败;
            echo "<script>alert('用户名密码错误');location.href='login';</script>";

        }else{
            echo "<script>alert('登陆成功');location.href='/hindex/hindex';</script>";
        }
       
        // // $adminInfo = $adminInfo->toArray();
        // //登录成功 存储到session中
        // session(['adminInfo'=>$adminInfo]);
        // return redirect('hindex/hindex');

    }
    /**
     * 发送短信验证码
     */
    public function send(Request $request)
    {
                $req=$request->all();
            //    dd($req);
                //接收用户名 密码
                $name=$request->input('username');
            //   dd($name);
                $password=$request->input('password');
                //发送验证码 4位 6位
                $code=rand(1000,9999);
                $rd = "code".$name;
                // 存入缓存 Cache::put('key', 'value', $seconds);
                $data = Cache::put($rd,$code,60);
                $url = 'http://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
            //    dd($url);
                //参数
                $data=[
                    'touser'=>'oeCJI0RjFEbnj5UEazbgqK2tFkBM',
                    'template_id'=>'wldtUlU2MzT510MNWAEkiRTF7AJcuMA_dUjNVix0mrk',
                    'data'=>[
                        'code'=>[
                            'value'=>$code,
                            'color'=>''
                        ],
                        'name'=>[
                            'value'=>$name,
                            'color'=>''
                        ],
                        'time'=>[
                            'value'=>time(),
                            'color'=>''
                        ],
        
        
                    ]
                ];
            //    dd($data);
                $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
                // dd($re);
                $result=json_decode($re,1);
                dd($result);
    }
    /**
     * 微信账号绑定页面
     */
    public function bind()
    {   
        return view('hadmin.bind');
    }
    public function bind_do(Request $request)
    {
        //接收用户名
            $username = request('username');
            // dd($username);
        //接收密码
            $password = request('password');
            // dd($password);
            $adminInfo = DB::table('users')->where(['username'=>$username,'password'=>$password])->first();
            // dd($adminInfo);
            if(!$adminInfo){
                echo '用户名或密码错误';die;
            }
            $openid = Wechat::getOpenid();
            // dd($openid);
            DB::table('users')->where(['username'=>$username,'password'=>$password])->update([
                'openid'=>$openid
            ]);
            $adminInfo->openid = $openid;
            echo "<script>alert('绑定账号成功');location.href='login';</script>";
    } 
}
