<?php 
/* @var $this SiteController */

$this->title_h3='Статистика продаж';

$this->breadcrumbs=array(
	'Статистика продаж',
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
	'/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.ru.js',
	CClientScript::POS_END
);

Yii::app()->clientScript->registerCssFile(
	'/plugins/bootstrap-datepicker/css/datepicker.css',
	'',
	CClientScript::POS_END
);

$this->menuActiveItems[BController::STATISTIC_MARKET_MENU_ITEM] = 1;

?>


<div>
	
	<form id="statisticMarket-form" class="form-horizontal" method="post">
	
		<div class="control-group">
			<label class="control-label">Период</label>
			<div class="controls">
				<span class="lh-34 ml-20">С</span> <?php echo CHtml::telField('periodStart','', array('class'=>'m-wrap small date-picker', 'readonly'=>'readonly')); ?>
				<span class="lh-34 ml-20">По</span> <?php echo CHtml::telField('periodEnd','', array('class'=>'m-wrap small date-picker', 'readonly'=>'readonly')); ?>
				<?php echo CHtml::htmlButton('Показать', array('class' => 'btn blue', 'type' => 'submit')); ?>
			</div>
		</div>

	</form>
	
	<?php if (!empty($dishes)):?>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th id="client-grid_c0">#</th>
				<th id="client-grid_c1">Название</th>
				<th id="client-grid_c2">Количество продано</th>
				<th id="client-grid_c3">Цена за еденицу</th>
				<th id="client-grid_c4">Цена общая</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dishes AS $key => $val):?>
			<tr>
				<td><?php echo $key+1?></td>
				<td><?php echo $val['name']?></td>
				<td><?php echo $val['cn']?></td>
				<td><?php echo $val['price']?> руб.</td>
				<td><?php echo $val['price']*$val['cn']?> руб.</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php else:?>
		<h4 class="text-center">Нет данных за выбранный период.</h4>
	<?php endif;?>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		if ($.datepicker) {
			$('.date-picker').datepicker({
				rtl : App.isRTL(),
				format: "dd.mm.yyyy"
			});
		}
	})
</script>
