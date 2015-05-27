<!-- 登录页面 -->
<div id="login">
	<div class="containet">
		<form id="login-form" action="<?php echo site_url();?>/login/login" method="post">
			<p class="title">登录</p>
			<div class="form-item">
				<div class="form-input">
					<input type="text" class="form-control text" placeholder="邮箱" name="email" id="email">
				</div>
				<div class="form-label">
					<div class="label"></div>
				</div>
			</div>
			<div class="form-item">
				<div class="form-input">
					<input type="password" class="form-control text" placeholder="密码" name="password" id="password">
				</div>
				<div class="form-label">
					<div class="label"></div>
				</div>
			</div>
			<input type="submit" class="btn btn-primary" value="登录" name="sub" id="sub">
		</form>
	</div>
</div>
<!-- 注册页面结束 -->