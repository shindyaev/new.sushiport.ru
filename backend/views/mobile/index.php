<?php
$this->title_h3='Мобильные приложения';

$this->breadcrumbs=array(
		'Мобильные приложения'
);

$this->menuActiveItems[BController::MOBILE_MENU_ITEM] = 1;

?>

<div>
	
	<div class="form-horizontal">
	
		<div class="control-group">
			<label for="Offer_name" class="control-label">Дата последнего обновления</label>			
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $last_update_time);?></label>
			</div>
		</div>
		
		<div class="control-group">
			<label for="Offer_name" class="control-label">Версия меню</label>			
			<div class="controls">
				<label class="control-label text-left max-width"><?php echo $data_version?></label>
			</div>
		</div>
		
		<div class="form-actions large">
			<a href="/mobile/update/"><button type="button" class="btn blue"><i class="icon-ok"></i> Обновить</button></a>
		</div>
	
	</div>
	
</div>