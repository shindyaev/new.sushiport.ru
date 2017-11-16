<?php 

$this->title_h3='Рассылки';

$this->breadcrumbs=array(
	'Рассылки'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('mailer/item').'"><i class="icon-plus"></i>Добавить</a>
							</li>';
$this->menuActiveItems[BController::MAILER_MENU_ITEM] = 1;
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
							'header'=>'Тип',
							'name'=>'type',
							'value'=>function($data) {
								if (empty($data['type']))
									return '';
								return $data->mailerTypes[$data['type']];
							}
					),
					array(
							'header'=>'Дата рассылки',
							'name'=>'date',
							'value'=>function($data) {
								if ($data['status'] == 0 )
									return '-';
								return Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm:ss', $data['date']);
							}
					),
					array(
							'header'=>'Статус',
							'name'=>'visible',
							'type'=>'html',
							'value'=>function($data) {
								if ($data['status'] == 0)
									return CHtml::openTag('span', array('class'=>'label label-important')).'не разослона'.CHtml::closeTag('span');
								else
									return CHtml::openTag('span', array('class'=>'label label-success')).'разослана'.CHtml::closeTag('span');
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
									return '/mailer/item/'.$data['id'].'/';
								},
							),
							'preview'=>array(
									'label'=>'Предпросмотр',
									'imageUrl'=>false,
									'options'=>array('class'=>'btn mini black-stripe'),
									'url'=>function($data) {
										return '/mailer/preview/'.$data['id'].'/';
									},
							),
						),
						'template'=>'{view} {preview}',
					),
				),
			)); ?>
</div>
