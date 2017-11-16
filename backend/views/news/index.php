<?php 

$this->title_h3='Акции';

$this->breadcrumbs=array(
	'Акции'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('news/item', array('pid' => $model->pid)).'"><i class="icon-plus"></i>Добавить запись</a>
							</li>';
if ($model->pid == 1)
	$this->menuActiveItems[BController::NEWS1_MENU_ITEM] = 1;
else 
	$this->menuActiveItems[BController::NEWS2_MENU_ITEM] = 1;
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
							'header'=>Yii::t('main','Name'),
							'name'=>'name',
					),
					array(
							'header'=>'Дата начала',
							'name'=>'dateStart',
							'value'=>function($data) {
								return Yii::app()->dateFormatter->format('dd.MM.yyyy', $data['dateStart']);
							}
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
									return '/news/item/'.$data['pid'].'/'.$data['id'].'/';
								},
							),
							'add'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/news/delete/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {add}',
					),
				),
				'pager'=>array('cssFile'=>false),
			)); ?>
</div>
