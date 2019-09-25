<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/public.css" />
<link rel="stylesheet" type="text/css" href="/admin/css/page.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="/admin/js/public.js"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead">
		<img src="/admin/img/logLOGO.png" />
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<div class="logDiv">
		<img class="logBanner" src="/admin/img/logBanner.png" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录</p>
				<p class="p2">有点人员登录</p>
			</div>
			<!-- 输入框 -->
	<form action="{{url('/admin/login_do')}}" method="post">
			<div class="lgD">
				<img class="img1" src="/admin/img/logName.png" /><input type="text" value="" name="crm_user" placeholder="输入用户名" />
			</div>
			<div class="lgD">
				<img class="img1" src="/admin/img/logPwd.png" /><input type="password" value="" name="crm_pwd" placeholder="输入用户密码" />
			</div>
			<div class="lgD logD2">
				<input class="getYZM" type="text" />
				<div class="logYZM">
					<img class="yzm" src="/admin/img/logYZM.png" />
				</div>
			</div>
			<div class="logC">
				<button>登  陆</button>
		</div>
	</form>
	</div>
	<script>
		$("input[name='crm_user']").blur(function(){
			var crm_user=$(this).val();
			var sgm=/^((?![\u3000-\u303F])[\u2E80-\uFE4F]|\·)*(?![\u3000-\u303F])[\u2E80-\uFE4F](\·)*$/;
			$(this).next('b').remove();
			if(!crm_user){
				$(this).after('<b style="color:red">用户名不能为空!</b>');
				return ;
			};
			if (!sgm.test(crm_user)) {
				$(this).after('<b style="color:red">用户名格式不正确！</b>');
				return ;
			}


		});
		$('input[name="crm_pwd"]').blur(function(){
			var crm_pwd=$('input[name="crm_pwd"]').val();
			$(this).next('b').remove();
			if (crm_pwd==''){
				$('input[name="crm_pwd"]').after('<b style="color:red">密码不能为空</b>');
				return ;
			}
		});
		$('button').click(function(){
			var crm_user=$('input[name="crm_user"]').val();
			var sgm=/^((?![\u3000-\u303F])[\u2E80-\uFE4F]|\·)*(?![\u3000-\u303F])[\u2E80-\uFE4F](\·)*$/;
			$('input[name="crm_user"]').next('b').remove();
			if(!crm_user){
				$('input[name="crm_user"]').after('<b style="color:red">用户名不能为空!</b>');
				return ;
			};
			if (!sgm.test(crm_user)) {
				$('input[name="crm_user"]').after('<b style="color:red">用户名格式不正确！</b>');
				return ;
			}
			var crm_pwd=$('input[name="crm_pwd"]').val();
			if (crm_pwd==''){
				$('input[name="crm_pwd"]').after('<b style="color:red">密码不能为空</b>');
				return ;
			}
		});

	</script>
	<!-- 登录body  end -->

	<!-- 登录页面底部 -->
	<div class="logFoot">
		<p class="p1">版权所有：南京设易网络科技有限公司</p>
		<p class="p2">南京设易网络科技有限公司 登记序号：苏ICP备11003578号-2</p>
	</div>
	<!-- 登录页面底部end -->
</body>
</html>