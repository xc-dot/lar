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
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>
    <div class="page">
        <!-- banner页面样式 -->
        <div class="banner">
            <!-- banner 表格 显示 -->
            <div class="banShow">
                <br><br>
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="65px" class="tdColor"></td>
                        <td width="800px" class="tdColor">分类名称</td>
                        <td width="100px" class="tdColor">操作</td>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td>+</td>
                        <td>{{$v->c_name}}</td>
                        <td>
                            <a href="banneradd.html">
                            <img class="operation" src="/admin/img/update.png"></a>
                            <img class="operation delban" src="/admin/img/delete.png">
                        </td>
                    </tr>
                    @endforeach
                </table>
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

    function del(){
        var input=document.getElementsByName("check[]");
        for(var i=input.length-1; i>=0;i--){
            if(input[i].checked==true){
                //获取td节点
                var td=input[i].parentNode;
                //获取tr节点
                var tr=td.parentNode;
                //获取table
                var table=tr.parentNode;
                //移除子节点
                table.removeChild(tr);
            }
        }
    }
</script>
</html>