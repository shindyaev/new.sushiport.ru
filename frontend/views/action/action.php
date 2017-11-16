<div class="content">
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Акции</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>
	
	<div class="main-h2 mt-30">
		<h1>Акции сегодня</h1>
	</div>

	<div class="text-center fs-16  mt-20 lh-20 ">
	Каждый день рестораны «CъелБыСам», «Бенджамин кафе», «Кембридж кафе» и «OMNI Чайхана»<br>готовят для вас новые акции и специальные<br>
	предложения. Не пропустите все самое интересное.
	</div>
	
	<div class="row mt-40">
		<div class="col-xs-6">

			<?php
				$criteria = new CDbCriteria();
				$criteria->condition = 'visible = 1 AND dateStart <= NOW() AND cityId = :cityId';
				$criteria->order = "dateStart DESC";
				$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
				$criteria->limit = 3;

				$actions = News::model()->findAll($criteria);
			?>

			<?php
			/*echo '<pre>';
			print_r($actions);
			echo '</pre>';die;*/
			?>
			<?php foreach ($actions AS $key => $val):?>
			<div class="milimon-action-list-item <?php if ($key == 0):?>active<?php endif;?>" rel="<?php echo $val->id?>">
				<div class="pull-left">
					<img src="<?php echo $val->imagesUrl."100x100/".$val->id.".jpg"?>">
				</div>
				<div class="pull-right w-260 mr-45">
					<div class="milimon-action-list-item-name">
						<?php echo $val->name?>
					</div>
					<div class="milimon-action-list-item-text">
						<?php echo $val->shortText?>
					</div>
				</div>
				<div class="milimon-action-right-arrow"></div>
			</div>
			<?php endforeach;?>
			
		</div>
		
		<div class="col-xs-6">
			
			<?php foreach ($actions AS $key => $val):?>
			<div class="milimon-action-content-item milimon-action-content-item-<?php echo $val->id?> <?php if ($key == 0):?>active<?php endif;?>">
				<img src="<?php echo $val->imagesUrl."491x/".$val->id.".jpg"?>">
				<div class="milimon-action-content-item-header"><?php echo $val->name?></div>
				
				<div class="milimon-action-content-item-date">Действует до: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $val->dateEnd)?></div>
				<div class="clearfix"></div>
				<div class="milimon-action-content-item-text"><?php echo $val->text?></div>
			</div>
			<?php endforeach;?>
			
		</div>
	
	</div>
	
	
	
	
	
</div>