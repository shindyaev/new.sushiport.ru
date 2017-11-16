<?php 
/* @var $this SeoController */
/* @var $model Seo*/

$this->title_h3='Зоны доставки';

$this->breadcrumbs=array(
	'Зоны доставки'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('zones/item').'"><i class="icon-plus"></i>Добавить запись</a>
							</li>';

$this->menuActiveItems[BController::SETTINGS_ZONE_MENU_ITEM] = 1;
?>
<div>


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
							'header'=>'Название',
							'name'=>'title',
					),
 					array(
 						'header'=>'Ресторан',
 						'name'=>'restoran.name',
 					),
					array(
						'header'=>Yii::t('main','Actions'),
						'class'=>'CButtonColumn',
						'buttons'=>array(
							'view'=>array(
								'label'=>Yii::t('main','Edit'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/zones/item/'.$data['id'].'/';
								},
							),
							'add'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/zones/delete/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {add}',
					),
				),
			)); ?>
</div>
