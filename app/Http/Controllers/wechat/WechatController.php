<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Tools;
class WechatController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }


    public function get_user_contents(Request $request)
    {
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->get_wechat_access_token().'&next_openid=');
        $re = json_decode($result,1);
        $last_info = [];
        foreach($re['data']['openid'] as $k=>$v){
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            $user = json_decode($user_info,1);
            $last_info[$k]['nickname']=$user['nickname'];
            $last_info[$k]['openid'] = $v;
        }
        // dd($last_info);
        return view('wechat/userlist',['info'=>$last_info,'tagid'=>isset($req['tagid'])?$req['tagid']:'']);
    }

    public function get_access_token()
    {
        return $this->tools->get_wechat_access_token();
    }

    public function get_wechat_access_token()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        //加入缓存
        $access_token_key ='wechat_access_token';
        if($redis->exists($access_token_key)){
            //存在
            return $redis->get($access_token_key);
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
            $re = json_decode($result,1);
            $redis->set($access_token_key,$re['access_token'],$re['expires_in']);//加入缓存
            return $re['access_token'];
        }
    }

     //获取用户的详细信息
     public function get_user_info($openid)
     {
         $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$openid.'&lang=zh_CN');
         $user = json_decode($user_info,1);
        //  dd($user);
         return view('wechat/userinfo',['info'=>$user]);
     }

   public function upload()
   {
       return view('wechat/upload',[]);
   }
   /**
    * 图片 image  video voice thumb
    */
   public function do_upload(Request $request)
   {
        $name = 'file_name';
        if(!empty($request->hasFile($name)) && request()->file($name)->isValid()){
            //$size = $request->file($name)->getClientSize() / 1024 / 1024;
            $ext = $request->file($name)->getClientOriginalExtension();//文件类型
            $file_name = time().rand(1000,9999).'.'.$ext;
            $path = request()->file($name)->storeAs('wechat/voice',$file_name);
            $path = realpath('./storage/'.$path);
            $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->get_wechat_access_token().'&type=voice';
            $result = $this->curl_upload($url,$path);
            dd($result);
        }
   }
   /**
     * curl上传微信素材
     * @param $url
     * @param $path
     * @return bool|string
     */
    public function curl_upload($url,$path)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        $form_data = [
            'meida' => new \CURLFile($path)
        ];
        curl_setopt($curl,CURLOPT_POSTFIELDS,$form_data);
        $data = curl_exec($curl);
        //$errno = curl_errno($curl);  //错误码
        //$err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }

    public function curl_post($url,$data)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $data = curl_exec($curl);
        // dd($data);
        $errno = curl_errno($curl);
        $err_msg = curl_error($curl);
        curl_close($curl);
        return $data;
    }

    //清除
    // public function clear_api()
    // {
    //     $url = 'https://api.weixin.qq.com/cgi-bin/clear_quota?access_token='.$this->get_wechat_access_token();
    //     $data = ['appid'=>env('WECHAT_APPID')];
    //     $this->tools->curl_post($url,json_encode($data));
    // }

   //模板消息
   public function send_message()
   {
        $openid = 'oeCJI0dMdwv0Bvhb7Fc-JUzwnFfs';//发给谁，就是谁的ip
        $url ='http://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'touser'=>$openid,
            'template_id'=>'kwtdxdKtUuVt7oQjwjfadW_74b7bE-vXpVqEEVhZCLw',
            'url'=>'',
            'data' => [
                'first'=>[
                    'value'=>'猪妞妞',
                    'color'=>''
                ],
                'keyword1'=>[
                    'value'=>'我爱你',
                    'color'=>''
                ],
            ]
        ];
        $re =  $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));       
        $result = json_decode($re,1);
        dd($result);
   }
   
 
      /**
     * jssdk获取地理位置
     */
    public function location()
    {
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        $jsapi_ticket = $this->tools->get_wechat_jsapi_ticket();
        // dd($jsapi_ticket);
        $timestamp = time();
        $nonceStr = rand(1000,9999).'suibian';
        $sign_str = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$url;
        $signature = sha1($sign_str);
        // echo $signature;
        return view('wechat/location',['nonceStr'=>$nonceStr,'timestamp'=>$timestamp,'signature'=>$signature]);
    }
}
