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
        <form action="{{url('wechat/do_upload')}}" method="post" enctye="multipart/form-data">
            @csrf
            <input type="file" name="file_name" value="">
            <input type="submit" value="提交">
        </form>
    </center>
</body>
</html>