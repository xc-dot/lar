<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Cookie;
use Illuminate\Validation\Rule;
use App\crm_brand;
use App\Http\Requests\Volidate;
class usercontroller extends Controller
{
    // 主页面
    public function index()
    {
//        Cookie::queue('name','hello laravel','10');
        return view('admin/index');
    }
    // 登陆页面
    public function foot()
    {
        return view('admin/inc/foot');
    }
    // 头部信息
    public function head()
    {
        return view('admin/inc/head');
    }
    // 左侧下拉框
    public function left()
    {
        return view('admin/inc/left1');
    }
//    后台主图
    public function main()
    {
        return view('admin/main');
    }
    // 管理员查询
    public function user(Request $request)
    {
        // 搜索
        $data=db::table('crm_user')->paginate(2);
        return view('admin/user',['data'=>$data]);
    }

    // 管理员添加
    public function user_do(Request  $request)
    {
        $post=request()->input();
        unset($post['_token']);
        $validator = Validator::make($post, [
                'crm_user' => 'required|unique:crm_user|max:30',
                'crm_pwd' => 'required',
            ],[
                'crm_user.required'=>'用户名不能为空',
                'crm_user.unique'=>'该用户已存在',
                'crm_user.max'=>'用户名过长',
                'crm_pwd.required'=>'密码不能为空',
        ]);
        if ($validator->fails()) {
            echo json_encode(['code'=>0,'msg'=>$validator->errors()]);die;
        }
        $data=[
            'crm_user'=>$post['crm_user'],
            'crm_pwd'=>$post['crm_pwd'],
            'crm_vip'=>0,
            'crm_time'=>time(),
        ];
        $res=db::table('crm_user')->insert($data);
        if ($res){
            echo json_encode(['code'=>1,'msg'=>'添加成功']);die;
        }
    }
    // 品牌展示
    public function banner()
    {
        $name=request()->input();
        $search=request()->input('search');
        $where=[
            ['brand_show','=',1],
        ];
        if (!empty($search)){
            $where[]=[
                'brand_name','like','%'.$search.'%',
            ];
        }

        $data=DB::table('crm_brand')->where($where)->paginate(2);
        return view('admin/banner',compact('data','name','search'));
    }
    // 品牌添加视图
    public function banneradd()
    {

        return view('admin/banneradd');
    }
    // 品牌添加
    public function bannerdo()
    {
        $data=request()->input();
        $validator = Validator::make($data, [
            'brand_name' => 'required|unique:crm_brand',
            'brand_site' => 'required',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'该品牌已存在',
            'brand_site.required'=>'品牌地址不能为空',
            ]
        );
        if ($validator->fails()) {
            return redirect('user/banneradd')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if (request()->hasFile('brand_img')) {
                $data['brand_img']=upload('brand_img');
            }
            $res=DB::table('crm_brand')->insertGetId($data);
//        dd($res);
            if ($res){
                echo "<script>alert('添加成功');location.href='/user/banner/'</script>";
            }
        }
    }
    // 分类添加
    public function topicadd()
    {
        $data=DB::table('crm_cate')->get();
        return view('admin/topicadd',['data'=>$data]);
    }
    public function topicadddo()
    {
        $data=request()->input();
        $validator = Validator::make($data, [
            'c_name' => 'required|unique:crm_cate',
        ],[
                'c_name.required'=>'分类名称不能为空',
                'c_name.unique'=>'该分类已存在',
        ]);
        if ($validator->fails()) {
            return redirect('user/topicadd')
                ->withErrors($validator)
                ->withInput();
        }
        $res=DB::table('crm_cate')->insertGetId($data);
        if ($res){
            echo "<script>alert('添加成功');location.href='/admin/user/topicaddlist/'</script>";

        }
    }
    public function topicaddlist()
    {
        $data=DB::table('crm_cate')->get();
        $date=getcookie($data);
        return view('admin/topicaddlists',['data'=>$date]);
    }
    public function banners($brand_id)
    {
        $res=DB::table('crm_brand')->where(['brand_id'=>$brand_id])->delete();
        if ($res)
        {
            echo "<script>alert('删除成功');location.href='/user/banner/'</script>";
        }
    }

    /**
     *
     * 周五测试题
     *
     */
    public function lianjieadd()
    {
        return view('admin/lianjie');
    }
    public function lianjiedo()
    {
        $name=request()->input();
        $validator = Validator::make($name, [
            'w_name' => 'required|unique:lianjie|alpha_dash',
            'w_url' => 'url',
        ],[
            'w_name.required'=>'网站名称不能为空',
            'w_name.unique'=>'网站名称不能重复',
            'w_name.alpha_dash'=>'网站只能有数字 字母下划线 汉子组成',
            'w_url.url'=>'请输入正确的网站地址',
        ]);
        if ($validator->fails())
        {
            return redirect('admin/user/lianjieadd')
                ->withErrors($validator)
                ->withInput();
        }
        if (request()->hasFile('w_logo')) {
             $name['w_logo']=upload('w_logo');
        }
        $res=DB::table('lianjie')->insertGetId($name);
        if ($res){
            echo "<script>alert('添加成功');location.href='/admin/user/lianjielist'</script>";
        }
    }
    public function lianjielist()
    {
        $name=request()->input();
        $page=request()->input('sousuo');
        $where=[];
        if ($page!=''){
            $where=[
                ['w_name','like','%'.$page.'%'],
            ];
        }
        $data=DB::table('lianjie')->where($where)->paginate(2);
        return view('admin/lianjielist',compact('data','name'));
    }
    public function delete()
    {
        $id=request()->input();
        $w_id=$id['w_id'];
        $data=DB::table('lianjie')->where(['w_id'=>$w_id])->delete();
        if ($data){
            return json_encode(['code'=>1,'msg'=>'删除成功']);
        }
    }
    public function update($w_id)
    {
        $data=DB::table('lianjie')->where(['w_id'=>$w_id])->first();
        return view('admin/update',compact('data'));
    }
    public function updateadd($w_id)
    {
        $data=request()->post();
        $validator = Validator::make($data, [
            'w_name'=>[
                'required',
                'alpha_dash',
                Rule::unique('lianjie')->ignore($w_id,'w_id'),
            ],
            'w_url' => 'url',
        ],[
            'w_name.required'=>'网站名称不能为空',
            'w_name.unique'=>'网站名称不能重复',
            'w_name.alpha_dash'=>'网站只能有数字 字母下划线 汉子组成',
            'w_url.url'=>'请输入正确的网站地址',
        ]);
        if ($validator->fails())
        {
            return redirect('admin/user/update/'.$w_id.'')
                ->withErrors($validator)
                ->withInput();
        }

        if (request()->hasFile('w_logo')) {

            if ($data['img']){
                $data['w_logo']=upload('w_logo');
                $imgs=storage_path('app/public').'/'.$data['img'];
                if (file_exists($imgs)){
                    unlink($imgs);
                }
            }else{
                $data['w_logo']=upload('w_logo');
            }
        }
        unset($data['img']);

        $res=DB::table('lianjie')->where(['w_id'=>$w_id])->update($data);
        echo "<script>alert('修改成功');location.href='/admin/user/lianjielist/ '</script>";

    }
    public function weiyi()
    {
        $name=request()->input();
        $w_name=$name['w_name'];
        $data=DB::table('lianjie')->where(['w_name'=>$w_name])->count();
        if ($data>0){
            echo json_encode(['code'=>1,'msg'=>'该网站名称已存在']);die;
        }
    }
    // 登陆
    public function login()
    {
        return view('admin/login');
    }
    public function login_do()
    {
        $data=request()->input();
        $res=DB::table('crm_user')->where($data)->count();
        if ($res>0){
            session(['userinfo'=>$data]);
            echo "<script>alert('登陆成功');location.href='/admin/user/index';</script>";
        }else{
            echo "<script>alert('账号或密码不正确');location.href='/admin/login';</script>";
        }

    }
    public function out()
    {
        request()->session()->forget('userinfo');
        return redirect('admin/login');
    }
    public function goods()
    {
        $data=DB::table('crm_cate')->get();
        // dd($data);
        $admin_cat=getcookie($data);
        $res=DB::table('crm_brand')->get();
        return view('admin/goods',compact('admin_cat','res'));
    }
    public function goods_do()
    {
        $data=request()->input();
        $validator=Validator::make(request()->all(), [
            'goods_name'=>'required|max:30',
            'goods_price'=>'required|numeric',
            'goods_number'=>'required|numeric',
            'brand_id'=>'required',
            'c_id'=>'required',
        ],[
            'goods_name.required'=>'商品名称不能为空',
            'goods_price.required'=>'价格不能为空',
            'goods_price.numeric'=>'输入必须位数字',
            'goods_number.required'=>'数量不能为空',
            'goods_number.numeric'=>'输入必须位数字',
            'brand_id.required'=>'品牌必选',
            'c_id.required'=>'分类必选',
        ]);
        if ($validator->fails()) {
            return redirect('admin/user/goods')
                ->withErrors($validator)
                ->withInput();
        }
        if(request()->hasFile('goods_img')){
            $data['goods_img']=$this->files('goods_img');
        }
        $data['goods_time']=time();
        $res=DB::table('crm_goods')->insert($data);
        if($res){
            return redirect('admin/user/goods_list');
        }
    }
    // 上传图片的方法
    public function files($name)
    {
        if ( request()->file($name)->isValid()) {
            $photo = request()->file($name);
            $store_result = $photo->store('', 'public');
            return $store_result;
        }
    }
    // 商品展示
    public function goods_list()
    {

        $query=request()->input();
        $where=[];
        $goods_name=request()->get('goods_name')??'';
        $c_id=request()->get('c_id')??'';
        $brand_id=request()->get('brand_id')??'';
        $is_on_sale=request()->get('is_on_sale')??'';
        if($goods_name){
            $where[]=['goods_name','like','%'.$goods_name.'%'];
        }
        if($c_id){
            $where[]=['c_id','=',$c_id];
        }
        if($brand_id){
            $where[]=['brand_id','=',$brand_id];
        }
        if($is_on_sale){
            $where[]=['is_on_sale','=',$is_on_sale];
        }
        $admin_cat=DB::table('crm_cate')->get();
        $admin_cat=getcookie($admin_cat);
        $brand_name=DB::table('crm_brand')->get();
        $goods_data=DB::table('crm_goods')->join('crm_cate','crm_goods.c_id','=','crm_cate.c_id')->join('crm_brand','crm_goods.brand_id','=','crm_brand.brand_id')->where($where)->paginate('2');
        return view('admin/goodslist',compact('goods_data','admin_cat','brand_name','query','goods_name','is_on_sale','brand_id','c_id'));
    }
    function goods_update($id)
    {
        $goods=DB::table('crm_goods')->where(['goods_id'=>$id])->first();
        $res=DB::table('crm_brand')->get();
        $admin_cat=DB::table('crm_cate')->get();
        getcookie($admin_cat);
        return view('admin/goods_update',compact('goods','res','admin_cat'));
    }
    function goods_updo($goods_id)
    {
        $data=request()->post();
        if (request()->hasFile('goods_img')) {

            if ($data['img']){
                $data['goods_img']=upload('goods_img');
                $imgs=storage_path('app/public').'/'.$data['img'];
                if (file_exists($imgs)){
                    unlink($imgs);
                }
            }else{
                $data['goods_img']=upload('goods_img');
            }
        }
        unset($data['img']);
        $res=DB::table('crm_goods')->where(['goods_id'=>$goods_id])->update($data);
        echo "<script>alert('修改成功');location.href='/admin/user/goods_list/ '</script>";
    }
    function goods_del($goods_id)
    {
        $data=DB::table('crm_goods')->where(['goods_id'=>$goods_id])->first();
        $imgs=storage_path('app/public').'/'.$data->goods_img;
        unlink($imgs);
        $res=DB::table('crm_goods')->where(['goods_id'=>$goods_id])->delete();
        if ($res){
            echo "<script>alert('删除成功');location.href='/admin/user/goods_list'</script>";
        }
    }
}
