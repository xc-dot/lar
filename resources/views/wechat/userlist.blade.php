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
    <form action="{{url('/wechat/tag_openid')}}" method='post'>
    @csrf
    <input type="submit" value='提交'>
    <br/>
    <br/>
    <br/>
    <input type="hidden" value='{{$tagid}}' name='tagid'> 
        <table border=1>
        <tr>
            <th></th>
            <th>昵称</th>
            <th>微信号</th>
            <th>操作</th>
        </tr>
        @foreach ($info as $v)
        <tr>
            <td><input type="checkbox" name='openid_list[]' value="{{$v['openid']}}"></td>
            <td>{{$v['nickname']}}</td>
            <td>{{$v['openid']}}</td>
            <td>
                <a href="{{url('wechat/get_user_info/'.$v['openid'])}}">用户信息</a>
                <!-- <a href="{{url('wechat/user_tag_list')}}?openid={{$v['openid']}}">用户标签</a> -->

            </td>
        </tr>
        @endforeach
        </table>
       
    </form>
</center>
</body>
</html>