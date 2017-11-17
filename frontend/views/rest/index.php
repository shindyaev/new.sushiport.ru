<div class="content">
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter">&rarr;</li>
		<li>
			<a class="text-black">Доставка еды</a>
		</li>
	</ul>
	<div class="clearfix"></div>

	<?php
		$local_h1 = '';
		if (isset($this->variables['h1']) && trim($this->variables['h1']) != '') {
			$local_h1 = $this->variables['h1'];
			echo '<h1>'.$local_h1.'</h1>';
		}
		else {
			//echo '00';
		}
	?>
	<?php
	if (count($restorans) > 0) {
	foreach ($restorans AS $key => $val):?>
	<div class="rest-list-item">

			<a href="<?php echo $this->createCPUUrl("/menu/".$val->menu."/")?>">

		<div class="pull-left rest-list-item-img-block" style="background: url(<?php echo $val->imagesUrl."200x200/".$val->id.".png"?>) no-repeat center center">
		</div>
		</a>
		<div class="pull-right w-640">
			<div class="rest-list-item-name">
				<div class="rest-list-item-name-header"><?php echo $val->name?></div>
				<div class="rest-list-item-name-footer"><span class="gray-text">Кухня:</span> <?php echo $val->kittchen?></div>
			</div>
			<?php if ($val['work'] == 1):?>
				<a href="<?php echo $this->createCPUUrl("/menu/".$val->menu."/")?>" class="rest-list-item-menu-link">
			<?php else:?>
				<a  href="<?php echo $this->createCPUUrl("/menu/".$val->menu."/")?>" class="rest-list-item-menu-link rest-list-item-menu-link-disabled">
			<?php endif;?>
				Меню ресторана
			</a>
			<div class="rest-list-item-time">
				<?php echo $val['workTime']?>
			</div>
			
			<div class="clearfix"></div>

			<?php if (!empty($dishes[$val->id])):?>
			<div class="rest-list-item-name-header mt-30">
				Популярные блюда
			</div>
			<?php foreach($dishes[$val->id] AS $dish):?>
				<div class="rest-list-item-dish-item">
					<a href="<?php echo $this->createCPUUrl("/menu/".$dish->pid."/")?>">
						<img src="<?php echo $dish->imagesUrl."85x85/".$dish->id.".jpg"?>">
					</a>
					<div class="rest-list-item-dish-item-name"><?php echo $dish->name?></div>
					<div class="rest-list-item-dish-item-price"><?php echo $dish->price?> <i class="fa fa-rub fs-12"></i></div>
				</div>
			<?php endforeach;?>
			<?php endif;?>
			
		</div>
	</div>
	<?php endforeach;?>

	<?} else echo 'По данному запросу ресторанов не найдено';?>
	<div class="milimon-h3 mt-30">Доставка еды на дом и офис</div>
	<div class="milimon-text mt-10 seo-text">
		<?php echo $this->variables['restoransText'];?>
	</div>
	
</div>

<script src="<?php $_SERVER['SERVER_NAME'] ?>/js/useragent.js" type="text/javascript"></script>

