<?php
/* @var $this MenuController */
/* @var $modelMenu Menu*/
/* @var $currentSection Menu*/

$this->title_h3='Подберите меню на сегодня';


	$this->breadcrumbs_button .= '<li class="pull-right no-text-shadow">
									<a class="btn blue dash-btn" href="'.$this->createUrl('site/selectMenuItem').'"><i class="icon-plus"></i>Добавить</a>
								</li>';

$this->menuActiveItems[BController::CHANGE_MENU_TODAY] = 1;

?>
<div>
	
		<h4>Разделы</h4>
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'section-grid',
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
						'header'=>'Раздел',
						'name'=>'menu.name',
					),
					array(
						'header'=>'Текст',
						'name'=>'text',
					),
					array(
						'header'=>Yii::t('main','Actions'),
						'class'=>'CButtonColumn',
						'buttons'=>array(
							'edit'=>array(
								'label'=>Yii::t('main','Edit'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/site/selectMenuItem/'.$data['id'].'/';
								},
							),
							'delete'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/site/deleteSelectMenuItem/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{edit} {delete}',
					),
				),
				'pager'=>array('cssFile'=>false),
			)); 
	?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#section-grid .table tbody").sortable({
			update: function( event, ui ) {
				var rows = $("#section-grid tbody tr");
				var data = new Array();
				for (var i = 0; i < rows.length; i++) {
					data[i] = rows.eq(i).find(".id-row").html();
				}

				$.ajax({
					cache 		: false,
					type 		: 	'POST',
					url			:	'/site/saveSortSelectMenu/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});
	})
</script>
