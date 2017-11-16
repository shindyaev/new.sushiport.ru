<?php 
/* @var $this MenuController */
/* @var $model Menu */

$this->title_h3=$header;

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->menuActiveItems[BController::MENU_MENU_ITEM] = 1;

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.css',
	'',
	CClientScript::POS_END
);

$imageUrl = '/img/noimage.gif';
$imgSizeText = "186x160";

if (!empty($model->id) && file_exists($model->imagesPath.'admin_preview/'.$model->id.".png")) {
	$imageUrl = $model->imagesUrl.'admin_preview/'.$model->id.".png";
	$imgSizeText = "";
}

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
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('menu/index', array('id'=>$model->pid)), 'enctype'=>'multipart/form-data'),

	)); ?>
	
		<div class="control-group">
			<?php echo $form->label($model,'image',array('class'=>'control-label')); ?>
			<div class="controls">
				<div data-provides="fileupload" class="fileupload fileupload-new">
					<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
						<img alt="" src="<?php echo $imageUrl;?>">
						<div class="img-size"><?php echo $imgSizeText;?></div>
					</div>
					<div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
					<div>
						<span class="btn btn-file"><span class="fileupload-new">Выберите изображение</span>
						<span class="fileupload-exists">Изменить</span>
						<?php echo $form->fileField($model,'image',array('class'=>'default')); ?>
						</span>
						<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Удалить</a>
					</div>
				</div>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'name',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'note',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'note',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'note'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'commentHeader',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'commentHeader',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'commentHeader'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'comment',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'comment',array('class'=>'m-wrap medium')); ?>
				<span class="help-inline"><?php echo $form->error($model,'comment'); ?></span>
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
			<?php echo $form->label($model,'seotext',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'seotext',array('class'=>'m-wrap redactor')); ?>
				<span class="help-inline"><?php echo $form->error($model,'seotext'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'popular',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'popular'); ?>
				<span class="help-inline"><?php echo $form->error($model,'popular'); ?></span>
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
				<a href="/menu/deleteSection/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
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
