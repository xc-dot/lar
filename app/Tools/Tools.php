<?php
 namespace App\Tools;

 class Tools{
     
    public $redis;
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1','6379');
    }

   //post获取
   public function curl_post($url,$data)
   {
       $curl=curl_init($url);
       curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
       curl_setopt($curl,CURLOPT_POST,true);// 发送post
       curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
       $erron = curl_errno($curl);//错误码
       $error = curl_error($curl);//错误信息
       $data = curl_exec($curl);
       curl_close($curl);
       return $data;
   }

    /**
     * 获取access_token
     */
    public function get_wechat_access_token()
    { 
        //加入缓存
        $access_token_key ='wechat_access_token';
        if($this->redis->exists($access_token_key)){
            //存在
            return $this->redis->get($access_token_key);
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
            // dd($result);
            $re = json_decode($result,1);
            $this->redis->set($access_token_key,$re['access_token'],$re['expires_in']);//加入缓存
            // dd($re);
            return $re['access_token'];
        }
    }

    
      /**
    * jsapi
    */
    public function get_wechat_jsapi_ticket()
    {
    
        //加入缓存
        $access_api_key ='wechat_jsapi_ticket';
        if($this->redis->exists($access_api_key)){
            //存在
            return $this->redis->get($access_api_key);
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->get_wechat_access_token().'&type=jsapi');
            $re = json_decode($result,1);
            $this->redis->set($access_api_key,$re['ticket'],$re['expires_in']);//加入缓存
            return $re['ticket'];
        }
     }
 

 }




