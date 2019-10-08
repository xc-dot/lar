<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use seesion;
class HadminController extends Controller
{
    /**
     * 
     * 登入页面
     */
    public function login()
    {
         return view ('hadmin/login');
    }
    //登录
    public function login_do(Request $request)
    {
        $username = request('username');
        $password = request('password');
        //用户名错误 密码错误 用户名或者错误
        $adminInfo = DB::table('users')->where(['username'=>$username,'password'=>$password])->first();
        if(!$adminInfo){
            //报错登录失败;
            die;
            // return view('hadmin/login');
        }
        $adminInfo = $adminInfo->toArray();
        //登录成功 存储到session中
        seesion(['adminInfo'=>$adminInfo]);
        return redirect('hindex/hindex');

    }
    /**
     * 发送短信验证码
     */
    public function send()
    {

    }
}
