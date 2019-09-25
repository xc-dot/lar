<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\Tools;
use DB;
class MenuController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
   public function menu_list()
   {
       $info = DB::table('menu')->orderBy('name1','asc','name2','asc')->get();
       return view('wechat/menulist',['info'=>$info]);
   }

   //删除
   public function del_menu(Request $request)
   {
        $id = $request->all()['id'];
        $del_result = DB::table('menu')->where(['id'=>$id])->delete();
        if(!$del_result){
            dd('删除失败');
        }
        //根据表数据刷新菜单结构
        $this->load_menu();

   }
   /**
    * 提交页面 添加
    */
    public function create_menu(Request $request)
    {
       $req = $request->all();
    //    dd($req);
    $button_type = !empty($req['name2'])?2:1;
       $result = DB::table('menu')->insert([
           'name1'=>$req['name1'],
           'name2'=>$req['name2'],
           'type'=>$req['type'],
           'button_type'=>$button_type,
           'event_value'=>$req['event_value']
       ]);
       if(!$result){
           dd('插入失败');
       }
        //根据表数据刷新菜单结构
        $this->load_menu();
    }
    /**
     * 根据数据库数据刷新菜单
     */
    public function load_menu()
    {
       
        $data = [];
        $event_arr = [1=>'click',2=>'view'];
        $menu_list = DB::table('menu')->groupBy('name1')->select(['name1'])->get();
        foreach($menu_list as $vv){
            $menu_info = DB::table('menu')->where(['name1'=>$vv->name1])->get();
            // dd($menu_info);
            $menu = [];
            foreach ($menu_info as $v){
                $menu[] = (array)$v;
            }
            $arr = [];
            foreach($menu as $v){
                
                if($v['button_type'] ==1){//一级菜单
                    
                    if($v['type'] == 1){//click
                        $arr = [
                            'type'=>'click',
                            'name'=>$v['name1'],
                            'key'=>$v['event_value']
                        ];
                    }elseif($v['type'] ==2){//view
                        $arr = [
                            'type'=>'view',
                            'name'=>$v['name1'],
                            'url'=>$v['event_value']
                        ];
                    }
                    
                }elseif($v['button_type'] == 2){//带有二级菜单的一级菜单
                   
                    $arr['name'] = $v['name1'];
                    if($v['type'] == 1){//click
                        $button_arr = [
                            'type'=>'click',
                            'name'=>$v['name2'],
                            'key'=>$v['event_value']
                        ];
                    }elseif($v['type'] ==2){//view
                        $button_arr = [
                            'type'=>'view',
                            'name'=>$v['name1'],
                            'url'=>$v['event_value']
                        ];
                    }
                    $arr['sub_button'][] = $button_arr;
                    
                }
                // $data['button'][] = $button_arr;
            }
            $data['button'][] = $arr;
        } 
        // print_r((array)$menu_info);
        // dd($data);
        $url = 'http://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->tools->get_wechat_access_token();
        // dd($url);

        $re = $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $result = json_decode($re,1);
        dd($result);
    }

 
}
