<?php
/* @var $this AccessController */
/* @var $model Admins */

$this->title_h3=$header;

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->menuActiveItems[BController::PAGES_MENU_ITEM] = 1;
$this->breadcrumbs=array(
		'Текстовые страницы' => $this->createUrl('pages/index'),
		$header
);

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
			<?php echo $form->label($model,'title',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'title',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'title'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap redactor')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'pagetitle',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'pagetitle',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'pagetitle'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'description',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'description',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'description'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'keywords',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'keywords',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'keywords'); ?></span>
			</div>
		</div>

		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id)) : ?>
				<a href="/pages/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

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