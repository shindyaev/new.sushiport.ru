<?php 
/* @var $this SettingsController */

$this->title_h3='Настройки';

$this->breadcrumbs=array(
);

$this->menuActiveItems[BController::SETTINGS_MENU_ITEM] = 1;

$this->breadcrumbs=array(
	'Настройки'
);

?>

<div>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$settings->formId,
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>false,
			'errorCssClass'=>'error',
			'afterValidate'=>'js:contentAfterAjaxValidateNoReload',
		),
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('/')),

	)); ?>

		<div class="control-group">
			<?php echo $form->label($settings,'emailAdmin',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'emailAdmin',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'emailAdmin'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($settings,'phoneSmr',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'phoneSmr',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'phoneSmr'); ?></span>
			</div>
		</div>
<!--		
		<div class="control-group">
			<?php echo $form->label($settings,'phoneUfa',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'phoneUfa',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'phoneUfa'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($settings,'androidLink',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'androidLink',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'androidLink'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($settings,'iphoneLink',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'iphoneLink',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'iphoneLink'); ?></span>
			</div>
		</div>
-->		
		<div class="control-group">
			<?php echo $form->label($settings,'orderEmailSmr',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'orderEmailSmr',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'orderEmailSmr'); ?></span>
			</div>
		</div>
<!--		
		<div class="control-group">
			<?php echo $form->label($settings,'orderEmailUfa',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'orderEmailUfa',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'orderEmailUfa'); ?></span>
			</div>
		</div>
-->
		
		<div class="control-group">
			<?php echo $form->label($settings,'menuLink',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'menuLink',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'menuLink'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($settings,'emailBookTable',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($settings,'emailBookTable',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'emailBookTable'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($settings,'restoransText',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($settings,'restoransText',array('class'=>'m-wrap max-width')); ?>
				<span class="help-inline"><?php echo $form->error($settings,'restoransText'); ?></span>
			</div>
		</div>
		
		
		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>
