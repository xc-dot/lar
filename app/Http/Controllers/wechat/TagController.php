<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Tools;

class TagController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }


    /**
     * 公众号的tag管理页
     */
    public function tag_list()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->tools->get_wechat_access_token();
        $re = file_get_contents($url);
        $result = json_decode($re,1); 
        // dd($result);
        return view('wechat/taglist',['info'=>$result['tags']]);
    }

    public function add_tag()
    {
        return view('wechat/add_tag');
    }
    public function do_add_tag(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $url = 'http://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->tools->get_wechat_access_token();
        
        $data = [
            'tag'=>[
                'name'=>$req['tag_name']
                ]
            ];
        // dd($data);
        $re =  $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        
       $result = json_decode($re,1);
       dd($result); 
    }

    /**
     * 粉丝列表
     */
    public function tag_openid_list(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $url = 'http://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'tagid'=>$req['tagid'],
            'next_openid' => ''
        ];
        $re = $this->tools->curl_post($url,json_encode($data));
        $result = json_decode($re,1);
        dd($result);
    }

    /**
     * 用户标签
     */
    // public function user_tag_list(Request $request)
    // {
    //     $req = $request->all();
    //     $url = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->tools->get_wechat_access_token();
    //     $data = [
    //         'openid'=>$req['openid']
    //     ];
    //     $re = $this->tools->curl_post($url,json_encode($data));
    //     $result = json_decode($re,1);
    //     $tag = file_get_contents('https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->tools->get_wechat_access_token());
    //     $tag_result = json_decode($tag,1);
    //     $tag_arr = [];
    //     foreach($tag_result['tags'] as $v){
    //         $tag_arr[$v['id']] = $v['name'];
    //     }
    //     foreach($result['tagid_list'] as $v){
    //         echo $tag_arr[$v]."<br/>";
    //     }
    // }

    /**
     * 粉丝打标签
     */
    public function tag_openid(Request $request)
    {
        $req = $request->all();
        $url = 'http://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'openid_list'=>$req['openid_list'],
            'tagid'=>$req['tagid']
        ];
        $re = $this->tools->curl_post($url,json_encode($data));
        $result = json_decode($re,1);
        dd($result);
    }
    
    /**
     * 用户标签
     */
    public function user_tag_list(Request $request)
    {
        $req = $request->all();
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->tools->get_wechat_access_token();
        $data =[
            'openid'=>$req['openid']
        ];
        $re = $this->tools->curl_post($url,json_encode($data));
        $result = json_decode($re,1);
        $tag = file_get_contents('https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.get_wechat_access_token());
        $tag_result = json_decode($tag,1);
        dd($tag_result);
        dd($result);
    }

    /**
     * 推送标签群发消息
     */
    public function push_tag_message(Request $request)
    {
        return view('wechat/pushTagMsg',['tagid'=>$request->all()['tagid']]);
    }

    /**
     * 执行推送标签群发消息
     */
    public function do_push_tag_message(Request $request)
    {
        $req = $request->all();
        // dd($req);
        $url = 'http://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->tools->get_wechat_access_token();
        // dd($url);
        $data = [
            'filter'=> [
                'is_to_all'=>false,
                'tag_id'=>$req['tagid']
            ],
            'text'=>[
                'content'=>$req['message']
            ],
            'msgtype'=>'text'
        ];
        // dd($data);
        $re = $this->tools->curl_post($url,json_encode($data));
        // dd($req);
        $result = json_decode($re,1);
        dd($result);
        // dd($req);
    }








}