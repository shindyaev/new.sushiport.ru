<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->title_h3=$header;

$this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM] = 1;

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
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('menu/index', array('id'=>$model->pid))),

	)); ?>

		<div class="control-group">
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'text',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'link',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'link',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'link'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'title',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'title',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'title'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'description',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'description',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'description'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'keywords',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'keywords',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'keywords'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'h1',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'h1',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'h1'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'selected',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'selected'); ?>
				<span class="help-inline"><?php echo $form->error($model,'selected'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'visible',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'visible'); ?>
				<span class="help-inline"><?php echo $form->error($model,'visible'); ?></span>
			</div>
		</div>
		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id)) : ?>
				<a href="/site/mainMenuItem/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>
