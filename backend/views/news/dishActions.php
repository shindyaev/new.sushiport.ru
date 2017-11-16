<?php 

$this->title_h3='Акции на блюда';

$this->breadcrumbs=array(
	'Акции на блюда'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('news/dishAction').'"><i class="icon-plus"></i>Добавить</a>
							</li>';
$this->menuActiveItems[BController::ACTION_DISH_MENU_ITEM] = 1;
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
						'header'=>'Блюдо',
						'name'=>'dish.name',
					),
					array(
						'header'=>'Цена(руб)',
						'name'=>'price',
					),
					array(
						'header'=>'Кол-во',
						'name'=>'count',
					),
						
					array(
							'header'=>'Дата окончания',
							'name'=>'dateEnd',
							'value'=>function($data) {
								return Yii::app()->dateFormatter->format('dd.MM.yyyy', $data['dateEnd']);
							}
					),
					array(
							'header'=>Yii::t('main','Visible'),
							'name'=>'visible',
							'type'=>'html',
							'value'=>function($data) {
								if ($data['visible'] == 0)
									return CHtml::openTag('span', array('class'=>'label label-important')).'скрытый'.CHtml::closeTag('span');
								else
									return CHtml::openTag('span', array('class'=>'label label-success')).'видимый'.CHtml::closeTag('span');
							}
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
									return '/news/dishAction/'.$data['id'].'/';
								},
							),
							'add'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/news/deleteDishAction/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {add}',
					),
				),
				'pager'=>array('cssFile'=>false),
			)); ?>
</div>
