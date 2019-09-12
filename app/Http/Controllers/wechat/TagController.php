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
    //    dd($result); 
    }


    //删除
    public function del(Request $request,$id)
    {
        $re = $request->delete();
        // dd($re);
        $url = 'http://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'tag'=>[
                'id'=>$id
            ]
        ];
        $re =  $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));       
        $result = json_decode($re,1);
        dd($result);
    }
}