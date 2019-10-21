<?php

namespace App\Http\Controllers\attr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Attr;
use App\Model\Type;
class AttrController extends Controller
{
    public function addin()
    {
        $asser = Type::get();
        // dd($asser);
        return view('attr/addin',['asser'=>$asser]);
    }
    public function add_in()
    {
        $post = request()->post();
        //属性名
        
        // dd($data);
        $res = Attr::create($post);
        if($res)
        {
            return redirect('attr/alist');
        }
    }
    public function alist(Request $request)
    {
        $tid = $request->all();
        // dd($tid);
        $tid = $tid['tid'];
        // dd($tid);
        $data = Type::join('attr','attr.tid','=','type.tid')->where('attr.tid',$tid)->get();
        // dd($res);
        // $res=Type::join('attribute','attribute.type_id','=','type.type_id')->where('attribute.type_id',$type_id)->get();
        // // $res = Type::first('tname');
        // $data = Attr::join('type','type.tid','=','attr.tid')->get();
        
        // // dd($data);
        return view('attr/alist',['data'=>$data]);
    }
    
}
