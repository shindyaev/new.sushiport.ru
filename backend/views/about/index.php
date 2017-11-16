<?php

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->title_h3='О компании';

$this->menuActiveItems[BController::ABOUT_MENU_ITEM] = 1;

$this->breadcrumbs=array(
	'О компании'
);



?>

<div>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
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
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap medium redactor')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
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