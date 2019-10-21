<?php

namespace App\Http\Controllers\type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Type;
use App\Model\Sort;
use App\Model\Attr;

class TypeController extends Controller
{
    /**
     * 添加
     */
    public function addto()
    {
        $res=Sort::get();
       //dd($res);
        foreach($res as $key=>$val){
            $info = Type::where('tid',$val['tid'])->count();
            $res[$key]['tnum']=$info;
        }
        // $res = json_encode($info);
        // dd($data);
        return view('type/addto',['res'=>$res]);
        // return view('type/addto');
    }
     /**
     * 添加执行页面
     */
    public function add_to()
    {
        //获取name
        $tname = request()->input('tname');
        //获取属性数
        // $tnum = request()->input('tnum');
        $res = Type::create([
            'tname'=>$tname,
            // 'tnum'=>$tnum,
        ]);
        if($res)
        {
            return redirect('type/tlist');
        }

    }

    /**
     * 展示
     */
    public function tlist()
    {
        $data = Type::get();
        // dd($data);
        foreach($data as $key=>$val){
            $info =Attr::where('tid',$val['tid'])->count();
            $data[$key]['attr_count']=$info;
        }
        return view('type/tlist',['data'=>$data]);
    }
}
