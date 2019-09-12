<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <form action="{{url('/wechat/do_add_tag')}}" method="post">
            @csrf
            标签名称：<input type="text" name="tag_name">
            <br> 
            <br>
            <input type="submit" value='提交'>
        
        </form>
    </center>
</body>
</html>