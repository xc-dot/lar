<?php

namespace App\Http\Controllers\brand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Model\Brand;
class branController extends Controller
{
    public function add(Request $request)
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

    public function blist()
    {
        $where = [];
        $name = request("name");
        if(isset($name)){
            $where[] = ['name','like',"%$name%"];
        }
        $data = Brand::where($where)->paginate(3);
        // dd($data);die;
        return json_encode(
            [
                're'=>1,
                'msg'=>'查询成功',
                'data'=>$data
            ]
        );
        // $data = Brand::get();

        // return json_encode(
        //     [
        //         're'=>1,
        //         'msg'=>'查询成功',
        //         'data'=>$data
        //     ]
        //     );
    }


    public function delete(Request $request)
    {
        $id=$request->id;
        $res=Brand::where(['id'=>$id])->delete();
        if($res){
            return json_encode(['res'=>1,'msg'=>'删除成功']);
        }
    }
    

    public function weath()
    {
        return view('brand/weath');
    }

    public function weather()
    {
        $city = request("city");
        if(!isset($city)){
            $city='北京';
        }
    // 有缓存 读缓存
        $cache_key="weather_data_".$city;
        $data=Cache::get($cache_key);
        if(empty($data)){
            echo '接口查询的';
                //没有缓存 调用k780天气接口 存入缓存里
            $url ="http://api.k780.com/?app=weather.future&weaid=1&ag=today,futureDay,lifeIndex,futureHour&appkey=45891&sign=ecb27238960a390a8be604b62daab0b9&format=json";
            $data=file_get_contents($url);
        // var_dump($data);die;
            //获取当前24点的时间
            $date=date("Y-m-d");
        //dd($date);
            $time24=strtotime($date)+86400;//把格式化时间转换成 时间戳
            //获取当前时间
            $cache_time=$time24-time();
            Cache::put($cache_key,$data,$cache_time);
        //dd($res);
            }
                return $data;
    }


}
