<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户列表</title>
</head>
<body>
    <center>
        <table border='1'>
            <tr>
                <td>用户ID</td>
                <td>用户名</td>
                <td>分享码</td>
                <td>二维码</td>
                <td>操作</td>
            </tr>
            @foreach($info as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->id}}</td>
                <td><img src="{{asset($v->qrcode_url)}}" alt="" height='100'></td>
                <td><a href="{{url('/Agent/create_qrcode')}}?uid={{$v->id}}">生成专属二维码</a></td>
            </tr>
            @endforeach
        </table>
    </center>
</body>
</html>