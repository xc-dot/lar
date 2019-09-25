<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Tools\Tools;
use DB;
// use GuzzleHttp\Client;
class AgentController extends Controller
{
    public $tools;
    // public $client;,Client $client
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
        // $this->client = $client;
    }


    public function agent_list()
    {
        $user_info = DB::table('user')->get();
        return view('Agent/userlist',['info'=>$user_info]);
    }

    //生成二维码
    public function create_qrcode(Request $request)
    {
        $url = 'http://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'expire_seconds'=>30 * 24 * 3600,
            'action_name'=> 'QR_SCENE',
            'action_info'=>[
                'scene'=>[
                    'scene_id'=>$request->all()['uid']
                    ]
            ]
        ];
        // dd($data);
        $re = $this->tools->curl_post($url,json_encode($data));
        $result = json_decode($re,1); 
        // dd($result);
        
        $qrcode_info = file_get_contents('https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($result['ticket']));
        // dd($qrcode_info);
        // $res = $this->client->request('GET','https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($result['ticket']));
        // $header_arr = $res->getHeader();
        // dd($header_arr);
        $path = '/wechat/qrcode/'.time().rand(1000,9999).'.jpg';
         Storage::put($path, $qrcode_info);
        // dd($path);
        DB::table('user')->where(['id'=>$request->all()['uid']])->update([
            'qrcode_url'=> '/storage'.$path
        ]);
        return redirect('/Agent/agent_list');
    } 
}
