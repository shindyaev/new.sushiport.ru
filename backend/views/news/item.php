<?php 

Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');

$this->title_h3=$header;

$this->breadcrumbs=array(
	'Акции' => '/news/'.$model->pid.'/',
	$header
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-fileupload/bootstrap-fileupload.css',
	'',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-datepicker/css/datepicker.css',
	'',
	CClientScript::POS_END
);

$imageUrl = '/img/noimage.gif';

if (!empty($model->id) && file_exists($model->imagesPath.'admin_preview/'.$model->id.".png"))
	$imageUrl = $model->imagesUrl.'admin_preview/'.$model->id.".png";

if ($model->pid == 1)
	$this->menuActiveItems[BController::NEWS1_MENU_ITEM] = 1;
else 
	$this->menuActiveItems[BController::NEWS2_MENU_ITEM] = 1;

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
			<?php echo $form->label($model,'image',array('class'=>'control-label')); ?>
			<div class="controls">
				<div data-provides="fileupload" class="fileupload fileupload-new">
					<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
						<img alt="" src="<?php echo $imageUrl;?>">
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
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'dateStart',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'dateStart',array('class'=>'m-wrap small date-picker', 'readonly'=>true)); ?>
				<span class="help-inline"><?php echo $form->error($model,'dateStart'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'dateEnd',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'dateEnd',array('class'=>'m-wrap small date-picker', 'readonly'=>true)); ?>
				<span class="help-inline"><?php echo $form->error($model,'dateEnd'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'shortText',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'shortText',array('class'=>'m-wrap max-width')); ?>
				<span class="help-inline"><?php echo $form->error($model,'shortText'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'text',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap redactor max-width')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
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
				<a href="/news/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				
				rtl : App.isRTL(),
				format: "dd.mm.yyyy"
			});
		}
	})
</script>

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
