<?php

namespace App\Http\Controllers\goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Type;//类型
use App\Model\Sort;//分类表
use App\Model\Attr;//属性表
use App\Model\GoodsAttr;
use App\Model\Product;
class GoodsController extends Controller
{
    /**
     * 商品添加
     */
    public function add()
    {
        //查询分类表
        $sortData = Sort::get()->toArray();
        //查询类型表
        $typeData = Type::get()->toArray();

        return view('goods/add',['sortData'=>$sortData,'typeData'=>$typeData]);
    }
    /**
     *根据类型ID 查询该类型下的属性
     */
    public function getAttr(Request $request)
    {
        $tid = $request->input('tid');
        // dd($tid);
        //查询属性表
        $attrData = Attr::where(['tid'=>$tid])->get()->toArray();
        // var_dump($attrData);die;
        return json_encode($attrData);

    }
    public function add_do(Request $request)
    {
        $postData = $request->input();
        echo '<pre>';
        var_dump($postData);
        $path = $request->file('goods_img')->store('goods');
        //        dd($path);
        $goods_img=asset('storage'.'/'.$path);

        //商品基本信息入库
        $goodsModel = Goods::create([
            // 'goods_id'=>$postData['goods_id'],
            'goods_name'=>$postData['goods_name'],
            'sid'=>$postData['sid'],
            'goods_price'=>$postData['goods_price'],
            'goods_desc'=>$postData['goods_desc'],
            'goods_img'=>$goods_img
        ]);
            // var_dump($goodsModel);die;
            //获取商品主键ID
        $goods_id = $goodsModel->goods_id;
    //    dd($goods_id);
        //商品属性信息入库  商品属性关系表
        $insertData =[];//定义要添加入库的数据 
        foreach ($postData['attr_value_list'] as $key => $value){
            $insertData[] = [
                'goods_id'=>$goods_id,
                'aid'=>$postData['attr_id_list'][$key],
                'attr_value'=>$value,
                'attr_price'=>$postData['attr_price_list'][$key]
            ];
            // var_dump( $insertData);die;
        }
        //批量入库
        $res = GoodsAttr::insert($insertData);
        // var_dump($res);die;
        if($res){
            return redirect('goods/productAdd/'.$goods_id);
        }
    }
    /**
     * 货品添加
     */
   public function productAdd($goods_id)
   {
       //根据商品id查商品基本信息表
       $goodsData = Goods::where(['goods_id'=>$goods_id])->first();
       //根据商品id查商品属性关系表（属性表）
       $goodsAttrData = GoodsAttr::join('attr','goods_attr.aid','=','attr.aid')->where(['goods_id'=>$goods_id,'is_show'=>1])->get()->toArray();
        // echo "<pre>";
        // var_dump($goodsAttrData);die;
        $newArr = [];
        foreach ($goodsAttrData as $key =>$value){
            $stuatus = $value['aname'];
            $newArr[$stuatus][] = $value;
        }
        // echo "<pre>";
        // var_dump( $newArr);die;
       return view('goods/productAdd',['attrData'=>$newArr,'goods_id'=>$goods_id]);
   } 

   /**
    * 货品添加执行页
    */
   public function productAdd_do(Request $request)
   {
         $postData = $request->input();
         //属性值组合处理数据
         $size = count($postData['goods_attr']) / count($postData['product_number']);
        //  dd($size);
         $goodsAttr = array_chunk($postData['goods_attr'],$size);
         echo "<pre>";
         var_dump($goodsAttr);
         foreach ($goodsAttr as $key=>$value){
            Product::create([
                'goods_id'=>$postData['goods_id'],
                'value_list'=>implode(",",$value),
                'product_number'=>$postData['product_number'][$key],
            ]);
         }
         
   }
}
