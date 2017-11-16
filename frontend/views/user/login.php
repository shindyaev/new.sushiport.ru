<div class="content">
	
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Вход</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>

	<div class="inner-page">

		<?php if (!empty($registration_done)): ?>
			<div class=" text-center mt-30">
				<div class="main-h2">Спасибо!</div>
				<!--Вы успешно прошли регистрацию на milimon.ru<br> -->
				На указанную вами почту было выслано письмо<br>с инструкцией по активации вашего аккаунта.<br>
				<!-- Пожалуйста укажите email и пароль, которые вы указали при регистрации <br>
				для начала работы с личным кабинетом -->
			</div>
		<?php else :?>

			<div class="main-h2">Вход</div>

		<?php endif;?>

		<div class="reg-form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
			    'id'=>'login-form',
				'action' => array('/user/login/'),
			    'enableClientValidation'=>true,
			    'clientOptions'=>array(
			        'validateOnSubmit'=>true,
			    ),
			)); ?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<?php echo $form->textField($model,'email', array('class' => 'form-control')); ?>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">Пароль</label>
				<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'password'); ?></p>
			</div>
			
			<?php echo CHtml::htmlButton('Войти', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			<a href="<?php echo $this->createCPUUrl('/user/recovery/');?>" class="pull-right mt-5">Забыли пароль?</a>
			
			<?php $this->endWidget(); ?>
			
		</div>
		
	</div>
	
</div><!-- .content-->