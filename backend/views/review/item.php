<?php 
$this->title_h3=$header;

$this->breadcrumbs=array(
	'Книга предложений' => $this->createUrl('review/index'),
	$header
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/jquery-inputmask/jquery.inputmask.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/jquery-inputmask/jquery.inputmask.date.extensions.js',
	CClientScript::POS_END
);

$this->menuActiveItems[BController::REVIEW_MENU_ITEM] = 1;



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
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('review/index')),

	)); ?>
	
		<div class="control-group">
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'email',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'email'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'phone',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'phone',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'phone'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'sex',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'sex',$model->sexTypes,array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'sex'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap span6')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'answer',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'answer',array('class'=>'m-wrap span6')); ?>
				<span class="help-inline"><?php echo $form->error($model,'answer'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'date',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'date',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'date'); ?></span>
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
				<a href="/review/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#Review_date").inputmask("datetime", {"placeholder": "__/__/____ __:__"});
	})
</script>