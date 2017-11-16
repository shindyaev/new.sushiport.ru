<?php
/* @var $this MenuController */
/* @var $modelMenu Menu*/
/* @var $currentSection Menu*/

$this->title_h3='Меню';

if (!$currentSection || $currentSection->level < $modelMenu->depth) {
	$this->breadcrumbs_button .= '<li class="pull-right no-text-shadow">
									<a class="btn blue dash-btn" href="'.$this->createUrl('site/mainMenuItem', array('pid'=>$modelMenu->id)).'"><i class="icon-plus"></i>Добавить раздел</a>
								</li>';
}

$this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM] = 1;

?>
<div>
	
	<?php 
	
	$showNext = true;
	if ($currentSection && $currentSection->level < $modelMenu->depth)
		$showNext = false;
		
	$buttons = '{view} {edit} {delete}';
	
	if(!$showNext)
		$buttons = '{edit} {delete}';
	
	if (!$currentSection || $currentSection->level < $modelMenu->depth) {
		?>
		<h4>Разделы</h4>
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'section-grid',
				'dataProvider'=>$modelMenu->search(),
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
						'type'=>'html',
						'value'=>function($data) use ($showNext) {
							if (!$showNext)
								return $data['name'];
							
							return CHtml::link($data['name'], '/site/mainMenu/'.$data['id'].'/');
						}
					),
					array(
							'header'=>'Ссылка',
							'name'=>'link',
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
								'label'=>Yii::t('main','View'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini green-stripe'),
								'url'=>function($data) {
									return '/site/mainMenu/'.$data['id'].'/';
								},
							),
							'edit'=>array(
								'label'=>Yii::t('main','Edit'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/site/mainMenuItem/'.$data['pid'].'/'.$data['id'].'/';
								},
							),
							'delete'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/site/deleteMainMenuItem/'.$data['id'].'/';
								},
							),
						),
						'template'=>$buttons,
						
					),
				),
				'pager'=>array('cssFile'=>false),
			)); 
		}
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
					url			:	'/site/saveSortSection/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});
	})
</script>
