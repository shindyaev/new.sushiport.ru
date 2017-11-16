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
			
			<?php $form=$this->beginWidget('CActiveForm', array(
			    'id'=>$model->formId,
			    'enableAjaxValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
					'validateOnChange'=>false,
					'errorCssClass'=>'error',
					'afterValidate'=>'js:afterRecoverySend',
				),
			)); ?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Email</label>
				<?php echo $form->textField($model,'email', array('placeholder'=>'example@gmail.com', 'class' => 'form-control')); ?>
				<p class="control-label"><?php echo $form->error($model,'email'); ?></p>
			</div>
			<?php echo CHtml::htmlButton('Выслать пароль', array('class' => 'btn btn-default', 'type' => 'submit')); ?>
			
			<?php $this->endWidget(); ?>
			
		</div>
		
	</div>
	
</div><!-- .content-->


<script type="text/javascript">
function afterRecoverySend (form, data, hasError) {
	$('#'+form.context.id).find('.control-group.error').removeClass('error');
	
	if (hasError) {
		return false;
	}

	Alert("На указанную почту было отправлено письмо с дальнейшими инструкциями.");
	
}
</script>