<?php

namespace App\Http\Controllers\index;
use Mail;
use DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexcontroller extends Controller
{
    public function index()
    {
        $count=DB::table('index_user')->count();
        $cate=DB::table('crm_cate')->where(['p_id'=>1])->limit(4)->get();
        $goods=DB::table('crm_goods')->get();
        return view('index/index',compact('count','cate','goods'));
    }
    // 注册
    public function reg()
    {
        return view('index/reg');
    }
    public function reg_do()
    {
        $crm_temail=request()->crm_temail;
        $count=DB::table('index_user')->where(['u_email'=>$crm_temail])->count();
        if ($count>0){
            echo  json_encode(['code'=>0,'msg'=>'邮箱已被注册请重新填写']);return;
        }
        $fand=rand(1000,9999);
        $msg="欢迎注册滕浩有限公司,您的验证码是".$fand;
        $this->send($crm_temail,$msg);
        session(['code'=>$fand]);
        echo json_encode(['code'=>0,'msg'=>'验证码发送成功']);return;
    }
    public function send($email,$msg)
    {
        \Mail::raw($msg ,function($message)use($email){
            //设置主题
            $message->subject("欢迎注册滕浩有限公司");
            //设置接收方
            $message->to($email);
        });
    }
    function regadd_do()
    {
        $data=request()->input();
        if ($data['crm_ver']!=session('code')){
            echo  json_encode(['code'=>0,'mag'=>'验证码错误']);return;
        }
        if ($data['u_pwd']!=$data['crm_pwds']){
            echo  json_encode(['code'=>0,'mag'=>'密码与确认密码不一致请重新填写']);return;
        }
        $count=DB::table('index_user')->where(['u_email'=>$data['u_email']])->count();
        if ($count>0){
            echo  json_encode(['code'=>0,'mag'=>'邮箱已被注册请重新填写']);return;
        }
        $res=DB::table('index_user')->insert(['u_email'=>$data['u_email'],'u_pwd'=>md5($data['u_pwd'])]);
        if ($res){
            echo  json_encode(['code'=>1,'mag'=>'注册成功']);return;
        }
    }

    //登陆
    public function login()
    {
        return view('index/login');
    }
    public function login_do()
    {
        $data=request()->input();
        $u_name=DB::table('index_user')->where(['u_email'=>$data['u_name']])->count();
        if ($u_name==0){
            echo json_encode(['code'=>0,'msg'=>'账号不存在']);return;
        }
        $res=DB::table('index_user')->where(['u_email'=>$data['u_name'],'u_pwd'=>md5($data['u_pwd'])])->count();
        if ($res>0){
            $name=DB::table('index_user')->where(['u_email'=>$data['u_name'],'u_pwd'=>md5($data['u_pwd'])])->first();
            session(['indexinfo'=>$name]);
            echo json_encode(['code'=>1,'msg'=>'登陆成功']);return;
        }
    }
    // 展示
    public function prolist($c_id)
    {
        $data=DB::table('crm_cate')->get();
        $cata=getcookie($data,$c_id);
        $id=array_column($cata,'c_id');
        $goods=DB::table('crm_goods')->orderBy('is_new','asc')->whereIn('c_id',$id)->get();
        return view('index/prolist',['goods'=>$goods]);
    }
    function proinfo($id)
    {
        $data=DB::table('crm_goods')->where(['goods_id'=>$id])->first();
        return view('index/proinfo',['data'=>$data]);
    }
    //用户信息
    function user()
    {
        return view('index/user');
    }

    public function moil()
    {
        return view('layouts/moil');
    }
    /****
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     *  添加购物车
     *
     */
    function car_do($id)
    {
        $where=[];
        if (!session('indexinfo')){
            return redirect('/index/login');
        }else{
            $price=DB::table('crm_goods')->where(['goods_id'=>$id])->first();
            $where=[
                'goods_id'=>$id,
                'user_id'=>session('indexinfo')->u_id,
                'price'=>$price->goods_price,
            ];
        }
        $name=DB::table('index_car')->where(['goods_id'=>$id, 'user_id'=>session('indexinfo')->u_id,])->first();
        if ($name!=''){
            $num=$name->number+'1';
            $res=DB::table('index_car')->where(['car_id'=>$name->car_id])->update(['number'=>$num]);
            return redirect('/index/car');
        }else{
            $res=DB::table('index_car')->insertGetId($where);
            return redirect('/index/car');
        }
    }
    // 购物车
    public function car()
    {
        $count=DB::table('index_car')->count();
        if (session('indexinfo')){
            $data=DB::table('index_car')->where(['user_id'=>session('indexinfo')->u_id])->join('crm_goods','index_car.goods_id','=','crm_goods.goods_id')->get();
        }else{
            return redirect('/index/login');die;
        }
        return view('index/car',compact('data','count'));
    }

    /***
     * @return string
     *
     * 计算价格
     *
     *
     */
    function getmoney()
    {
        $id=request()->id;
        $total=0;
        if(!$id){
            return json_encode(['total'=>number_format(0,2,'.','')]);
        }
        $price=implode(',',$id);
        if (!session('indexinfo')){
            return redirect('/index/login');die;
        }
        $user_id=session('indexinfo')->u_id;
        $sql = DB::select("select SUM(number * price) as total from index_car where user_id=$user_id and goods_id in($price)");
        $total=json_decode(json_encode($sql),true);
        $total=array_reduce($total,'array_merge',array());
        $total=implode(',',$total);
        return json_encode(['total'=>$total]);
    }
    /***
     *
     * 批量删除
     *
     *
     */
    public function del()
    {
        $ids=request()->post();
        if (!is_array($ids)){
            $ids=explode(',',$ids);
        }
        foreach ($ids as $v){
//            $data=DB::table('index_car')->where('goods_id','=',$v)->get();
            $res=DB::table('index_car')->where('goods_id','=',$ids)->delete();
        }
        if ($res){
            return json_encode(['code'=>1,'msg'=>'删除成功']);
        }
    }
    // 手机短信
    public function telduanxin()
    {
        header("Content-Type:text/html;charset=UTF-8");
        date_default_timezone_set("PRC");
        $showapi_appid = '102842';  //替换此值,在官网的"我的应用"中找到相关值
        $showapi_secret = '02f3a8a7e14942e4a9607da6be1b14d4';  //替换此值,在官网的"我的应用"中找到相关值
        $paramArr = array(
        'showapi_appid'=> $showapi_appid,
                        'content'=> "您好,13121122026,验证码是[你真帅], 本次登录密码有效时间为[永久]分钟",
                        'title'=> "某某公司名称",
                        'notiPhone'=> "13121122026"
        //添加其他参数
        );
    //创建参数(包括签名的处理)
    function createParam ($paramArr,$showapi_secret) {
        $paraStr = "";
        $signStr = "";
        ksort($paramArr);
        foreach ($paramArr as $key => $val) {
          if ($key != '' && $val != '') {
            $signStr .= $key.$val;
            $paraStr .= $key.'='.urlencode($val).'&';
          }
        }
        $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
        $sign = strtolower(md5($signStr));
        $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
        echo "排好序的参数:".$signStr."\r\n";
        return $paraStr;
    }
        $param = createParam($paramArr,$showapi_secret);
        $url = 'http://route.showapi.com/28-2?'.$param;
        echo "请求的url:".$url."\r\n";
        $result = file_get_contents($url);
        echo "返回的json数据:\r\n";
        print $result.'\r\n';
        $result = json_decode($result);
        echo "\r\n取出showapi_res_code的值:\r\n";
        print_r($result->showapi_res_code);
        echo "\r\n";
    }
    
    /**
     *微信登陆
     *
     */
    function wechat_login()
    {
        $redirect_uri = 'http://www.lar.com/index/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
        header('Location:'.$url);
    }
      /**
     * 接收code 第二部
     */
    public function code(Request $request)
    {
        DB::beginTransaction();
        $req = $request->all();
        $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        $re = json_decode($result,1);
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
//        dd($wechat_user_info);
        $name=DB::table('weixin')->where(['open_id'=>$wechat_user_info['openid']])->first();
//        dd($name);
        if (!empty($name)){
            $request->session()->put(['indexinfo'=>$wechat_user_info]);
            return 'ok';
        }else{
            $uid=DB::table('index_user')->insertGetId([
                'u_email'=>$wechat_user_info['nickname'],
                'u_pwd'=>'',
            ]);
            $data=DB::table('weixin')->insert([
                'u_id'=>$uid,
                'open_id'=>$wechat_user_info['openid'],
            ]);
            $request->session()->put(['indexinfo'=>$wechat_user_info]);
            return redirect('/index/index');
        }
    }
}
