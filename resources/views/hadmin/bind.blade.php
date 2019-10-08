<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>绑定管理员账号</h1>
    <form action="" method='post'>
        @csrf
        用户名：<input type="text"><br><br>
        密码：&nbsp;&nbsp; <input type="password"><br><br>
        <input type="submit" value='绑定'>
    </form>
</body>
</html>