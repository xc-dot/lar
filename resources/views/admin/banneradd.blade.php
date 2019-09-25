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
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">品牌管理</a>&nbsp;-</span>&nbsp;添加管理
			</div>
		</div>
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
			<form action="{{route('bannerdo')}}" method="post" enctype="multipart/form-data">
			<div class="banneradd bor">
				<div class="baTop">
					<span>添加商品</span>
				</div>

				<div class="baBody">
					<div class="bbD">
						品牌名称： <input type="text" name="brand_name" class="input1" />
					</div>
					<div class="bbD">
						品牌地址： <input type="text" name="brand_site" class="input1" />
					</div>
					<div class="bbD">
						品牌Logo：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" name="brand_img" class="file" />
{{--							<a class="bbDDel" href="#">删除</a>--}}
						</div>
					</div>
					<div class="bbD">
						是否显示：
						<label><input type="radio" name="brand_show" value="1" checked="checked" />是</label>
						<label><input type="radio" name="brand_show" value="0"/>否</label>
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#">提交</button>
{{--							<a class="btn_ok btn_no" href="#">取消</a>--}}
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