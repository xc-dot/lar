<?php

namespace App\Http\Controllers\brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //用户
         $name = $request->input('name');
        //  dd($name);die;
         //年龄
         $money = $request->input('money');
         if(empty($name) || empty($money)){
             return json_encode(['re'=>0,'msg'=>'参数不能为空']);
         }

        //  $img_path ="";
        //  if ($request->file('photo')->isValid()) {
        //     $img_path = $request->photo->store('brand');
        //     // var_dump($path);die;
        // }
         //添加数据入库
         $res = Brand::create(
             [
                'name'=>$name,
                'money'=>$money,
                // 'img_path'=>$img_path
             ]
         );
         if($res){
             return json_encode(['ret'=>1,'msg'=>'添加成功']);
         }else{
             return json_encode(['ret'=>0,'msg'=>'异常']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
