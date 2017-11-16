<?php if (Yii::app()->user->isGuest) :?>
<div class="lk-submenu-container2">
	<div class="lk-submenu-container-bl">
		<form action="/user/login/" method="POST">
			<div class="control-group max">
				<input type="text" class="input-text max" id="inputEmail" name="LoginForm[email]" placeholder="Email" autocomplete="off">
			</div>
			
			<div class="clearfix mb-15"></div>
			
			<div class="control-group max">
				<input type="password" id="inputPassword" class="input-text max" name="LoginForm[password]" placeholder="Пароль">
			</div>
			
			<a href="<?php echo $this->createCPUUrl('/user/recovery/');?>">Забыли пароль?</a>
			
			<div class="clearfix mb-25"></div>
			
			<button type="submit" class="cart-button clearfix max">Войти</button>
			
			<div class="center">
				<a href="<?php echo $this->createCPUUrl('/user/registration/');?>">Зарегестрироваться</a>
			</div>
		</form>		
	</div>
</div>
<?php else :?>

	<div class="lk-submenu-container">
		<div class="lk-submenu-container-bl">
			<a href="<?php echo $this->createCPUUrl('/user/offers/');?>">Мои заказы</a><br>
			<a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Мои данные</a><br>
			<a href="<?php echo $this->createCPUUrl('/user/addr/');?>">Адресная книга</a>
		</div>
	</div>

<?php endif;?>