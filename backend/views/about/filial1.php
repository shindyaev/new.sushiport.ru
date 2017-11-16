<?php
/* @var $this SiteController */

$this->title_h3='О ресторане';

$this->breadcrumbs=array(
	'О ресторане',
	'Ресторан в молле «Парк Хаус»'
);

$this->menuActiveItems[BController::ABOUT_FILIAL1_MENU_ITEM] = 1;


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

?>


		<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
	
	
			<div data-provides="fileupload" class="fileupload fileupload-new pull-left">
				<span class="btn btn-file">
				<span class="fileupload-new">Выберите изображение</span>
				<span class="fileupload-exists">Изменить</span>
				<?php echo CHtml::activeFileField($model, 'image'); ?>
				</span>
				<span class="fileupload-preview"></span>
				<a style="float: none" data-dismiss="fileupload" class="close fileupload-exists" href="#"></a>
			</div>
			
		<?php echo CHtml::htmlButton('<i class="icon-plus"></i> Добавить', array('class' => 'btn blue', 'type' => 'submit', 'style' => 'margin-left: 20px')); ?>
		<?php echo CHtml::endForm(); ?>
	
		<div class="row-fluid">
			<?php foreach ($model->images AS $image) { ?>
			<div class="span3">
				<div class="item">
					<a href="<?php echo $model->ImagesUrl."715x477/".$image;?>" title="Photo" data-rel="fancybox-button" class="fancybox-button">
						<div class="zoom">
							<?php echo CHtml::image($model->ImagesUrl."715x477/".$image);?>
							<div class="zoom-icon"></div>
						</div>
					</a>
					<div class="details">
						<a class="icon remove" href="#" rel="<?php echo $image;?>"><i class="icon-remove"></i></a>    
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	

<script type="text/javascript">
	$(document).ready(function() {
		Gallery.init();

		$(".details .remove").on("click", function() {
			if (confirm("Вы действительно хотите удалить это изображение?")) {
				var path = $(this).attr("rel").split("/");
				var name = path[path.length - 1];
				
				$.ajax({
					type: "POST",
					url : '/about/DeleteFilial1Img/',
					data : {'name' : name},
					success : function(response) {
 						window.location.reload();
					}
				});
			}
		});

	})
</script>
