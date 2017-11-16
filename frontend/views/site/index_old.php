<div class="main-banners-block" id="main-banners-block" rel="0">
	<?php foreach ($banners AS $key => $val): ?>
	<a href="<?php echo $val['link']?>"  target="_blank" class="main-banners-item <?php if($key == 0) echo 'active';?>">
		<img src="<?php echo $val->imagesUrl."1000x340/".$val['id'].".jpg"?>">
	</a>
	<?php endforeach;?>
</div>

<div class="content main-content">
	<div class="fs-26 text-center">Что GEDZA может сделать для вас?</div>
	<div class="fs-14 gray-text text-center mt-20">GEDZA всегда рядом, когда это нужно. Выберите одну из наших услуг. <br>
			Также посетите <a href="http://hello.gedza.ru/" class="red-text" target="_blank">Центр клиентов GEDZA</a>, доступный 24/7,<br>
			по любым вопросам и предложениям.
	</div>
	
	<div class="clearfix mt-20">
		<div class="ben-col-3">
			<div class="red-text fs-16">Круглосуточная доставка еды курьером в <?php echo $this->variables['city-d']?></div>
			<div class="fs-12 mt-5">Делайте быстрые заказы, как вам будет удобно. Курьер доставит ваш заказ в течение 55 минут по указанному адресу (см. условия доставки). Все будет бережно упаковано и акуратно разложено внутри контейнеров.</div>
		</div>
		<div class="ben-col-3">
			<div class="red-text fs-16">Заберите заказ из ресторана в удобное время</div>
			<div class="fs-12 mt-5"><a href="/pages/24/">Выберите</a> ресторан рядом с вами. Сделайте заказ на <a href="http://www.gedza.ru/">www.gedza.ru</a> или через приложение GEDZA для вашего телефона. Воспользуйтесь также специальными предложениями с максимальной выгодой для вас. <a href="/action/">Посмотрите</a> акцию на сегодня.</div>
		</div>
		<div class="ben-col-3">
			<div class="red-text fs-16">Посещайте рестораны GEDZA и Primasole с друзьями и близкими</div>
			<div class="fs-12 mt-5">Команда «GEDZA» рада встречи с вами каждый день. Мы создаем невероятную атмосферу по-настоящему семейных ресторанов. Мы любим то, что мы делаем и уверены, что вы это цените. </div>
		</div>
	</div>
	
	<div class="clearfix mt-10"></div>
	
	<div class="main-delivery-home-office">Доставка домой и в офис</div>
	<div class="main-headline-1">Подберите меню на сегодня</div>
	<div class="mt-10 pull-left mr-30">
		<select class="custom-select select-menu-today">
			<option>Разделы меню</option>
			<?php foreach ($categories AS $key => $val):?>
				<option value='/menu/<?php echo $val['id']?>/'><?php echo $val['name']?></option>
			<?php endforeach;?>
		</select>
	</div>
	<a href="<?php echo $this->createCPUUrl('/menu/');?>" class="bolder pull-left mt-15">Посмотреть все меню</a>
	
	<div class="clearfix mt-20"></div>
	
	<ul class="main-categories-list mt-10">
		<?php foreach ($selectMenu AS $key => $val):?>
			<li class="main-categories-list-item">
				<div class="main-categories-list-item-img-cont">
					<a href="<?php echo $this->createCPUUrl('/menu/'.$val['idCategory'].'/');?>">
						<img src="<?php echo $val->menu->imagesUrl."228x228/".$val['idCategory'].".jpg"?>">
					</a>
				</div>
				<div class="main-categories-list-item-name-cont">
					<a class="main-categories-list-item-name-cont-name" href="<?php echo $this->createCPUUrl('/menu/'.$val['idCategory'].'/');?>"><?php echo $val->menu->name?></a>
					<div class="main-categories-list-item-name-cont-note"><?php echo $val['text']?></div>
				</div>
			</li>
		<?php endforeach;?>
		<div class="clearfix"></div>
	</ul>
	
	<div class="clearfix mt-30"></div>
	
	<div class="main-headline-1">
		Лучшие в <?php echo $this->variables['city-d'];?> условия на доставку <br>
		блюд из ресторанов
	</div>
	
	<div class="main-delivery-info-block mt-10">
		<div class="fs-22">Круглосуточный сервис доставки блюд на дом и в офис для клиентов GEDZA</div>
		
		<div class="delivery-24-7 mt-20 fs-12">Мы рады обслуживать вас каждый день с 10.00 до 23.00. В пятницу и
			субботу для вашего удобства мы работаетм до 2.00. В ночное и утреннее
			время, когда наши рестораны не работают, ваши заказы выполняет наш
			доверенный партнер <a href="http://www.delivery-club.ru/">Delivery Club</a>.
		</div>
		
		<div class="delivery-main-info mt-20">
			<div class="delivery-main-info-bg">
				<div class="fs-16">Минимальная сумма заказа</div>
				<div class="fs-12 lh-14">
					Минимальная сумма заказа – от 350 рублей днем и от 1000 рублей ночью. 
					Минимальная сумма заказа может отличаться в разных районах <?php echo $this->variables['city-r'];?>. 
					Уточните условия для вашего дома у оператора доставки.
				</div>
				
				<div class="fs-16 mt-10">Бесплатная доставка</div>
				<div class="fs-12 lh-14">Мы доставляем заказы от 350 рублей бесплатно почти в каждый район <?php echo $this->variables['city-r'];?>.
				</div>
				
				<div class="fs-16 mt-10">Быстрая доставка</div>
				<div class="fs-12 lh-14">Мы гарантируем доставку блюд от 55 минут. <a href="/menu/">Узнать время доставки до моего дома.</a>
				</div>
			</div>
		</div>
		
		<div class="delivery-areas fs-11">
			<div class="delivery-area delivery-area-green">
				<span class="underline">Зона 1:</span> Минимальная сумма
				заказа — 350 рублей. <br>
				Время доставки — до 55 минут.
				
				<?php if ($this->variables['city-id'] == 1):?>
				<div class="delivery-areas-popur-help">Соседние улицы с ресторанами GEDZA и Primasole<div class="small-arr-r"></div></div>
				<?php endif;?>
				
				<?php if ($this->variables['city-id'] == 2):?>
				<div class="delivery-areas-popur-help">Соседние улицы с ресторанами GEDZA и Primasole и центр исторической части Уфы<div class="small-arr-r"></div></div>
				<?php endif;?>
			</div>
				
				<?php if ($this->variables['city-id'] == 1):?>
				<div class="delivery-area delivery-area-blue mt-10">
					<span class="underline">Зона 2:</span> Минимальная сумма
					заказа — 650 рублей.<br>
					Время доставки — до 90 минут.
					<div class="delivery-areas-popur-help">Промышленные район, центр исторической части Самары<div class="small-arr-r"></div></div>
				</div>
				<?php endif;?>
				
				<?php if ($this->variables['city-id'] == 1):?>
				<div class="delivery-area delivery-area-haki mt-10">
					<span class="underline">Зона 3:</span> Минимальная сумма
					заказа — 1000 рублей.<br>
					Время доставки — до 120 минут.
					<div class="delivery-areas-popur-help">пос. Мех.завод, Зубчаниновка, пос. Управленческий, пос. 116 км, Сухая Самарка, пос. Красная Глинка<div class="small-arr-r"></div></div>
				</div>
				<?php endif;?>
				
				<?php if ($this->variables['city-id'] == 2):?>
				<div class="delivery-area delivery-area-blue mt-10">
					<span class="underline">Зона 2:</span> Минимальная сумма
					заказа — 650 рублей.<br>
					Время доставки — до 90 минут.
					<div class="delivery-areas-popur-help">проспект Октября, Сипайлово, Зелёная роща<div class="small-arr-r"></div></div>
				</div>
				<?php endif;?>
				
				<?php if ($this->variables['city-id'] == 2):?>
				<div class="delivery-area delivery-area-haki mt-10">
					<span class="underline">Зона 3:</span> Минимальная сумма
					заказа — 1000 рублей.<br>
					Время доставки — до 120 минут.
					<div class="delivery-areas-popur-help">Дема, Черниковка, Док, Инорс, Затон<div class="small-arr-r"></div></div>
				</div>
				<?php endif;?>
		</div>

		<?php if ($this->variables['city-id'] == 2):?>
		<div class="main-arrow-block-note">Обратите внимание! Минимальная стоимость заказа для Шакшы, Аэропорта и некоторые посёлков – 2000 рублей. Уточните информацию у оператора доставки.</div>
		<?php endif;?>
		<div class="clearfix"></div>
		
	</div>
	
	<div class="main-fast-order-info-block">
		<div class="fs-22 bolder white-text main-fast-order-info-block-headline">Быстрый заказ</div>
		
		<div class="white-bg mt-20">
			<div class="fs-16">Выберите способ заказа</div>
			<ul class="list-tire fs-12">
				<li>по телефону в Самаре 203-00-00</li>
				<li>на сайте <a href="http://gedza.ru/">www.gedza.ru</a></li>
				<li>через <a href="https://itunes.apple.com/ru/app/gedza/id765543132?mt=8">приложение</a> на телефоне</li>
			</ul>
		</div>
		<div class="mt-15 white-text">
			<div class="fs-16">Выберите раздел меню</div>
			<ul class="list-tire fs-12 margin-0">
				<li>Бизнес-ланчи (<a href="<?php if ($this->variables['city-id'] == 1) echo $this->createCPUUrl('/menu/127/'); elseif ($this->variables['city-id'] == 2) echo $this->createCPUUrl('/menu/111/');  ?>" class="white-text">14 блюд и наборов</a>)</li>
				<li>Суши. роллы, наборы (<a href="<?php if ($this->variables['city-id'] == 1) echo $this->createCPUUrl('/menu/95/'); elseif ($this->variables['city-id'] == 2) echo $this->createCPUUrl('/menu/96/');  ?>" class="white-text">27 блюд</a>)</li>
				<li>Пицца и страмполи (<a href="<?php if ($this->variables['city-id'] == 1) echo $this->createCPUUrl('/menu/117/'); elseif ($this->variables['city-id'] == 2) echo $this->createCPUUrl('/menu/100/');  ?>" class="white-text">12 блюд</a>)</li>
				<li>Горячие блюда (<a href="<?php if ($this->variables['city-id'] == 1) echo $this->createCPUUrl('/menu/121/'); elseif ($this->variables['city-id'] == 2) echo $this->createCPUUrl('/menu/104/');  ?>" class="white-text">15 блюд</a>)</li>
			</ul>
			<a href="<?php echo $this->createCPUUrl('/menu/');?>" class="white-text fs-12">Посмотреть все меню</a>
		</div>
		
		<div class="mt-15 white-text">
			<div class="fs-16">Оплатите удобным способом</div>
			<ul class="list-tire fs-12">
				<li>наличными при получении</li>
				<li>банковской картой при получении</li>
				<li>на сайте <a href="http://gedza.ru/" class="white-text fs-12">www.gedza.ru</a></li>
			</ul>
		</div>
		
		<a href="
			<?php 
				if ($this->variables['city-id'] == 1)
					echo $this->createCPUUrl('/smr/cart/');
				elseif ($this->variables['city-id'] == 2)
					echo $this->createCPUUrl('/ufa/cart/');
				else 
					echo $this->createCPUUrl('/cart/');
			?>
		">
			<div class="order-button-2"></div>
		</a>
		
		
	</div>
	
	<div class="clearfix"></div>
	
	<div class="clearfix mt-40">
		<div class="ben-col-3">
			<div class="blank-icon">
				<div class="fs-16">Гарантия качества</div>
				<div class="gray-text fs-12 mt-5">Мы готовим все блюда в наших ресторанах в Уфе и Самаре. А это означает, что мы ведем строгий контроль качества входящих продуктов, а также соблюдение технологии производства. Будьте уверены, что получаете одинаково прекрасные блюда каждый день.</div>
			</div>
		</div>
		<div class="ben-col-3">
			<div class="coffe-icon">
				<div class="fs-16">Только свежая еда</div>
				<div class="gray-text fs-12 mt-5">Мы не готовим заранее ни одно из 250 блюд из меню GEDZA и Primasole. Поэтому наши блюда самые свежие.</div>
			</div>
		</div>
		<div class="ben-col-3">
			<div class="price-icon">
				<div class="fs-16">Бесплатная упаковка</div>
				<div class="gray-text fs-12 mt-5">Каждый набор в заказе GEDZA включает все самое необходимое: контейнеры для еды, соусник, соевый соус в герметичной упаковке, приборы/палочки, салфетки и зубочистки, буклет для повторного заказа. Все — бережно упаковано в отдельный пакет и рассчитано на необходимое количество персон.</div>
			</div>
		</div>
	</div>
	
	<?php if (!empty($actions)):?>
	<div class="main-action-block mt-30">
		<div class="text-center fs-20">Акции на доставку</div>
		
		<div class="clearfix">
			<?php foreach ($actions AS $key => $val):?>
			<div class="ben-col-3 text-center">
				<a href="<?php echo $this->createCPUUrl('/action/#action-'.$val['id']);?>" class="no-underline">
					<img src="<?php echo $val->imagesUrl."104x104/".$val['id'].".jpg"?>" class="main-action-block-img">
					<div class="fs-16 mt-15 lh-18"><?php echo $val['name']?></div>
					<div class="mt-10 fs-12 lh-14"><?php echo $val['shortText']?></div>
				</a>
			</div>
			<?php endforeach;?>
		</div>
		
		<div class="fs-20 red-text text-center">А есть еще? Конечно – да!</div>
		<div class="fs-14 text-center">Посмотрите <a href="<?php echo $this->createCPUUrl('/action/');?>">все акции GEDZA</a> на доставку, а также<br>в ресторанах и для заказов с собой.</div>
	</div>
	<?php endif;?>
	
	<?php if (!empty($reviews)):?>
	<div class="main-review-block mt-20">
		<div class="write-review pull-right"><a href="<?php echo $this->createCPUUrl('/review/');?>">Оставить отзыв</a></div>
		<div class="fs-20 bolder">Популярные отзывы</div>
		<div class="fs-12"><a href="<?php echo $this->createCPUUrl('/review/');?>">Все отзывы</a></div>
		
		<div class="review-list clearfix mt-20">
			<?php foreach ($reviews AS $key => $val):?>
			<div class="review-list-item">
				<div class="review-list-item-name bolder <?php if ($val['sex'] == 0) echo 'men'; else echo 'women' ?>"><?php echo $val['name']?></div>
				<div class="review-list-item-text-container">
					<div class="review-list-item-text">
						<?php echo $val['text']?>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
	<?php endif;?>
		
	
</div><!-- .content-->


<script type="text/javascript">
	$(document).ready(function() {
  		$('.custom-select').selectric({'onChange': function(elem){
  	  			document.location = $(".custom-select").val()
  	  		}
	  	});
	  	
	  	
	  	var rotateBanners = function() {
			var rel = parseInt($("#main-banners-block").attr('rel'));
			var count = parseInt($("#main-banners-block a").length);
			
			if (count > 1) {
				$("#main-banners-block a").eq(rel).fadeOut();
				rel++;

				if (rel == count)
					rel = 0;
				$("#main-banners-block").attr('rel', rel);
				$("#main-banners-block a").eq(rel).fadeIn();
			}

		}
		
		setInterval(rotateBanners, 10000);

	})
</script>
