<?php

namespace App\Http\Controllers\hadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\cookie;
use Illuminate\Support\Facades\Storage;
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
            
            return view('hadmin/login');
        }
        // $adminInfo = $adminInfo->toArray();
        //登录成功 存储到session中
        session(['adminInfo'=>$adminInfo]);
        return redirect('hindex/hindex');

    }
    /**
     * 发送短信验证码
     */
    public function send(Request $request)
    {
          //接受用户名 密码
          $username =  request('username');
          $password =  request('password');
          //查询数据库
          $adminData = '';
          $openid = $adminData['openid'];
    }
}
