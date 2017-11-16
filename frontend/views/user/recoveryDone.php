<div class="content">

	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Восстановление пароля</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>

	<div class="inner-page">
		<div class="main-h2">Восстановление пароля</div>
		
		<div class="reg-form">

			<?php if (empty($model)) : ?>
				<div class="form-group">
					<label for="exampleInputEmail1">Ссылка для восстановления пароля устарела.</label>
				</div>
			<?php else :?>
			
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>$model->formId,
					'enableAjaxValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
						'validateOnChange'=>false,
						'errorCssClass'=>'error',
						'afterValidate'=>'js:contentAfterAjaxValidate',
					),
					'htmlOptions'=>array('rel' => $this->createUrl('/user/login/', array('id' => $model->id))),
				
				)); ?>


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

				<?php echo CHtml::htmlButton('Изменить пароль', array('class' => 'btn btn-default', 'type' => 'submit')); ?>

				
				<?php $this->endWidget(); ?>
						
				<?php endif;?>

		</div>
	</div>
</div>



