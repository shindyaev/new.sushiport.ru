<div class="content ">
	
	<div class="inner-page-left-sidebar-big">
		<?php if (!empty($actionDish)):?>
		<div class="menu-dish-list-item action margin-0">
				<div class="menu-dish-list-item-action-block">
					<div class="fs-18 bolder white-text">Успей купить!</div>
					<div class="fs-14 bolder white-text">Осталось: <?php echo $actionDish['count']?> блюд</div>
					<div class="fs-12 white-text mt-5">Акция заканчивается через:</div>
					<?php 

						$seconds = strtotime($actionDish['dateEnd']) - strtotime('now');
						$minuts = ceil($seconds / 60) % 60;
						$m1 = $minuts % 10;
						$hours = ceil($seconds / 60 / 60);
						$h1 = $hours % 10;
						
						$time = '';
						
						if ($hours > 10 && $hours < 20) $time .= $hours.' часов ';
						else if ($h1 > 1 && $h1 < 5) $time .= $hours.' часа ';
						else if ($h1 == 1) $time .= $hours.' час ';
						else $time .= $hours.' часов ';
						
						if ($minuts > 10 && $minuts < 20) $time .= $minuts.' минут';
						else if ($m1 > 1 && $m1 < 5) $time .= $minuts.' минуты';
						else if ($m1 == 1) $time .= $minuts.' минута';
						else $time .= $minuts.' минут';
						
					?>
					<div class="fs-14 bolder white-text"><?php echo $time?></div>
				</div>
				<a href="javascript: void(0)" class="menu-dish-list-item-img-container detailDish">
					<img src="<?php echo $actionDish->dish->imagesUrl."229x229/".$actionDish->dish->id.".jpg"?>">
					<div class="hhvn-block">
						<?php if (!empty($actionDish->dish['hit'])):?>
						<div class="hhvn-hit"></div>
						<?php endif;?>
						<?php if (!empty($actionDish->dish['hot'])):?>
						<div class="hhvn-hot"></div>
						<?php endif;?>
						<?php if (!empty($actionDish->dish['vegan'])):?>
						<div class="hhvn-vegan"></div>
						<?php endif;?>
						<?php if (!empty($actionDish->dish['new'])):?>
						<div class="hhvn-new"></div>
						<?php endif;?>
					</div>
				</a>
				<a href="javascript: void(0)" class="menu-dish-list-item-name detailDish">
					<?php echo $actionDish->dish->name?>
				</a>
				<div class="menu-dish-list-item-price-sale">
					<?php echo $actionDish['price']?> Р
				</div>
				<div class="menu-dish-list-item-price">
					<?php echo $actionDish->dish->price?> Р
					<div class="price-middle-line"></div>
				</div>
				<div class="clearfix"></div>
				<div class="dish-list-count-order-block">
					<div class="count-dish-block">
						<div class="minus"></div>
						<div class="count-dish">1</div>
						<div class="plus"></div>
						<input type="hidden" class="dish-count" value="1" autocomplete="off">
					</div>
					<div class="menu-dish-list-item-order pull-right" 
					data-bind="click:function(data, bind) {
						var _this = $(bind.currentTarget).parent().parent();

						product = [];
						product['id'] = _this.find('.dish-id').val();
						product['name'] = _this.find('.dish-name').val();
						product['weight'] = _this.find('.dish-weight').val();
						product['weightType'] = _this.find('.dish-weightType').val();
						product['text'] = _this.find('.dish-text').val();
						product['price'] = _this.find('.dish-price').val();
						product['count'] = _this.find('.dish-count').val();
						
						addGoods(product);

						}"
					></div>
				</div>
				<div class="clearfix"></div>
				
				<input type="hidden" class="dish-id" value="<?php echo $actionDish->dish['id']?>">
				<input type="hidden" class="dish-name" value="<?php echo htmlspecialchars($actionDish->dish['name'])?>">
				<input type="hidden" class="dish-weight" value="<?php echo $actionDish->dish['weight']?>">
				<input type="hidden" class="dish-weightType" value="<?php echo $actionDish->dish->units[$actionDish->dish['weightType']]?>">
				<input type="hidden" class="dish-text" value="<?php echo $actionDish->dish['text']?>">
				<input type="hidden" class="dish-price" value="<?php  echo $actionDish['price']?>">
				<input type="hidden" class="dish-hit" value="<?php echo $actionDish->dish['hit']?>">
				<input type="hidden" class="dish-hot" value="<?php echo $actionDish->dish['hot']?>">
				<input type="hidden" class="dish-new" value="<?php echo $actionDish->dish['new']?>">
				<input type="hidden" class="dish-vegan" value="<?php echo $actionDish->dish['vegan']?>">
				<input type="hidden" class="dish-action" value="1">
				
			</div>
		<?php endif;?>
	
	</div>
	<div class="inner-page-right-big-sidebar">
		<div class="page-headline"><?php echo $model->title?></div>
		<div class="page-text mt-20"><?php echo $model->text?></div>
	</div>	
	<div class="clearfix"></div>
</div><!-- .content-->