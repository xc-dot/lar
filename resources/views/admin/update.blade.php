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
        <form action="{{url('admin/user/updateadd/'.$data->w_id)}}" method="post" enctype="multipart/form-data">
            <div class="banneradd bor">
                <div class="baTop">
                    <span>修改网址</span>
                </div>
                <div class="baBody">
                    <div class="bbD">
                        网站名称： <input type="text" value="{{$data->w_name}}" name="w_name" class="input1" />
                    </div>
                    <div class="bbD">
                        网站地址： <input type="text" value="{{$data->w_url}}" name="w_url" class="input1" />
                    </div>
                    <div class="bbD">
                        链接类型：
                        <label><input type="radio" @if($data->w_cate==1) checked="checked" @endif name="w_cate" value="1" checked="checked" />LOGO链接</label>
                        <label><input type="radio" @if($data->w_cate==0) checked="checked" @endif name="w_cate" value="0"/>文字链接</label>
                    </div>
                    <div class="bbD">
                        品牌Logo：
                        <div class="bbDd">
                            <input type="hidden" name="img" value="{{$data->w_logo}}">
                            <div class="bbDImg">@if($data->w_logo!='')<img width="159px" height="180px" src="{{env('UOLOAD_URL')}}/{{$data->w_logo}}" alt="">@else + @endif</div>
                            <input type="file" name="w_logo" class="file" />
                            {{--							<a class="bbDDel" href="#">删除</a>--}}
                        </div>
                    </div>
                    <div class="bbD">
                        网站联系人： <input type="text" value="{{$data->w_user}}" name="w_user" class="input1" />
                    </div>
                    <div class="bbD">
                        网站介绍：    <textarea name="w_desc" >{{$data->w_desc}}</textarea>
                    </div>
                    <div class="bbD">
                        是否显示：
                        <label><input type="radio" @if($data->w_show==1) checked="checked" @endif name="w_show" value="1" checked="checked" />是</label>
                        <label><input type="radio" @if($data->w_show==0) checked="checked" @endif name="w_show" value="0"/>否</label>
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                            <input type="submit" value="提交" class="input2" id="submit">
                        </p>
                    </div>
                </div>
            </div>
        </form>

    <!-- 上传广告页面样式end -->
    </div>
</div>
</body>
</html>
