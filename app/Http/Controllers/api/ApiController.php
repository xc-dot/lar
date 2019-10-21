<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ApiController extends Controller
{

    /**
     * 展示接口
     */
    public function show()
    {
        $data = DB::table('aaa')->get();

        return json_encode(
            [
                're'=>1,
                'msg'=>'查询成功',
                'data'=>$data
            ]
            );
    }


    /**
     * 添加接口
     */
    public function add(Request $request)
    {
        //用户
        $name = $request->input('name');
        //年龄
        $age = $request->input('age');
        if(empty($name) || empty($age)){
            return json_encode(['re'=>0,'msg'=>'参数不能为空']);
        }
        //添加数据入库
        $res = DB::table('aaa')->insert(
            [
            'name'=>$name,
            'age'=>$age
            ]
        );
        if($res){
            return json_encode(['ret'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['ret'=>0,'msg'=>'异常']);
        }
    }

   /**
     * 修改接口 查询默认值
     * @param Request $request
     */
    public function find(Request $request)
    {
        $id= $request->id;
        $data=DB::table('aaa')->where(['id'=>$id])->first();
        //对象转数组
//        $data = get_object_vars($data);
        if($data){
            return json_encode(['ret'=>'1','msg'=>'查找成功','data'=>$data]);
        }
    }


    /**
     * 测试接口修改
     */
    public function upd(Request $request)
    {
        $data= $request->all();
        // dd($data);
        $res=DB::table('aaa')->where(['id'=>$data['id']])->update([
            'name'=>$data['name'],
            'age'=>$data['age']
        ]);
        if($res){
            return json_encode(['ret'=>1,'msg'=>'修改成功']);
        }
    }


    /**
     * 测试删除接口
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $id=$request->id;
        $res=DB::table('aaa')->where(['id'=>$id])->delete();
        if($res){
            return json_encode(['res'=>1,'msg'=>'删除成功']);
        }
    }
}
