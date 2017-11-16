<?php 

$this->title_h3='Сотрудники';

$this->breadcrumbs=array(
	'Сотрудники'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('team/worker').'"><i class="icon-plus"></i>Добавить</a>
							</li>';
$this->menuActiveItems[BController::TEAM_MENU_ITEM] = 1;
?>
<div>
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'workers-grid',
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
						'htmlOptions'=>array('class'=>'id-row'),
					),
						
					array(
						'header'=>Yii::t('main','Name'),
						'name'=>'name',
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
									return '/team/worker/'.$data['id'].'/';
								},
							),
							'add'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/team/deleteWorker/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {add}',
					),
				),
			)); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#workers-grid .table tbody").sortable({
			update: function( event, ui ) {
				var rows = $("#workers-grid tbody tr");
				var data = new Array();
				for (var i = 0; i < rows.length; i++) {
					data[i] = rows.eq(i).find(".id-row").html();
				}

				$.ajax({
					cache 		: false,
					type 		: 	'POST',
					url			:	'/team/saveSortWorkers/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});
	})
</script>
