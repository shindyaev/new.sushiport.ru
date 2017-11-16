<?php
Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget'); 
$this->title_h3=$header;

$this->breadcrumbs=array(
	'Рассылки' => '/mailer/',
	$header
);

$this->menuActiveItems[BController::MAILER_MENU_ITEM] = 1;

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
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'type',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'type', $model->mailerTypes, array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'type'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'blank',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'blank',array('class'=>'m-wrap max redactor')); ?>
				<span class="help-inline"><?php echo $form->error($model,'blank'); ?></span>
			</div>
		</div>
		
		<div class="form-actions large">
		<?php if (empty($model->status)) : ?>
			<?php if (!empty($model->id) && empty($model->status)) : ?>
				<?php echo CHtml::htmlButton('Разослать', array('class' => 'btn green', 'type' => 'submit', 'onclick' => "return sendMailer()")); ?>
			<?php endif;?>
				<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id) && empty($model->status)) : ?>
				<a href="/mailer/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
		<?php endif;?>
			<?php if (!empty($model->id)) : ?>
				<a href="/mailer/preview/<?php echo $model->id?>/" target="_blank"><?php echo CHtml::htmlButton('<i class="icon-search"></i> Предпросмотр', array('class' => 'btn black', 'type' => 'button')); ?></a>
			<?php endif;?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php echo $form->hiddenField($model,'status'); ?>

	<?php $this->endWidget(); ?>

</div>

<?php 
$this->widget('ImperaviRedactorWidget', array(
    // The textarea selector
    'selector' => '.redactor',
    // Some options, see http://imperavi.com/redactor/docs/
    'options' => array(
		'imageUpload' => $this->createUrl('file/upload'),
		'minHeight' => 300,
		'lang' => 'ru',
	),
));

?>

<script type="text/javascript">
	var sendMailer = function() {
		$("#Mailer_status").val(1);
		return true;
	}

</script>
