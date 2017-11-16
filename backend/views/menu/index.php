<?php 
/* @var $this MenuController */
/* @var $modelMenu Menu*/
/* @var $currentSection Menu*/

$this->title_h3='Меню';

if (!$currentSection || $currentSection->level < $modelMenu->depth) {
	$this->breadcrumbs_button .= '<li class="pull-right no-text-shadow">
									<a class="btn blue dash-btn" href="'.$this->createUrl('menu/section', array('pid'=>$modelMenu->pid)).'"><i class="icon-plus"></i>Добавить раздел</a>
								</li>';
}

if ($currentSection !== false && $currentSection->level == $modelMenu->depth) {
	$this->breadcrumbs_button .= '<li class="pull-right no-text-shadow">
								<a class="btn green dash-btn" href="'.$this->createUrl('menu/dish', array('pid'=>$modelMenu->pid)).'"><i class="icon-plus"></i>Добавить блюдо</a>
							</li>';
}

$this->menuActiveItems[BController::MENU_MENU_ITEM] = 1;

?>
<div>
	
	<?php 
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
						'value'=>function($data) {
							return CHtml::link($data['name'], '/menu/index/'.$data['id'].'/');
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
								'label'=>Yii::t('main','View'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini green-stripe'),
								'url'=>function($data) {
									return '/menu/index/'.$data['id'].'/';
								},
							),
							'edit'=>array(
								'label'=>Yii::t('main','Edit'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini blue-stripe'),
								'url'=>function($data) {
									return '/menu/section/'.$data['pid'].'/'.$data['id'].'/';
								},
							),
							'delete'=>array(
								'label'=>Yii::t('main','Delete'),
								'imageUrl'=>false,
								'options'=>array('class'=>'btn mini red-stripe'),
								'click'=>'confirmDelete',
								'url'=>function($data) {
									return '/menu/deleteSection/'.$data['id'].'/';
								},
							),
						),
						'template'=>'{view} {edit} {delete}',
						
					),
				),
				'pager'=>array('cssFile'=>false),
			)); 
		}
		
		
		
		if ($modelDish !== false) {
			?>
			<h4>Блюда</h4>
			<?php
			
// $i=0;
			
			$this->widget('zii.widgets.grid.CGridView', array(
					'id'=>'dish-grid',
					'dataProvider'=>$modelDish->search(),
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
							'value'=>function ($data) {
								return htmlspecialchars_decode($data['name']);
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
// array(
// 		'header'=>'№',
// 		'name'=>'visible',
// 		'type'=>'html',
// 		'value'=>function($data) use (&$i) {
// 			$i++;
// 			return $i;
// 		}
// ),						
						array(
							'header'=>Yii::t('main','Actions'),
							'class'=>'CButtonColumn',
							'buttons'=>array(
									'edit'=>array(
											'label'=>Yii::t('main','Edit'),
											'imageUrl'=>false,
											'options'=>array('class'=>'btn mini blue-stripe'),
											'url'=>function($data) {
												return '/menu/dish/'.$data['pid'].'/'.$data['id'].'/';
											},
									),
									'delete'=>array(
											'label'=>Yii::t('main','Delete'),
											'imageUrl'=>false,
											'options'=>array('class'=>'btn mini red-stripe'),
											'click'=>'confirmDelete',
											'url'=>function($data) {
												return '/menu/deleteDish/'.$data['id'].'/';
											},
									),
							),
							'template'=>'{edit} {delete}',
						),
					),
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
					url			:	'/menu/saveSortSection/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});

		$("#dish-grid .table tbody").sortable({
			update: function( event, ui ) {
				var rows = $("#dish-grid tbody tr");
				var data = new Array();
				for (var i = 0; i < rows.length; i++) {
					data[i] = rows.eq(i).find(".id-row").html();
				}

				$.ajax({
					cache 		: false,
					type 		: 	'POST',
					url			:	'/menu/saveSortDish/',
					data		:	{data : data},
					dataType	:	'json',
				})
			}
		});
	})
</script>
