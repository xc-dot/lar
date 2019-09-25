<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">品牌管理</a>&nbsp;-</span>&nbsp;列表管理
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->

			<div class="banner">
				<div class="add">
                    <div class="cfD">
						<form action="{{route('banner')}}" method="get">
							<a class="addA" href="{{route('banneradd')}}">添加品牌&nbsp;&nbsp;+</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="userinput" type="text" name="search" value="{{$search}}" placeholder="搜索条件" />&nbsp;
							<button class="userbtn">搜索</button>
						</form>
                    </div>
				</div>

				<!-- banner 表格 显示 -->
				<div class="banShow">
					<form action="" method="">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="315px" class="tdColor">品牌Logo</td>
							<td width="308px" class="tdColor">品牌名称</td>
							<td width="450px" class="tdColor">品牌地址</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
                        @foreach($data as $v)
						<tr>
							<td>
								<div class="bsImg">
									<img src="{{env('UOLOAD_URL')}}/{{$v->brand_img}}">
								</div>
							</td>
							<td>{{$v->brand_name}}</td>
							<td><a class="bsA" href="#">{{$v->brand_site}}</a></td>
							<td><a href="banneradd.html">
									<img class="operation" src="/admin/img/update.png">
								</a>
								<a href="{{url('user/banners/'.$v->brand_id)}}"><img class="operation" src="/admin/img/delete.png"></a>
							</td>
						</tr>
                            @endforeach
					</table>
					</form>
					<div class="paging">
                        <ul class="pagination">
                            {{$data->appends($name)->links()}}
                        </ul>
                    </div>
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
	
</script>
</html>