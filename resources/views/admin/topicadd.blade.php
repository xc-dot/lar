<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>话题添加-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">分类管理</a>&nbsp;-</span>&nbsp;分类添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>分类添加</span>
				</div>
				<div class="baBody">
				<form action="{{route('topicadddo')}}" method="post">
					<div class="bbD">
						分类名称：
						<input type="text" name="c_name" class="input3" />
					</div>
					<div class="bbD">
						分类列表：
						<select name="p_id" class="input3">
							@foreach($data as $v)
								<option value="{{$v->c_id}}">{{$v->c_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</form>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>