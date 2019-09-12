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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('wechat')->group(function(){
    Route::get('get_access_token','wechat\WechatContrller@get_access_token');
    Route::get('get_wechat_access_token','wechat\WechatContrller@get_wechat_access_token');
    Route::get('get_user_contents','wechat\WechatController@get_user_contents');
    Route::get('get_user_info/{openid}','wechat\WechatController@get_user_info');
    Route::get('upload','wechat\WechatController@upload');//图片
    Route::post('do_upload','wechat\WechatController@do_upload');
    Route::post('curl_upload','wechat\WechatController@curl_upload');
    Route::get('send_message','wechat\WechatController@send_message');//模板消息
    // Route::get('clear_api','wechat\WechatController@clear_api');
    ///////////////////////////////////////////////////////////////////////////
    Route::get('login','wechat\LoginController@login');
    Route::get('wechat_login','wechat\LoginController@wechat_login');//微信授权登陆
    Route::get('code','wechat\LoginController@code');//
    // Route::get('aaa','wechat\LoginController@aaa');//  
    ////////////////////////////////////////////////////////////////////////////
    Route::get('tag_list','wechat\TagController@tag_list');//公众号标签列表
    Route::get('add_tag','wechat\TagController@add_tag');
    Route::post('do_add_tag','wechat\TagController@do_add_tag');
    Route::post('do_add_tag','wechat\TagController@do_add_tag');
    Route::get('del/{id}','wechat\TagController@del');
 
});
 
