<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<div class="content">
	<ul class="milimon-breadcrumb">
		<li>
			<a href="/">Milimon</a>
		</li>
		<li class="breadcrumbs-splitter" style="color: #848484;">&rarr;</li>
		<li>
			<a href="<?php echo $this->createCPUUrl("/rest/")?>">Доставка еды</a>
		</li>
		<li class="breadcrumbs-splitter">&rarr;</li>
		<li>
			<a class="text-black">Меню <?php echo $restoran->name?></a>
		</li>
	</ul>
	<div class="clearfix"></div>

	<?php
	$a = ceil(strlen($restoran->name) / 2);

	$w = $a * 18;

	$w1 = 960 - $w - 10;
	$w2 = 508 - $w - 10;
	?>
	<div class="mt-10 rest-name-block">
		<div class="menu-page-rest-name" style="width: <?php echo $w?>px">

			<?php echo $restoran->name?>

		</div>

		<div class="search-adr-input-block pull-right" style="width: <?php echo $w1?>px;">

			<div class="deliveru-truck-1">
			</div>
			<div class="deliveru-truck-2" style="width: <?php echo $w2?>px;">
				<div style="margin: 0 auto; width: 155px; position: relative; top: -37px;">
					Узнайте время доставки из <br> ресторана до вашего дома
				</div>
			</div>
			<div class="deliveru-truck-3">
			</div>

			<div class="search-button pull-right">Найти</div>
			<input type="text" class="search-adr-input pull-right" placeholder="Улица, дом" style="margin-right: 8px;">

		</div>
	</div>

	<div class="clearfix"></div>
</div>


<div class="menu-page-rest-block">
	<div class="menu-page-rest-block-bg-img" style="background: url(<?php echo $restoran->images[0]->imagesUrl."1000x420/".$restoran->images[0]->id.".jpg"?>) no-repeat center center">
		<div class="menu-page-rest-block-bg-grad">
			<div class="pull-left text-center w-300 mt-20">
				<img src="<?php echo $restoran->imagesUrl."230x230/".$restoran->id.".png"?>">
			</div>
			<div class="pull-right w-620 white-text">
				<span class="bolder">Кухня:</span> <?php echo $restoran->kittchen?>

				<div class="menu-page-rest-block-work-time">
					<?php 
						if (date('w') == 6 or date('w') == 0) {
							echo('Работает с 12:00');
						}
						else {
							echo $restoran->workTime;
						}
					?>
				</div>

				<div class="mt-20 milimon-dish-list-restoran-text">
					<?php echo str_replace("\n", "<br>", $restoran->text);?>
				</div>

				<div class="menu-page-rest-block-f-col">
					<a href="<?php echo $restoran->site?>" target="_blank" class="white-text">Сайт ресторана</a>
					<br><br><br>
				</div>

				<div class="menu-page-rest-block-f-col">
					<?php if (!empty($restoran->map)) :?>
						<a href="#" class="white-text" data-toggle="modal" data-target="#ya-map-<?php echo $restoran->id?>">Адрес и телефон</a>
						<div  class="modal fade" id="ya-map-<?php echo $restoran->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body">
										<div style ="display: block;"><?php echo $restoran->map?></div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<br><br><br>
				</div>
				<div class="clearfix"></div>
				<div class="pull-left mr-20 blackBlock">
					<div class="menu-page-rest-block-deliv-price-bl"><?php echo $restoran->minCheck?> Р</div>
					<div class="menu-page-rest-block-f-col-s white-text fs-12">мин. сумма заказа</div>
				</div>

				<div class="pull-left blackBlock">
					<div class="menu-page-rest-block-deliv-price-bl"><?php echo $restoran->delivery?></div>
					<div class="menu-page-rest-block-f-col-s white-text fs-12">стоимость доставки</div>
				</div>


			</div>
			<div class= "clearfix"></div>
		</div>
	</div>
</div>





<div class="content menu-content">
	<div class="menu-block-container">
		<!--
		<a href="<?php echo $settings->menuLink;?>" class="pdf-menu-link" target="_blank">
			Возьмите меню и Primasole с собой
		</a>
		-->

		<?php
		$custom_select_link = '';
		if (!empty($model->link)) {
			$custom_select_link = $model->link;
		}
		else {
			$custom_select_link = '/menu/'.$id.'/';
		}
		?>
		<div class="mt-13 pull-left mr-20 ">
			<select class="custom-select <?=$model->link;?>">
				<option value='<?=$custom_select_link;?>sort/'>По популярности</option>
				<option value='<?=$custom_select_link;?>price/' <?php if ($sort == 'price') echo 'selected'?>>По цене</option>
			</select>
		</div>
		<!-- <div class="mt-18 pull-left">
			<?php foreach ($popularMenuItems AS $key => $val):?>
				<div class="pull-left mr-10">
					<a class="<?php if($val->id == $model->id) echo 'active popular-menu-items'?>" href="/menu/<?php echo $val->id?>/"><?php echo $val->name?></a>
					<?php if (!empty($val['note'])):?>
						<div class="fs-11 gray-text italic"><?php echo $val['note']?></div>
					<?php endif;?>
				</div>
			<?php endforeach;?>
			<div class="clearfix"></div>

		</div> -->
		<div class="clearfix"></div>
		
		<ul class="menu-categories-list mt-20">
			<?php foreach ($popularMenuItems AS $key => $val):?>
				<li class="<?php if($val->id == $model->id) echo 'active'?>">
					<?php
					$link ='';
					if (!empty($val->link)) {
						$link = $val->link;
					}
					else {
						$link = "/menu/".$val->id."/";
					}
					?>
					<a href="<?=$link;?>"><?=$val->name;?></a>
					<?php if (!empty($val['note'])):?>
						<div class="fs-11 gray-text italic"><?=$val['note'];?></div>
					<?php endif;?>
				</li>
			<?php endforeach;?>

			<?php foreach ($menuItems AS $key => $val):?>
				<?php
				$link ='';
				if (!empty($val->link)) {
					$link = $val->link;
				}
				else {
					$link = "/menu/".$val->id."/";
				}
				?>
				<li class="<?php if($val->id == $model->id) echo 'active'?>">
					<a href="<?=$link;?>"><?=$val->name;?></a>
				</li>
			<?php endforeach;?>
		</ul>

		<div class="clearfix"></div>

		<?php if (!empty($model->commentHeader) || !empty($model->comment)):?>
			<div class="section-note-block">
				<div class="section-note-block-headline"><?php echo $model->commentHeader?></div>
				<div class="section-note-block-note"><?php echo $model->comment?></div>
			</div>

			<div class="clearfix"></div>
		<?php endif;?>

		<?php
		if (isset($this->variables['h1']) && trim($this->variables['h1']) != '') {
			echo '<h1 class="dish-list-h1">'.$this->variables['h1'].'</h1>';
		}
		?>

		<ul class="menu-dish-list mt-20">
			<?php foreach ($dishList AS $key => $val):?>
				<li class="menu-dish-list-item <?php if ($val['action']) echo "action"?> <?php if (!Yii::app()->user->isGuest) echo 'auth-user-dish'?>">
					<?php if ($val['action']):?>
						<div class="menu-dish-list-item-action-block">
							<div class="fs-18 bolder ">Успей купить!</div>
							<div class="fs-12 bolder ">Осталось: <?php echo $val['action']['count']?> блюд</div>
							<div class="fs-12  mt-10 ">Акция заканчивается через:</div>
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
							else if ($m1 == 1) $time .= $minuts.' минуту';
							else $time .= $minuts.' минут';

							?>
							<div class="fs-14 bolder lh-14"><?php echo $time?></div>
						</div>
					<?php endif;?>
					<a href="javascript: void(0)" class="menu-dish-list-item-img-container detailDish">
						<div class="menu-dish-list-item-img-hover"></div>
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
					<div class="menu-dish-list-item-description"><?=$val['text'];?></div>
					<div class="menu-dish-list-item-weight">Вес: <?=$val['weight'].' '.$val->units[$val['weightType']];?></div>
					<!-- <div class="menu-dish-list-item-ccal">Калорийность: <?=$val['ccal']."ккал"?></div> -->
					<div class="menu-dish-list-item-price <?php if ($val['action']):?>no-bolder<?php endif;?>">
						<?php if ($val['action'] && !empty($val['action']['priceOld'])):?>
							<?php echo $val['action']['priceOld'];?>
						<?php else: ?>
							<?php echo $val->price?>
						<?php endif;?>
						<i class="fa fa-rub"></i>
						<div class="price-middle-line"></div>
					</div>
					<?php if ($val['action']):?>
						<div class="menu-dish-list-item-price-sale">
							<?php echo $val['action']['price']?> Р
						</div>
					<?php endif;?>
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
						product['ccal'] = _this.find('.dish-ccal').val();
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
					<input type="hidden" class="dish-ccal" value="<?php echo $val['ccal']?>">
					<input type="hidden" class="dish-weightType" value="<?php echo $val->units[$val['weightType']]?>">
					<input type="hidden" class="dish-text" value="<?php echo htmlspecialchars($val['text'])?>">
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

		<div class="clearfix"></div>

		<?php
		if (isset($this->variables['seotext']) && trim($this->variables['seotext']) != '') {
			echo '<div class="seotext-wrapper">'.$this->variables['seotext'].'</div>';
		}
		?>

		<div class="fs-24 text-center ff-Philosopher mt-30 italic bolder">Не нашли что искали?</div>
		<div class="fs-14 text-center italic">
			Продолжайте выбор по меню <br>
			других ресторанов <a href="<?php echo $this->createCPUUrl('/rest/')?>">Milimon Family</a>
		</div>

		<?php if (!empty($recommendedList) || !empty($showedList)):?>
			<?php
			if (!empty($recommendedList))
				$show = 1;
			else if(!empty($showedList))
				$show = 3;
			?>
			<div class="other-dish-block mt-40">
				<ul class="other-dish-block-menu">
					<?php if (!empty($recommendedList)):?>
						<li class="other-dish-block-menu-list <?php if ($show == 1) echo 'active'?>" id="recomended-link" rel="recomended-block">Мы рекомендуем</li>
					<?php endif;?>
					<!-- 				<li class="other-dish-block-menu-list" id="other-buy-link" rel="other-buy-block">С этим товаром обычно покупают</li>-->
					<?php if (!empty($showedList)):?>
						<li class="other-dish-block-menu-list <?php if ($show == 3) echo 'active'?>" id="showed-link" rel="showed-block">Ранее просмотренные</li>
					<?php endif;?>
					<li class="clearfix"></li>
				</ul>
				<ul class="other-dish-block-dish-list" id="recomended-block" <?php if ($show != 1) echo 'style="display: none"'?>>
					<?php foreach ($recommendedList AS $key => $val):?>
						<li class="other-dish-block-dish-list-item">
							<a href="javascript: void(0)" class="detailDish">
								<img src="<?php echo $val->imagesUrl."229x229/".$val['id'].".jpg"?>" class="other-dish-block-dish-list-item-img">
							</a>
							<div class="other-dish-block-dish-list-item-name" ><?php echo $val['name']?></div>

							<input type="hidden" class="dish-count" value="1" autocomplete="off">
							<div class="menu-dish-list-item-order recommended-order-btn"
							     data-bind="click:function(data, bind) {
											var _this = $(bind.currentTarget).parent();

											product = [];
											product['id'] = _this.find('.dish-id').val();
											product['name'] = _this.find('.dish-name').val();
											product['weight'] = _this.find('.dish-weight').val();
											product['ccal'] = _this.find('.dish-ccal').val();
											product['weightType'] = _this.find('.dish-weightType').val();
											product['text'] = _this.find('.dish-text').val();
											product['price'] = _this.find('.dish-price').val();
											product['count'] = _this.find('.dish-count').val();
											product['rest'] = _this.find('.dish-rest').val();

											addGoods(product);

											}"
							>Заказать</div>

							<div class="other-dish-block-dish-list-item-price"><?php echo $val['price']?> <i class="fa fa-rub"></i></div>
							<input type="hidden" class="dish-id" value="<?php echo $val['id']?>">
							<input type="hidden" class="dish-name" value="<?php echo htmlspecialchars($val['name'])?>">
							<input type="hidden" class="dish-weight" value="<?php echo $val['weight']?>">
							<input type="hidden" class="dish-ccal" value="<?php echo $val['ccal']?>">
							<input type="hidden" class="dish-weightType" value="<?php echo $val->units[$val['weightType']]?>">
							<input type="hidden" class="dish-text" value="<?php echo $val['text']?>">
							<input type="hidden" class="dish-price" value="<?php echo $val['price']?>">
							<input type="hidden" class="dish-hit" value="<?php echo $val['hit']?>">
							<input type="hidden" class="dish-hot" value="<?php echo $val['hot']?>">
							<input type="hidden" class="dish-new" value="<?php echo $val['new']?>">
							<input type="hidden" class="dish-vegan" value="<?php echo $val['vegan']?>">
							<input type="hidden" class="dish-rest" value="<?php echo $val['rest']?>">
						</li>
					<?php endforeach;?>
					<li class="clearfix"></li>
				</ul>

				<ul class="other-dish-block-dish-list" id="showed-block" <?php if ($show != 3) echo 'style="display: none"'?>>
					<?php foreach ($showedList AS $key => $val):?>
						<li class="other-dish-block-dish-list-item">
							<a href="javascript: void(0)" class="detailDish">
								<img src="<?php echo $val->imagesUrl."229x229/".$val['id'].".jpg"?>" class="other-dish-block-dish-list-item-img">
							</a>
							<div class="other-dish-block-dish-list-item-name" ><?php echo $val['name']?></div>
							<div class="other-dish-block-dish-list-item-price"><?php echo $val['price']?> <i class="fa fa-rub"></i></div>
							<input type="hidden" class="dish-id" value="<?php echo $val['id']?>">
							<input type="hidden" class="dish-name" value="<?php echo htmlspecialchars($val['name'])?>">
							<input type="hidden" class="dish-weight" value="<?php echo $val['weight']?>">
							<input type="hidden" class="dish-ccal" value="<?php echo $val['ccal']?>">
							<input type="hidden" class="dish-weightType" value="<?php echo $val->units[$val['weightType']]?>">
							<input type="hidden" class="dish-text" value="<?php echo $val['text']?>">
							<input type="hidden" class="dish-price" value="<?php echo $val['price']?>">
							<input type="hidden" class="dish-hit" value="<?php echo $val['hit']?>">
							<input type="hidden" class="dish-hot" value="<?php echo $val['hot']?>">
							<input type="hidden" class="dish-new" value="<?php echo $val['new']?>">
							<input type="hidden" class="dish-vegan" value="<?php echo $val['vegan']?>">
							<input type="hidden" class="dish-rest" value="<?php echo $val['rest']?>">
						</li>
					<?php endforeach;?>
					<li class="clearfix"></li>
				</ul>
				<div class="clearfix"></div>

			</div>
		<?php endif;?>


		<div class="clearfix"></div>
		<br><br>
	</div>

</div><!-- .content-->



<!-- Modal -->
<div class="modal fade" id="delivery-modal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<div class="delivery-popap-header bolder">
					Доставка Milimon по адресу:
				</div>
				<div class="delivery-popap-addr-container">
					ул. Победы 90
				</div>

				<div class="delivery-popap-run-people">
					Время доставки до двери - <span class="delivery-popap-time-container">60</span>.
				</div>

				<a href="/cart/" class="no-underline">
					<div class="delivery-popap-button center-block">Оформить заказ</div>
				</a>

				<div class="delivery-popap-continue">
					<a href="javascript: void(0)" data-dismiss="modal">
						Продолжить <br> выбор по меню
					</a>
				</div>

			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="delivery-modal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<div class="delivery-popap-header bolder">
					Доставка Milimon по адресу:
				</div>
				<div class="delivery-popap-addr-container">
					ул. Победы 90
				</div>

				<div class="delivery-popap-truck">
					Время доставки до двери - <span class="delivery-popap-time-container"90</span>.
				</div>
				<a href="/cart/" class="no-underline">
					<div class="delivery-popap-button center-block">Оформить заказ</div>
				</a>

				<div class="delivery-popap-continue">
					<a href="javascript: void(0)" data-dismiss="modal">
						Продолжить <br> выбор по меню
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="delivery-modal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<div class="delivery-popap-header bolder">
					Доставка Milimon по адресу:
				</div>
				<div class="delivery-popap-addr-container">
					ул. Победы 90
				</div>

				<div class="delivery-popap-text">
					Время доставки до двери - <span class="delivery-popap-time-container">90</span>.
				</div>

				<div class="delivery-popap-black-small-text">
					По техническим причинам мы не сможем доставить ваш заказ быстрее, но<br>
					мы поторопимся и будем рады, если вы подождете.
				</div>

				<a href="/cart/" class="no-underline">
					<div class="delivery-popap-button center-block">Оформить заказ</div>
				</a>

				<div class="clearfix"></div>
				<div class="delivery-popap-cancel-text-block">
					<div class="delivery-popap-cancel-text" data-dismiss="modal" onclick="javascript: cart.removeAllGoods();">
						Отменить заказ и выбрать<br>
						доставку из другого ресторана
					</div>
					<div class="delivery-popap-cancel-continue-text"  data-dismiss="modal">
						Продолжить <br> выбор по меню
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="delivery-modal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<div class="delivery-club-popap-logo"></div>

				<div class="delivery-green-popap-text">Оформите этот заказ на <a href="http://www.delivery-club.ru/" class="white-text">deliveryclub.ru</a> и<br> возвращайтесь к нам завтра с 10.00 до 23.00</div>

				<div class="delivery-green-popap-text-small">В ночное и утреннее время, когда наши рестораны не работают,<br>ваши заказы выполняет наш доверенный партнер Delivery Club.</div>

				<a href="http://www.delivery-club.ru/" class="no-underline">
					<div class="delivery-popap-button-delivery center-block">Заказать в Delivery Club	</div>
				</a>

				<div class="popur-close" data-dismiss="modal"><span aria-hidden="true"></div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="delivery-modal-5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">

				<div class="delivery-popap-header">
					Доставка по адресу:
				</div>
				<div class="delivery-popap-addr-container">
					ул. Победы 90
				</div>

				<div class="delivery-popap-text">
					Адрес не найден.
				</div>

				<div class="delivery-popap-button center-block" data-dismiss="modal">ОК</div>

				<div class="popur-close" data-dismiss="modal"><span aria-hidden="true"></div>
			</div>
		</div>
	</div>
</div>

<div id="map" style="width:1px;height:1px" class="hidden"></div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.custom-select').selectric({'onChange': function(elem){
			document.location = $(".custom-select").val()
		}
		});

	})
</script>
<?php
$zones  = [];
/** @var Zones[] $temp */
$criteria = new CDbCriteria();
$criteria->condition = 'restoran_id = '.(int)$restoran->id;
$temp = Zones::model()->findAll($criteria);
foreach ($temp as $item) {
	$zone = array(
		'id' 	 => $item->id,
		'points' => json_decode($item->params,'true'),
		'modal'  => 3,
		'time'	 => $item->time,
	);
	if ($restoran->id == 6) {
		$zone['modal'] = 1;
	}
	$zones[] = $zone;
}
$zones = json_encode($zones);

?>
<?php if ($zones):?>
	<script type="text/javascript">
		var zones = JSON.parse('<?=$zones?>');
		ymaps.ready(init);

		function init() {
			var myMap = new ymaps.Map("map", {
				center: [53.244301,50.206438],
				zoom: 11
			});

			for (var i = 0; i < zones.length; i++) {
				var zone = new ymaps.geometry.Polygon(
					zones[i].points
				);

				// Метод работает только с корректно заданной картой.
				zone.options.setParent(myMap.options);
				zone.setMap(myMap);

				zones[i].zone = zone;
			}

			$(".search-button").click(function() {

				var addr = $(".search-adr-input").val();
				if (addr.length == 0)
					return;

				var str_pattern=/[0-9]/i;
				if (!str_pattern.test(addr))
					return;

				$(".delivery-popap-addr-container").html(addr);

				var myGeocoder = ymaps.geocode(addr, {
					boundedBy: [[53.3529,50.0057], [53.1305,50.4678]], // Сортировка результатов от центра окна карты
					results: 1,
				})

				myGeocoder.then(
					function (res) {
//	     		myMap.geoObjects.add(res.geoObjects);

						if (!res.geoObjects.get(0)) {
							$("#delivery-modal-5").modal();
							return;
						}

						var coords = res.geoObjects.get(0).geometry.getCoordinates();

						for (var i = 0; i < zones.length; i++) {
							if (zones[i].zone.contains(coords)) {
								$("#delivery-modal-"+zones[i].modal).find('.delivery-popap-time-container').html(zones[i].time);
								$("#delivery-modal-"+zones[i].modal).modal();
								return;
							}
						}
						$("#delivery-modal-5").modal();
						return;
					},
					function (err) {
						// обработка ошибки
						console.log("errr");
					}
				);

			})

		}
	</script>
<?php endif;?>


<script src="<?php $_SERVER['SERVER_NAME'] ?>/js/useragent.js" type="text/javascript"></script>
