<?php 

$this->menuActiveItems[BController::OFFERS_MENU_ITEM] = 1;
?>
<div>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'client-grid',
				'dataProvider'=>$model->search($status),
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
						'header'=>'Имя',
						'name'=>'name',
					),
					array(
						'header'=>'Телефон',
						'name'=>'phone',
					),
					array(
						'header'=>'Дата',
						'name'=>'date',
						'type'=>'html',
						'value'=>function($data) {
							return Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', $data['date']);
						}
					),
					
					array(
						'header'=>'Ресторан',
						'name'=>'rest',
						'value'=>function($data) use ($restorans) {
							return $restorans[$data['rest']]->name;
						}
					),
						
					array(
						'header'=>'Статус',
						'name'=>'status',
						'value'=>function($data) {
							return $data->statusTypes[$data['status']];
						}
					),
					array(
						'header'=>Yii::t('main','Actions'),
						'class'=>'CButtonColumn',
						'buttons'=>array(
							'view'=>array(
								'label'=>'Посмотреть',
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/offers/item/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view}',
					),
				),
				'pager'=>array('cssFile'=>false),
			)); ?>
</div>
