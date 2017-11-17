<?php
$this->menuActiveItems[BController::CITY_MENU_ITEM] = 1;

$this->title_h3='Города';

$this->breadcrumbs=array(
	'Города'
);

$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
			<a class="btn blue dash-btn" href="'.$this->createUrl('city/item').'"><i class="icon-plus"></i>Добавить</a>
		</li>';
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
				'htmlOptions'=>array('class'=>'id-row'),
			),
			array(
				'header'=>'Название',
				'name'=>'name',
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
							return '/city/item/'.$data['id'].'/';
						},
					),
					'add'=>array(
						'label'=>Yii::t('main','Delete'),
						'imageUrl'=>false,
						'options'=>array('class'=>'btn mini red-stripe'),
						'click'=>'confirmDelete',
						'url'=>function($data) {
							return '/city/delete/'.$data['id'].'/';
						},
					),
				),
				'template'=>'{view} {add}',
			),
			array(
				'name'=>'alias',
			),
			array(
				'name'=>'nameR',
			),
			array(
				'name'=>'nameD',
			),
			array(
				'name'=>'phone',
			),
			array(
				'name'=>'email',
			),
		),
		'pager'=>array('cssFile'=>false),
	)); ?>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$("#client-grid .table tbody").sortable({
			update: function( event, ui ) {
				var rows = $("#client-grid tbody tr");
				var data = new Array();
				for (var i = 0; i < rows.length; i++) {
					data[i] = rows.eq(i).find(".id-row").html();
				}

				$.ajax({
					cache 		: false,
					type 		: 	'POST',
					url			:	'/city/saveSortRest/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});
	})
</script>
