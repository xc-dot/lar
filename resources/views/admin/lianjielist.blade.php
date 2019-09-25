<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>广告-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>
<div id="pageAll">
    <div class="page">
        <!-- banner页面样式 -->
        <div class="banner">
            <!-- banner 表格 显示 -->
            <div class="banShow">
                <br><br>
                <form action="{{route('lianjielist')}}" method="get">
                    <input type="text" name="sousuo" value=""><input type="submit" value="搜索">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65px" class="tdColor"><input type="checkbox"></td>
                        <td width="65px" class="tdColor">排序</td>
                        <td width="250px" class="tdColor">网站名称</td>
                        <td width="150px" class="tdColor">图片Logo</td>
                        <td width="100px" class="tdColor">所属分类</td>
                        <td width="110px" class="tdColor">链接类型</td>
                        <td width="100px" class="tdColor">状态</td>
                        <td width="100px" class="tdColor">管理操作</td>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td><input type="checkbox" id=""></td>
                            <td><input type="text" size="3" value="{{$v->w_num}}" id=""></td>
                            <td>{{$v->w_name}}</td>
                            <td><img src="{{env('UOLOAD_URL')}}/{{$v->w_logo}}" width="80px" alt=""></td>
                            <td>暂时没有</td>
                            <td>@if($v->w_cate==1)Logo链接@else文字链接@endif</td>
                            <td>@if($v->w_show==1)显示@else隐藏@endif</td>
                            <td>
                                <a href="{{url('admin/user/update/'.$v->w_id)}}"><input type="button" value="修改"></a>
                                <button value="{{$v->w_id}}" class="del">删除</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="paging">{{$data->appends($name)->links()}}</div>
                </form>

            </div>
            <!-- banner 表格 显示 end-->
        </div>
        <!-- banner页面样式end -->
    </div>

</div>


<!-- 删除弹出框 -->
<div class="banDel">
    <div class="delete">
        <div class="close">
            <a><img src="/admin/img/shanchu.png" /></a>
        </div>
        <p class="delP1">你确定要删除此条记录吗？</p>
        <p class="delP2">
            <a href="#" class="ok yes" onclick="del()">确定</a><a class="ok no">取消</a>
        </p>
    </div>
</div>
<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
    // 广告弹出框
    $(".delban").click(function(){
        $(".banDel").show();
    });
    $(".close").click(function(){
        $(".banDel").hide();
    });
    $(".no").click(function(){
        $(".banDel").hide();
    });
    // 广告弹出框 end
    $('.del').click(function(){
        var w_id=$(this).val();
        $.post(
            "{{route('delete')}}",
            {w_id:w_id},
            function(res){
                alert(res.msg);
                if (res.code=1){
                    location.reload();
                }
            },
            'json'
        );
    })

</script>
</html>