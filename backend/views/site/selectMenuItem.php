<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->title_h3=$header;

$this->menuActiveItems[BController::CHANGE_MENU_TODAY] = 1;

?>
<div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>false,
			'errorCssClass'=>'error',
			'afterValidate'=>'js:contentAfterClientValidate',
		),
		'htmlOptions'=>array('class'=>'form-horizontal'),

	)); ?>

		<div class="control-group">
			<?php echo $form->label($model,'idCategory',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'idCategory', $categories, array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'idCategory'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'text',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id)) : ?>
				<a href="/site/deleteSelectMenuItem/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>