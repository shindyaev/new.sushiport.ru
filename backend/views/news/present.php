<?php 

$this->title_h3=$header;

$this->breadcrumbs=array(
	'Подарки' => '/news/presents/',
	$header
);

$this->menuActiveItems[BController::PRESENT_MENU_ITEM] = 1;

?>
<div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$model->formId,
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'validateOnChange'=>false,
			'errorCssClass'=>'error',
			'afterValidate'=>'js:contentAfterAjaxValidate',
		),
		'htmlOptions'=>array('class'=>'form-horizontal', 'rel'=>'/news/presents/'),

	)); ?>
	
		<div class="control-group">
			<?php echo $form->label($model,'restoranId',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'restoranId', $restorans, array('class'=>'m-wrap large', 'ajax' => array(
                        'type' => 'POST',
                        'url' => '/news/getCategories/',
						'data'=>array(
							'restoranId'=>'js:this.value',
						),
						'success' => 'function(resp) {$("#Present_dishId").html(""); $("#Present_categoryId").html(resp);}',
                    ))); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'restoranId'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'categoryId',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'categoryId', $categorys, array('class'=>'m-wrap large', 'ajax' => array(
                        'type' => 'POST',
                        'url' => '/news/getDishes/',
                        'update'=>'#Present_dishId',
						'data'=>array(
							'categoryId'=>'js:this.value',
						),
                    ))); ?><br>
				<span class="help-inline"><?php echo $form->error($model,'categoryId'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'dishId',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'dishId', $dishs, array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'dishId'); ?></span>
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
			<?php echo $form->label($model,'visible',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'visible'); ?>
				<span class="help-inline"><?php echo $form->error($model,'visible'); ?></span>
			</div>
		</div>
		
		<div class="form-actions large">
			<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
			<?php if (!empty($model->id)) : ?>
				<a href="/news/deletePresent/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>

</div>
