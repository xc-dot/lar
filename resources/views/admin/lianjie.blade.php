<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">

    <div class="page ">
        <!-- 上传广告页面样式 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('lianjiedo')}}" method="post" enctype="multipart/form-data">
            <div class="banneradd bor">
                <div class="baTop">
                    <span>添加网址</span>
                </div>
                <div class="baBody">
                    <div class="bbD">
                        网站名称： <input type="text" name="w_name" class="input1" />
                    </div>
                    <div class="bbD">
                        网站地址： <input type="text" name="w_url" class="input1" />
                    </div>
                    <div class="bbD">
                        链接类型：
                        <label><input type="radio" name="w_cate" value="1" checked="checked" />LOGO链接</label>
                        <label><input type="radio" name="w_cate" value="0"/>文字链接</label>
                    </div>
                    <div class="bbD">
                        品牌Logo：
                        <div class="bbDd">
                            <div class="bbDImg">+</div>
                            <input type="file" name="w_logo" class="file" />
                            {{--							<a class="bbDDel" href="#">删除</a>--}}
                        </div>
                    </div>
                    <div class="bbD">
                        网站联系人： <input type="text" name="w_user" class="input1" />
                    </div>
                    <div class="bbD">
                        网站介绍：    <textarea name="w_desc"></textarea>
                    </div>
                    <div class="bbD">
                        是否显示：
                        <label><input type="radio" name="w_show" value="1" checked="checked" />是</label>
                        <label><input type="radio" name="w_show" value="0"/>否</label>
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                            <input type="submit" value="提交" class="input2" id="submit">
                            {{--							<a class="btn_ok btn_no" href="#">取消</a>--}}
                        </p>
                    </div>
                </div>
            </div>
            <script>
                $('[name="w_name"]').blur(function(){
                    var w_name=$(this).val();
                    var reg=/^[a-zA-Z_][a-zA-Z0-9_]{6,}$/;
                    if (w_name==''){
                        alert('网站名称不能为空');
                        return false;
                    }else if(reg.test(w_name)){
                        alert('网站名称必须以字母数字下划线组成');
                        return false;
                    }
                    $.post(
                        "{{route('weiyi')}}",
                        {w_name:w_name},
                        function(res){
                            alert(res.msg);
                        },
                        'json'

                    );
                });
                $('[name="w_url"]').blur(function(){
                    var w_url=$(this).val();
                    var msg=/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/;
                    if (w_url==''){
                        alert('网站地址不能为空');
                        return false;
                    }else if(!msg.test(w_url)){
                        alert('网站地址不正确');
                        return false;
                    }
                });
            </script>
        </form>
        <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>
