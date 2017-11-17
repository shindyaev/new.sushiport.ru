<?php
/* @var $this AccessController */
/* @var $model Admins */

$this->title_h3=$header;

$this->menuActiveItems[BController::CITY_MENU_ITEM] = 1;

$this->breadcrumbs=array(
		'Города' => $this->createUrl('city/index'),
		$header
);


Yii::app()->clientScript->registerScriptFile(
	'/plugins/fancybox/source/jquery.fancybox.pack.js',
	CClientScript::POS_END
);
Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	CClientScript::POS_END
);
Yii::app()->clientScript->registerScriptFile(
	'/scripts/gallery.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/fancybox/source/jquery.fancybox.css',
	'',
	CClientScript::POS_END
);
Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.css',
	'',
	CClientScript::POS_END
);

$imageUrl = '/img/noimage.gif';

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
		'htmlOptions'=>array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'),

	)); ?>
	


		<div class="control-group">
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'alias',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'alias',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'alias'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'nameR',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'nameR',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'nameR'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'nameD',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'nameD',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'nameD'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'phone',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'phone',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'phone'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'email',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'email',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'email'); ?></span>
			</div>
		</div>
		

		

		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id)) : ?>
				<a href="/city/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>
	
	


</div>


