<?php
/* @var $this AccessController */
/* @var $model Admins */

$this->title_h3=$header;

$this->menuActiveItems[BController::RESTORANS_MENU_ITEM] = 1;

$this->breadcrumbs=array(
		'Рестораны' => $this->createUrl('restorans/index'),
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

if (!empty($model->id) && file_exists($model->imagesPath.'admin_preview/'.$model->id.".png"))
	$imageUrl = $model->imagesUrl.'admin_preview/'.$model->id.".png";

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
				<?php echo $form->textField($model,'name',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'name'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'kittchen',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'kittchen',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'kittchen'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'menu',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropDownList($model,'menu',$menus, array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'menu'); ?></span>
			</div>
		</div>
	
		<div class="control-group">
			<?php echo $form->label($model,'addr',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'addr',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'addr'); ?></span>
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
			<?php echo $form->label($model,'map',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'map',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'map'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'addr2',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'addr2',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'addr2'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'phone2',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'phone2',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'phone2'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'map2',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textArea($model,'map2',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'map2'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'service',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'service',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'service'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'workTime',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'workTime',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'workTime'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'site',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'site',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'site'); ?></span>
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
				<?php echo $form->textArea($model,'text',array('class'=>'m-wrap max-width')); ?>
				<span class="help-inline"><?php echo $form->error($model,'text'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'delivery',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'delivery',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'delivery'); ?></span>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->label($model,'minCheck',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'minCheck',array('class'=>'m-wrap large')); ?>
				<span class="help-inline"><?php echo $form->error($model,'minCheck'); ?></span>
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
				<a href="/restorans/delete/<?php echo $model->id?>/" onclick="return confirmDelete()"><?php echo CHtml::htmlButton('<i class="icon-remove"></i> Удалить', array('class' => 'btn red', 'type' => 'button')); ?></a>
			<?php endif;?>
			<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'id'); ?>

	<?php $this->endWidget(); ?>
	
	
	<?php if (!empty($model->id)):?>	
	
	<div class="portlet box blue" id="bannerPortlet">
		<div class="portlet-title">
			<div class="caption"><i class="icon-reorder"></i>Изображения</div>
		</div>
		<div class="portlet-body">
			<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
		
		
				<div data-provides="fileupload" class="fileupload fileupload-new pull-left">
					<span class="btn btn-file">
					<span class="fileupload-new">Выберите изображение</span>
					<span class="fileupload-exists">Изменить изображение</span>
					<?php echo CHtml::activeFileField($modelImage, 'image'); ?>
					</span>
					<span class="fileupload-preview"></span>
					<a style="float: none" data-dismiss="7fileupload" class="close fileupload-exists" href="#"></a>
				</div>
				
				<?php echo CHtml::htmlButton('<i class="icon-plus"></i> Добавить', array('class' => 'btn blue', 'type' => 'submit', 'style' => 'margin-left: 20px')); ?>
			<?php echo CHtml::endForm(); ?>
		
			<div class="row-fluid">
				<?php  foreach ($modelImage->search()->getData() AS $image) { ?>
				<div class="span3">
					<div class="item">
						<a href="<?php echo $modelImage->ImagesUrl."original/".$image->id.".png";?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
							<div class="zoom">
								<?php echo CHtml::image($modelImage->ImagesUrl."original/".$image->id.".png");?>
								<div class="zoom-icon"></div>
							</div>
						</a>
						<div class="details">
							<a class="icon remove" href="#" rel="<?php echo $image->id;?>"><i class="icon-remove"></i></a>    
						</div>
					</div>
				</div>
				<?php  }?>
			</div>
		
		</div>
	</div>
	
	<?php endif;?>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		Gallery.init();

		$("#bannerPortlet .details .remove").on("click", function() {
			if (confirm("Вы действительно хотите удалить это изображение?")) {
				var id = $(this).attr("rel");
				
				$.ajax({
					type: "POST",
					url : '/restorans/deleteRestoranImage/',
					data : {'id' : id},
					success : function(response) {
  						window.location.reload();
					}
				});
			}
		});
		
	})
</script>
