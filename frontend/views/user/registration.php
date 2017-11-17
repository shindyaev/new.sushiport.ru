<div class="content">

	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Регистрация</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>

	<div class="inner-page">
		<div class="main-h2">Регистрация</div>
		
		<div class="reg-form">
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>$model->formId,
				'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:contentAfterAjaxValidate',
				),
				'htmlOptions'=>array('rel' => $this->createUrl('/user/registrationDone/')),
			
			)); ?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<?php echo $form->textField($model,'email', array('placeholder'=>'example@gmail.com', 'class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'email'); ?></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Имя и Фамилия</label>
				<?php echo $form->textField($model,'name', array('placeholder'=>'Иван Иванов', 'class' => 'form-control')); ?>
				<p class="control-label"></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Телефон</label>
				<?php echo $form->textField($model,'phone', array('placeholder'=>'+7 (846) 123-34-56', 'class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'phone'); ?></p>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Пароль</label>
				<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'password'); ?></p>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Повторите пароль</label>
				<?php echo $form->passwordField($model,'confirmPassword', array('class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'confirmPassword'); ?></p>
			</div>

			<div class="form-group hidden">
				<label for="CheckboxSailplay">
					<?php echo $form->checkBox($model,'allowSailPlay', array( 'checked'=>'checked', 'uncheckValue' => null)); ?>
					Регистрация в системе лояльности SailPlay <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Регистрация в системе лояльности SailPlay"></span>
				</label>
				<p class="control-label"><?php echo $form->error($model,'allowSailPlay'); ?></p>
			</div>

			<?php echo CHtml::htmlButton('Регистрация', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			<a href="<?php echo $this->createCPUUrl('/user/recovery/');?>" class="pull-right mt-5">Забыли пароль?</a>
			<div class="form-group hidden">
				<p style="padding-top: 10px;width: 315px;display: block;">
					 Нажимая «Регистрация», я подтверждаю предачу персональных данных и авторизацию на сайте <a href="https://sailplay.ru/">www.sailplay.ru</a>
				</p>
			</div>

			<div class="form-group hidden">
				<p style="line-height: 1.3;background-color: rgba(119, 119, 119, 0.14);border-radius: 5px;padding: 10px;color: #616161;">
					<a style="color: #616161;" href="https://sailplay.ru/">SailPlay</a> - это программа лояльности, которая позволяет пользователям копить баллы за покупки на сайте и получать подарки за баллы.

				</p>
			</div>
			<?php $this->endWidget(); ?>
			
		</div>
		
	</div>
	
</div><!-- .content-->
			
<script type="text/javascript">

	$(document).ready(function() {
	
		$("#User_phone").inputmask({"mask": "+7 (999) 999-99-99"});

	})
	
</script>
