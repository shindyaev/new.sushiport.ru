<?php 
/* @var $this MenuController */
/* @var $model Menu */

$this->title_h3=$header;

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
$imgSizeText = "500x500";

if (!empty($model->id) && file_exists($model->imagesPath.'admin_preview/'.$model->id.".png")) {
	$imageUrl = $model->imagesUrl.'admin_preview/'.$model->id.".png";
	$imgSizeText = "";
}

?>
<div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
		'enableAjaxValidation'=>false,
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>false,
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
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'price',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'price',array('class'=>'m-wrap small')); ?>
				<span class="help-inline"><?php echo $form->error($model,'price'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'weight',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'weight',array('class'=>'m-wrap small')); ?>
				<?php echo $form->dropDownList($model,'weightType', $model->units, array('class'=>'m-wrap small')); ?>
				<span class="help-inline"><?php echo $form->error($model,'weight'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'ccal',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'ccal',array('class'=>'m-wrap small')); ?>
				<span class="help-inline"><?php echo $form->error($model,'ccal'); ?></span>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->label($model,'hit',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'hit'); ?>
				<span class="help-inline"><?php echo $form->error($model,'hit'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'hot',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'hot'); ?>
				<span class="help-inline"><?php echo $form->error($model,'hot'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'vegan',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'vegan'); ?>
				<span class="help-inline"><?php echo $form->error($model,'vegan'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'new',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'new'); ?>
				<span class="help-inline"><?php echo $form->error($model,'new'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'recommended',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'recommended'); ?>
				<span class="help-inline"><?php echo $form->error($model,'recommended'); ?></span>
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
				<a href="/menu/deleteDish/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>
