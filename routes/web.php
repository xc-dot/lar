<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 后台
Route::prefix('admin/user')->group(function(){                                     
    // index主页                                                                   
    Route::get('index','admin\usercontroller@index');                             
    Route::get('foot','admin\usercontroller@foot')->name('foot');               
    Route::get('main','admin\usercontroller@main')->name('main');
    Route::get('head','admin\usercontroller@head')->name('head');
    Route::get('left','admin\usercontroller@left')->name('left');
    // 管理员+
    Route::get('user','admin\usercontroller@user')->name('user');
    Route::post('user_do','admin\usercontroller@user_do')->name('user_do');
    // 品牌
    Route::get('banner','admin\usercontroller@banner')->name('banner');
    Route::get('banners/{id}','admin\usercontroller@banners');
    Route::get('banneradd','admin\usercontroller@banneradd')->name('banneradd');
    Route::post('bannerdo','admin\usercontroller@bannerdo')->name('bannerdo');
    // 分类
    Route::get('topicadd','admin\usercontroller@topicadd')->name('topicadd');
    Route::post('topicadddo','admin\usercontroller@topicadddo')->name('topicadddo');
    Route::get('topicaddlist','admin\usercontroller@topicaddlist')->name('topicaddlist');
    // 测试
    Route::get('lianjieadd','admin\usercontroller@lianjieadd')->name('lianjieadd');
    Route::post('lianjiedo','admin\usercontroller@lianjiedo')->name('lianjiedo');
    Route::get('lianjielist','admin\usercontroller@lianjielist')->name('lianjielist');
    Route::post('delete','admin\usercontroller@delete')->name('delete');
    Route::get('update/{id}','admin\usercontroller@update');
    Route::post('updateadd/{id}','admin\usercontroller@updateadd');
    Route::post('weiyi','admin\usercontroller@weiyi')->name('weiyi');
    Route::get('goods','admin\usercontroller@goods')->name('goods');
    Route::post('goods_do','admin\usercontroller@goods_do')->name('goods_do');
    Route::get('goods_list','admin\usercontroller@goods_list')->name('goods_list');
    Route::get('goods_update/{id}','admin\usercontroller@goods_update');
    Route::post('goods_updo/{id}','admin\usercontroller@goods_updo');
    Route::get('goods_del/{id}','admin\usercontroller@goods_del');
});
///////登陆路由//////////////////////////////////////////////////////////
    Route::get('admin/login','admin\usercontroller@login');
    Route::post('admin/login_do','admin\usercontroller@login_do');
    Route::get('admin/out','admin\usercontroller@out')->name('out');
//////前台//////////////////////////////////////////////////////////////
    Route::get('/','index\indexcontroller@index')->name('index');
Route::prefix('index')->group(function() {
    Route::get('reg','index\indexcontroller@reg')->name('reg');
    Route::post('reg_do','index\indexcontroller@reg_do')->name('reg_do');
    Route::get('moil','index\indexcontroller@moil')->name('moil');
    Route::post('regadd_do','index\indexcontroller@regadd_do')->name('regadd_do');
    Route::get('login','index\indexcontroller@login')->name('login');
    Route::post('login_do','index\indexcontroller@login_do')->name('login_do');
    Route::get('user','index\indexcontroller@user')->name('user');
    Route::get('telduanxin','index\indexcontroller@telduanxin');
    Route::get('duanxin','index\indexcontroller@duanxin');
    Route::get('wechat_login','index\indexcontroller@wechat_login');
    Route::get('code','index\indexcontroller@code');
    Route::get('prolist/{id}','index\indexcontroller@prolist');
    Route::get('proinfo/{id}','index\indexcontroller@proinfo');
    Route::get('proinfo/{id}','index\indexcontroller@proinfo');
    Route::get('car_do/{id}','index\indexcontroller@car_do');
    Route::get('car','index\indexcontroller@car');
    Route::post('getmoney','index\indexcontroller@getmoney')->name('getmoney');
    Route::post('del','index\indexcontroller@del')->name('index_del');
});
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
///////////////////////////////////////////////////////////////////////////////
Route::prefix('wechat')->group(function(){
    Route::get('get_access_token','wechat\WechatContrller@get_access_token');//获取access_token
    Route::get('get_wechat_access_token','wechat\WechatContrller@get_wechat_access_token');
    Route::get('get_user_contents','wechat\WechatController@get_user_contents');
    Route::get('get_user_info/{openid}','wechat\WechatController@get_user_info');
    Route::get('upload','wechat\WechatController@upload');//图片
    Route::post('do_upload','wechat\WechatController@do_upload');
    Route::post('curl_upload','wechat\WechatController@curl_upload');
    Route::get('send_message','wechat\WechatController@send_message');//模板消息
    Route::get('location','wechat\WechatController@location');//jssdk获取地理位置
    // Route::get('clear_api','wechat\WechatController@clear_api');
    /////////////////////////---LoginController---//////////////////////////////
    Route::get('login','wechat\LoginController@login');
    Route::get('wechat_login','wechat\LoginController@wechat_login');//微信授权登陆
    Route::get('code','wechat\LoginController@code');//
    /////////////////////////---TagController---///////////////////////////////
    Route::get('tag_list','wechat\TagController@tag_list');//公众号标签列表
    Route::get('add_tag','wechat\TagController@add_tag');
    Route::post('do_add_tag','wechat\TagController@do_add_tag');
    Route::post('do_add_tag','wechat\TagController@do_add_tag');
    Route::get('tag_openid_list','wechat\TagController@tag_openid_list');//粉丝列表 标签下用户的openid列表
    Route::post('tag_openid','wechat\TagController@tag_openid');//为用户找标签
    Route::get('push_tag_message','wechat\TagController@push_tag_message');//推送标签消息
    Route::post('do_push_tag_message','wechat\TagController@do_push_tag_message');//执行推送标签消息
    // Route::get('user_tag_list','wechat\TagController@user_tag_list');//用户下的标签列表
    Route::get('create_menu','wechat\MenuController@create_menu');//创建菜单
    Route::get('menu_list','wechat\MenuController@menu_list');
    Route::get('load_menu','wechat\MenuController@load_menu');//创建菜单
    Route::get('del_menu','wechat\MenuController@del_menu');

});
Route::prefix('Agent')->group(function(){
    Route::get('agent_list','Agent\AgentController@agent_list');
    Route::get('create_qrcode','Agent\AgentController@create_qrcode');//创建二维码
});
Route::any('wechat/event','EventController@event');
// Route::get('aa','EventController@aa');
/**
 * 登入页面
 */
Route::prefix('hadmin')->group(function(){
    Route::get('login','hadmin\HadminController@login');
    Route::post('login_do','hadmin\HadminController@login_do')->name('login_do');
    Route::any('send','hadmin\HadminController@send');
    Route::any('bind','hadmin\HadminController@bind');
    Route::any('bind_do','hadmin\HadminController@bind_do');
});
/**
 * 首页页面
 */
Route::prefix('hindex')->group(function(){
    Route::get('hindex','hindex\HindexController@hindex');
});