@extends('layouts.shop')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="" method="" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" value="" name="crm_temail" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" value="" name="crm_ver" placeholder="输入短信验证码" /> <button class="but">获取验证码</button></div>
       <div class="lrList"><input type="text" value="" name="crm_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" value="" name="crm_pwds" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" name="sub" class="sub" value="立即注册" />
      </div>

     </form><!--reg-login/-->
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
     <script>
         $('.but').click(function(){
             event.preventDefault();
             var crm_temail=$('input[name="crm_temail"]').val();
             var sgm=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
             $('input[name="crm_temail"]').next().remove('b');
             if (crm_temail==''){
                 $('input[name="crm_temail"]').after('<b style="color:red">手机或者邮箱不能为空<b>');
                 return ;
             }
             if (!(sgm.test(crm_temail))){
                 $('input[name="crm_temail"]').after('<b style="color:red">邮箱格式不正确<b>');
                 return;
             }
             $.post(
                 "{{route('reg_do')}}",
                 {crm_temail:crm_temail},
                 function(res){
                    if(res.code==0){
                        alert(res.msg);
                    }
                 },
                 'json'
             );
         });
         $('.sub').click(function(){
            event.preventDefault();
            var crm_temail=$('input[name="crm_temail"]').val();
            var crm_ver=$('input[name="crm_ver"]').val();
            var crm_pwd=$('input[name="crm_pwd"]').val();
            var crm_pwds=$('input[name="crm_pwds"]').val();
             var sgm=/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
             $('input[name="crm_temail"]').next().remove('b');
             if (crm_temail==''){
                 $('input[name="crm_temail"]').after('<b style="color:red">手机或者邮箱不能为空<b>');
                 return ;
             }
             if (!(sgm.test(crm_temail))){
                 $('input[name="crm_temail"]').after('<b style="color:red">邮箱格式不正确<b>');
                 return;
             }
             if (crm_pwd==''){
                 $('input[name="crm_pwd"]').after('<b style="color:red">密码不能为空</b>');
                 return;
             }
             $.post(
                 "{{route('regadd_do')}}",
                 {u_email:crm_temail,crm_ver:crm_ver,u_pwd:crm_pwd,crm_pwds:crm_pwds},
                 function(res){
                     if(res.code==0){
                         alert(res.mag);
                         return;
                     }
                     if(res.code==1){
                        alert(res.mag);
                        location.href="/index/login";
                     }
                 },
                 'json'
             );
         });
     </script>
@endsection
