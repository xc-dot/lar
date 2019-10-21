<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Api;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页面接口
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 123;die;
        //搜索
        $where = [];
        $name = request("name");
        if(isset($name)){
            $where[] = ['name','like',"%$name%"];
        }
        $data = Api::where($where)->paginate(3);
        // dd($data);die;
        return json_encode(
            [
                're'=>1,
                'msg'=>'查询成功',
                'data'=>$data
            ]
            );
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
     *添加接口
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //用户
         $name = $request->input('name');
         //年龄
         $age = $request->input('age');
         if(empty($name) || empty($age)){
             return json_encode(['re'=>0,'msg'=>'参数不能为空']);
         }

         $img_path ="";
         if ($request->file('photo')->isValid()) {
            $img_path = $request->photo->store('images');
            // var_dump($path);die;
        }
         //添加数据入库
         $res = Api::create(
             [
                'name'=>$name,
                'age'=>$age,
                'img_path'=>$img_path
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
     *修改页面接口
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        // echo 1;die;
        //$id= $request->id;
        // dd($id);
        $data=Api::where(['id'=>$id])->first();
        //对象转数组
//        $data = get_object_vars($data);
        if($data){
            return json_encode(['ret'=>'1','msg'=>'查找成功','data'=>$data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *修改执行接口
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data= $request->all();
        // dd($data);
        $res=Api::where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
            'age'=>$data['age']
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'修改成功']);
        }
      
    }

    /**
     * Remove the specified resource from storage.
     *删除接口
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $id=$request->id;
        $res=Api::where(['id'=>$id])->delete();
        if($res){
            return json_encode(['res'=>1,'msg'=>'删除成功']);
        }
    }
}
