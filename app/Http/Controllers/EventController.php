<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tools\Tools;
class EventController extends Controller
{

    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    
    /**
     * 接收微信发送的消息【用户互动】
     */
    public function event()
    {
        // echo '111';
        // dd($_POST); 
        $xml_string = file_get_contents('php://input');  //获取
        $wechat_log_psth = storage_path('logs/wechat/'.date('Y-m-d').'.log');
        file_put_contents($wechat_log_psth,"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents($wechat_log_psth,$xml_string,FILE_APPEND);        
        file_put_contents($wechat_log_psth,"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n\n",FILE_APPEND);
        // dd($re);
        // dd($xml_string);
        // $xml_obj = simplexml_load_string($xml_string);
      
        //echo $_GET['echostr'];
        // //业务逻辑
        
        // $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&'.$this->tools->get_wechat_access_token().'openid='.$xml_arr['FromUserName'].'&lang=zh_CN';
        // dd($url);
        // $message = '欢迎'.$nickname.'同学，感谢您的关注！';
        // $xml_str = '<xml><ToUserName><![CDATA['.$xml_arr['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml_arr['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
        // dd($xml_str);
        // echo $xml_str;
    }
}
