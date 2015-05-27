<!-- 注册页面 -->
<div id="register">
	<div class="containet">
		<form id="register-form" action="<?php echo site_url();?>/register/register" method="post">
			<p class="title">注册</p>
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
					<input type="text" class="form-control text" placeholder="真实姓名" name="name" id="name">
				</div>
				<div class="form-label">
					<div class="label"></div>
				</div>
			</div>
			<div class="form-item">
				<div class="form-input">
					<input type="text" class="form-control text" placeholder="手机号" name="phone" id="phone">
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
			<div class="form-item">
				<div class="form-input">
					<input type="password" class="form-control text" placeholder="确认密码" name="confirm" id="confirm">
				</div>
				<div class="form-label">
					<div class="label"></div>
				</div>
			</div>
			<div class="form-item code-item">
				<div class="form-input">
					<input type="text" class="form-control text" placeholder="验证码" name="checkcode" id="checkcode">
				</div>
				<div class="form-label">
					<div class="label"></div>
				</div>
				<div class="checkcode">
					<div><img src="<?php echo base_url();?>index.php/register/getCode" onclick="this.src='<?php echo base_url();?>index.php/welcome/getCode?'+Math.random()"><br></div>
				</div>
			</div>
			<div class="form-item checkbox-item">
				<div class="form-input">
					<input type="checkbox" name="checkbox" id="checkbox">
				</div>
				<div class="form-content">
					<div class="content">
						<p>我已阅读并接受<a href = "">版权声明</a>和<a href = "">隐私保护</a>条款</p>
					</div>
				</div>
			</div>
			<input type="submit" class="btn btn-primary" value="注册" name="sub" id="sub">
		</form>
	</div>
</div>
<!-- 注册页面结束 -->