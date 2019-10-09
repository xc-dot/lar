<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.css?v=4.4.0')}}" rel="stylesheet">

    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css?v=4.1.0')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎使用 hAdmin</h3>

            <form class="m-t" role="form" action="{{route('login_do')}}" method='post'>
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" required="" name='username'>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" name='password'>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name='sond' style='width:65%;float:left' placeholder='微信验证码'>
                    <input type="button" class='btn btn-info' value='发送验证码' id='send'>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center"> <a href="login.html#"><small>点击前往微信扫码登录</small></a>
                <!-- | <a href="register.html">注册一个新账号</a> -->
                </p>
                <img src="{{asset('img/5.png')}}" alt="">
            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="{{asset('js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('js/bootstrap.min.js?v=3.3.6')}}"></script>

    
    

</body>

</html>
<script scr='js/jq.js'></script>
<script>
    $('#send').on('click',function(){
        // alert('123');
        //获取用户名 密码
        var username = $("[name='username']").val();
        // alert(username);
        var password = $("[name='password']").val();
    
        //向后台发送ajax请求
        $.ajax({
            url:"{{url('hadmin/send')}}",
            data:{username:username,password:password},
            success:function(res){
                
            }
        })
    })




</script>
