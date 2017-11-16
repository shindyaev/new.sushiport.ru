<?php 
$this->title_h3=$header;

$this->breadcrumbs=array(
	'Промо-коды' => $this->createUrl('promo/index'),
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

$this->menuActiveItems[BController::PROMO_MENU_ITEM] = 1;



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
			<?php echo $form->label($model,'code',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'code',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'code'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'rub',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'rub',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'rub'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'proc',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'proc',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'proc'); ?></span>
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