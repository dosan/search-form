<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
		<div class="list-group">
			<?php foreach ($this->shop_cats as $item): ?>
				<a href='<?php echo URL."category/".$item['cat_id']; ?>'  class="list-group-item"><?php echo $item['cat_name'] ?></a>
				<?php if (isset($item['children'])): ?>
					<?php foreach ($item['children'] as $itemChild): ?>
						<a href='<?php echo URL."category/".$itemChild['cat_id']; ?>'  class="list-group-item"><?php echo '>>'.$itemChild['cat_name'] ?></a>
					<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>
		</div><!--/.sidebar-offcanvas-->
<?php if (Session::get('user_login_status') == 1): ?>
		<div id="userBox">
			<a href="<?php echo URL. 'user/' ?>" id="userLink"><?php echo Session::get('user_name'); ?></a><br>
			<a href="<?php echo URL ?>user/logout" onClick="logout();">Log Out</a>
		</div>
<?php else: ?>
	<?php if (! isset($this->hideLoginBox)): ?>
		<div id="loginBox">
			<h2 class="form-signin-heading">Please sign in</h2>
			<label for="user_name" class="sr-only">Email address</label>
			<input type="text" name="user_name" id="user_name" class="form-control" value="" placeholder="Email address" required autofocus>
			<label for="user_password" class="sr-only">Password</label>
			<input name="user_password" type="password" id="user_password" class="form-control" value="" placeholder="Password" required>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me"> Remember me
				</label>
			</div>
			<input id="submit_btn" class="btn btn-lg btn-primary btn-block" type="button" onClick="login();" value="Войти">
			<a href="<?php echo URL ?>user/register" title="Регистрация" class="btn btn-lg btn-primary btn-block">Регистрация</a>
      		<div class="cleaner"></div>
		</div>
	<?php endif ?>
		<div id="userBox" class="hide">
			<a href="#" id="userLink"></a><br>
			<a href="<?php echo URL ?>user/logout" onClick="logout();">Log Out</a>
		</div>
<?php endif ?>
	<div class="menuCaption">Basket</div>
	<a href="<?php echo URL ?>basket" title="Перейти в корзину">В корзине</a>
	<span id="basketcountProducts">
	<?php if ($this->basketcountProducts > 0): 
		echo $this->basketcountProducts;
		else: ?>
		Empty
		<?php endif ?>
	</span>
</div><!-- /.row -->