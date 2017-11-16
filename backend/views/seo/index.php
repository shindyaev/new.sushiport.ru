<?php 
/* @var $this SeoController */
/* @var $model Seo*/

$this->title_h3='SEO';

$this->breadcrumbs=array(
	'SEO'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('seo/item').'"><i class="icon-plus"></i>Добавить запись</a>
							</li>';

$this->menuActiveItems[BController::SEO_MENU_ITEM] = 1;
?>
<div>

	<div class="portlet box blue main-gallery">
		<div class="portlet-title">
			<div class="caption">Добавляеться ко всем title-ам и description-ам</div>
			<div class="tools">
				<a href="javascript:;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
				<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>$mainSeo->formId,
						'enableAjaxValidation'=>false,
						'enableClientValidation'=>true,
						'clientOptions'=>array(
							'validateOnSubmit'=>true,
							'validateOnChange'=>false,
							'errorCssClass'=>'error',
							'afterValidate'=>'js:contentAfterClientValidate',
						),
						'htmlOptions'=>array('class'=>'form-horizontal', 'rel' => $this->createUrl('/seo/')),
				
					)); ?>
				
						<div class="control-group">
							<?php echo $form->label($mainSeo,'text',array('class'=>'control-label')); ?>
							<div class="controls">
								<?php echo $form->textField($mainSeo,'text',array('class'=>'m-wrap large')); ?>
								<span class="help-inline"><?php echo $form->error($mainSeo,'text'); ?></span>
							</div>
						</div>
						<div class="form-actions large">
							<?php echo CHtml::htmlButton('<i class="icon-ok"></i> Сохранить', array('class' => 'btn blue', 'type' => 'submit')); ?>
							<?php echo CHtml::htmlButton('Отменить', array('class' => 'btn', 'type' => 'reset')); ?>
						</div>
				<?php $this->endWidget(); ?>
		
		</div>
	</div>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'client-grid',
				'dataProvider'=>$model->search(),
				'filter'=>null,
				'enableSorting'=>false,
				'htmlOptions'=>array('class'=>'portlet-body'),
				'itemsCssClass'=>'table table-striped table-hover',
				'summaryText'=>'',
				'loadingCssClass'=>'',
				'columns'=>array(
					array(
						'header'=>Yii::t('main','ID'),
						'name'=>'id',
					),
					array(
							'header'=>'Url страницы',
							'name'=>'urlOld',
					),
					array(
							'header'=>'Новый Url страницы',
							'name'=>'urlNew',
					),
					array(
						'header'=>Yii::t('main','Title'),
						'name'=>'title',
					),
// 					array(
// 						'header'=>'Заголовок',
// 						'name'=>'headline',
// 					),
					array(
						'header'=>Yii::t('main','Actions'),
						'class'=>'CButtonColumn',
						'buttons'=>array(
							'view'=>array(
								'label'=>Yii::t('main','Edit'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/seo/item/'.$data['id'].'/';
								},
							),
							'add'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/seo/delete/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {add}',
					),
				),
			)); ?>
</div>
