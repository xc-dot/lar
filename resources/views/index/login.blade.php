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
     <form action="user.html" method="get" class="reg-login">
      <h3>还没有三级分销账号？点此<a class="orange" href="{{route('reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_name" value="" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="u_pwd" value="" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" name="sub" class="sub" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     第三方登陆：<button class="weixin">微信登陆</button>
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
    <script type="text/javascript">
        $('.weixin').click(function(){
            window.location.href="{{url('index/wechat_login')}}";
        });
    </script>
     <script>
         $('input[name="u_name"]').blur(function(){
                var u_name=$(this).val();
                if (u_name==''){
                    alert('请输入邮箱号或者手机号');
                    return;
                }

         });
         $('input[name="u_pwd"]').blur(function(){
             var u_pwd=$(this).val();
             if (u_pwd==''){
                 alert('请输入密码');
                 return;
             }

         });
         $('.sub').click(function(){
             event.preventDefault();
             var u_name=$('input[name="u_name"]').val();
             $('input[name="u_name"]').next().remove('b');
             if (u_name==''){
                 $('input[name="u_name"]').after('<b style="color:red">邮箱不能为空<b>');
                 return;
             }
             var u_pwd=$('input[name="u_pwd"]').val();
             $('input[name="u_pwd"]').next().remove('b');
             if (u_pwd==''){
                 $('input[name="u_pwd"]').after('<b style="color:red">密码不能为空<b>');
                 return;
             }
             $.post(
                 "{{route('login_do')}}",
                 {u_name:u_name,u_pwd:u_pwd},
                 function(res){
                    if(res.code==0){
                        alert(res.msg);
                        return;
                    }
                    if (res.code==1){
                        alert(res.msg);
                        location.href='/';
                    }
                 },
                 'json',
             );
         });
     </script>
@endsection
