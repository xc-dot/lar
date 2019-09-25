<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="/css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ alert($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;-</span>&nbsp;管理员管理
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>

                        @csrf
						<div class="cfD">

							<input class="userinput" type="text" id="user" name="user" placeholder="输入用户名" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
                            <input class="userinput vpr" type="password" id="pwd" name="pwd" placeholder="输入用户密码" />
							<button class="userbtn">添加</button>
						</div>

					</form>
				</div>
				<script>
                    // 失去焦点查看用户。。。
                    {{--$('[name="user"]').blur(function(){--}}
                    {{--    // event.preventDefault();--}}
                    {{--    var _token=$('[name="_token"]').val();--}}
                    {{--    var user=$('[name="user"]').val();--}}
                    {{--    // if(user==''){--}}
                    {{--    //     alert('用户名不能为空');return;--}}
                    {{--    // }--}}
                    {{--    $.get(--}}
                    {{--        "{{route('user')}}",--}}
                    {{--        {user:user,_token:_token},--}}
                    {{--        function(res){--}}
                    {{--            alert(res);--}}
                    {{--            // window.location.reload();--}}
                    {{--        }--}}
                    {{--    )--}}
                    {{--});--}}
                    // 添加用户。。。
					$('.userbtn').click(function(){
					    event.preventDefault();

						var user=$('[name="user"]').val();
                        var pwd=$('[name="pwd"]').val();
                        var _token=$('[name="_token"]').val();

						$.post(
								"{{route('user_do')}}",
								{crm_user:user,crm_pwd:pwd,_token:_token},
								function(res){
                                    if (res.code==0) {
                                        if(!(typeof(res.msg.crm_user) == "undefined")){
                                            alert(res.msg.crm_user);
                                        }
                                        if(!(typeof(res.msg.crm_pwd) == "undefined")){
                                            alert(res.msg.crm_pwd);
                                        }
                                    }
									if (res.code==1){
                                        if(!(typeof(res.msg) == "undefined")){
                                            alert(res.msg);
                                        }
                                        window.location.reload();
                                    }
								},
								'json'
						);
					});
				</script>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="400px" class="tdColor">用户名</td>
							<td width="630px" class="tdColor">添加时间</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>

                        @foreach ($data as $v)
                        <tr height="40px">
							<td>{{$v->crm_id}}</td>
							<td>{{$v->crm_user}}</td>
							<td>{{date('Y-m-d H:i:s',$v->crm_time)}}</td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="/admin/img/update.png"></a> <img class="operation delban"
								src="/admin/img/delete.png"></td>
						</tr>
                            @endforeach
					</table>

					<div class="paging">
						{{$data->links()}}
					</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
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
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
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
</script>
</html>