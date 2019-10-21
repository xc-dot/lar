<?php

namespace App\Http\Controllers\sort;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sort;
class SortController extends Controller
{
    /**
     * 添加页面
     */
    public function sadd()
    {
        return view('sort/sadd');
    }
    /**
     * 添加执行
     */
    public function sadd_do(Request $request)
    {
        $sname = request()->input('sname');
        // dd($sname);
        $res = Sort::create([
                'sname'=>$sname,
        ]);
        if($res)
        {
            return redirect('sort/slist');
        }
    }
    /**
     * 展示
     */
    public function slist()
    {
        $data = Sort::get();
        // dd($data);
        return view('sort/slist',['data'=>$data]);
    }
}
