<div class="container login-container padding-bottom-lg">
	<div class="row">
	<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
		<header class="text-center">
		<h3>使用你的账号登录</h3>
		<img src="<?php echo base_url();?>data/img/iconClient-Active-1.svg" />
		</header>
		<p class="margin-top-md margin-bottom-md text-center">
			还没有账号,<a href="/register">立即注册</a>
		</p>
		<form method="post" action="/checklogin" enctype="application/x-www-form-urlencoded">
		<input type="hidden" name="refer" value="" id="refer" />
		<div class="form-group margin-bottom-md">
			<label for="username">
			用户名:
			</label>
			<input type="text" class="form-control" name="username" value="" id="username" placeholder="用户名/ID/手机号码" />
		</div>
		<div class="form-group margin-bottom-md">
			<label for="username">
			密码:
			</label>
			<input type="password" class="form-control" name="password" value="" id="password"  />
		</div>
		<button class="btn btn-primary" id="submit">登录</button>
		</form>
	</div>
	</div>
</div>