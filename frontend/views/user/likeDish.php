<div class="content ">

	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
		<li>
			<a class="text-black">Личный кабинет</a>
		</li>
		<li class="breadcrumbs-splitter"></li>
	</ul>
	<div class="clearfix"></div>
</div>
<div>
	<div class="inner-page-left-sidebar">

		<ul class="left-sidebar-menu mt-10 lk-menu">
			<li class="active">
				<a>Мое меню</a>
				
				<ul class="lk-menu-submenu">
					<?php foreach($this->variables['rests'] AS $key => $val):?>
						<li <?php if ($id == $val['id']):?>class="active"<?php endif;?>><a href="<?php echo $this->createCPUUrl('/user/likeDish/'.$val['id'].'/');?>"><?php echo $val['name']?></a></li>
					<?php endforeach;?>
				</ul>
			
			</li>
			<li><a href="<?php echo $this->createCPUUrl('/user/offers/');?>">Заказы</a></li>
			<li><a href="<?php echo $this->createCPUUrl('/user/edit/');?>">Профиль</a></li>
		</ul>
		
	</div>
	<div class="inner-page-right lk-like">
		<div class="main-h2">Моё меню</div>
		
		<div style="height: 38px;"></div>
		
		<?php if (empty($dishList)):?>
		
			<div class="text-center">
				<img src="/img/add-food-icon-grey.png" width="200">
			</div>
			<br><br>
			<div class="text-center ff-Philosopher fs-24 bolder">
				Добавьте любимое блюдо сейчас
			</div>
			<br>
			<div class="text-center ff-Philosopher fs-18">
				Храните любимые блюда в одном месте,<br>
				чтобы делать быстрые заказы.
			</div>
			<br>
			<a href="/rest/" class="green-button mt-30">
				Выбрать ресторан
			</a>
		
		<?php else:?>
		<ul class="menu-dish-list mt-20">
			<?php foreach ($dishList AS $key => $val):?>
			<li class="menu-dish-list-item auth-user-dish <?php if ($val['action']) echo "action"?>">
				<?php if ($val['action']):?>
				<div class="menu-dish-list-item-action-block">
					<div class="fs-18 bolder white-text">Успей купить!</div>
					<div class="fs-14 bolder white-text">Осталось: <?php echo $val['action']['count']?> блюд</div>
					<div class="fs-12 white-text mt-5">Акция заканчивается через:</div>
					<?php 

						$seconds = strtotime($val['action']['dateEnd']) - strtotime('now');
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
				<?php endif;?>
				<a href="javascript: void(0)" class="menu-dish-list-item-img-container detailDish">
					<img src="<?php echo $val->imagesUrl."229x229/".$val->id.".jpg"?>">
					<div class="hhvn-block">
						<?php if (!empty($val['hit'])):?>
						<div class="hhvn-hit"></div>
						<?php endif;?>
						<?php if (!empty($val['hot'])):?>
						<div class="hhvn-hot"></div>
						<?php endif;?>
						<?php if (!empty($val['vegan'])):?>
						<div class="hhvn-vegan"></div>
						<?php endif;?>
						<?php if (!empty($val['new'])):?>
						<div class="hhvn-new"></div>
						<?php endif;?>
					</div>
				</a>
				<a href="javascript: void(0)" class="menu-dish-list-item-name detailDish">
					<?php echo $val->name?>
				</a>
				<?php if ($val['action']):?>
				<div class="menu-dish-list-item-price-sale">
					<?php echo $val['action']['price']?> <i class="fa fa-rub"></i>
				</div>
				<?php endif;?>
				<div class="menu-dish-list-item-price">
					<?php echo $val->price?> <i class="fa fa-rub"></i>
					<div class="price-middle-line"></div>
				</div>
				<div class="clearfix"></div>
				<div class="dish-list-count-order-block">
					<div class="count-dish-block">
						<div class="minus">&ndash;</div>
						<div class="count-dish">1</div>
						<div class="plus">+</div>
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
						product['rest'] = _this.find('.dish-rest').val();
						
						addGoods(product);

						}"
					>Заказать</div>
				</div>
				<div class="clearfix"></div>
				<div class="add-to-like-block">
					<?php if (empty($likeDish[$val['id']])):?>
						<a href="#" class="add-to-like" rel="<?php echo $val['id']?>">Добавить в Мое меню</a>
					<?php else :?>
						<a href="#" class="remove-to-like" rel="<?php echo $val['id']?>">Удалить из Моего меню</a>
					<?php endif;?>
				</div>
				
				<input type="hidden" class="dish-id" value="<?php echo $val['id']?>">
				<input type="hidden" class="dish-name" value="<?php echo htmlspecialchars($val['name'])?>">
				<input type="hidden" class="dish-weight" value="<?php echo $val['weight']?>">
				<input type="hidden" class="dish-weightType" value="<?php echo $val->units[$val['weightType']]?>">
				<input type="hidden" class="dish-text" value="<?php echo $val['text']?>">
				<input type="hidden" class="dish-price" value="<?php if ($val['action']) echo $val['action']['price']; else echo $val['price']?>">
				<input type="hidden" class="dish-hit" value="<?php echo $val['hit']?>">
				<input type="hidden" class="dish-hot" value="<?php echo $val['hot']?>">
				<input type="hidden" class="dish-new" value="<?php echo $val['new']?>">
				<input type="hidden" class="dish-vegan" value="<?php echo $val['vegan']?>">
				<input type="hidden" class="dish-action" value="<?php if ($val['action']) echo 1; else echo 0;?>">
				<input type="hidden" class="dish-rest" value="<?php echo $val['rest']?>">
				
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
		<div class="clearfix"></div>
		
		<?php if (!empty($dishList)):?>
		
		<div class="like-dish-add-dish-block">
			<div class="like-dish-add-dish-block-img">
				<img src="/img/add-food-icon-b.png">
			</div>
			
			<div class="like-dish-add-dish-block-button">
				<a href="/rest/" class="green-button-2">
					Выбрать ресторан
				</a>
			</div>
			
			<div class="like-dish-add-dish-block-text">
				<div class="like-dish-add-dish-block-text-h1">Добавьте новое блюдо сейчас</div>
				<div class="like-dish-add-dish-block-text-h2">Храните все самое любимое в одном месте,<br>
						чтобы делать быстрые заказы</div>
			</div>
			
			<div class="clearfix"></div>
		</div>
		
		<?php endif;?>
		
	</div>
	
</div><!-- .content-->
