<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
</head>
<body>
    <center>
        <h1>登陆</h1>
        用户名：<input type="text"><br/>
        密码：<input type="password"><br/>
        第三方登录<button id="wechat_btn" type="button">微信授权登陆</button>
    </center>
    <script src="{{asset('js/jq.js')}}"></script>
<script>
    $(function(){
        $('#wechat_btn').click(function(){
            // alert('123');
            window.location.href = '{{url("/wechat/login")}}'
        });
    });
</script>
</body>
</html>
