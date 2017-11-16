<div class="main-banner-block">
	<div class="main-banner-block-headline">
		Доставка из ресторанов<br>
		MILIMON FAMILY
	</div>
	
	<div class="main-banner-block-text">Самый большой выбор блюд, <br>которые вы любите.</div>
	
	<a href="<?php echo $this->createCPUUrl("/rest/")?>" class="main-banner-block-button"></a>
</div>

<!-- Рестораны -->
<div class="main-h2 mt-65">
	<h1>доставка из ресторанов</h1>
</div>

<div class="gray-text text-center fs-16 text-italic ff-Philosopher mt-30 lh-20">
Выберите ресторан, чтобы посмотреть<br>
его меню и сделать заказ
</div>

<a href="<?php echo $this->createCPUUrl("/rest/")?>" class="green-button mt-30">
	Все рестораны
</a>

<?php if (!empty($restorans)):?>
<ul class="main-rest-list">
	<?php foreach ($restorans AS $key => $val):?>
	<li>
		<?php
		$link ='';
		if (!empty($val->link)) {
			$link = $val->link;
		}
		else {
			$link = $this->createCPUUrl("/menu/".$val->menu."/");
		}
		?>
		<a href="<?=$link;?>" class="main-rest-list-s-cont">
			<div class="main-rest-img-container">
				<img src="<?php echo $val->images[0]->imagesUrl."222x170/".$val->images[0]->id.".jpg"?>">
				<div class="main-rest-img-container-logo-contaier" style="background: #fff url(../<?php echo $val->imagesUrl."100x100/".$val->id.".png"?>) no-repeat center center">
				</div>
			</div>
			<div class="main-rest-list-name"><?php echo $val->name?></div>
			<div class="main-rest-list-text"><?php echo $val->shortText?></div>
		</a>
	</li>
	<?php endforeach;?>
	<div class="clearfix"></div>
</ul>
<?php endif;?>


<?php if (!empty($banners)):?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php foreach ($banners AS $key => $val):?>
		<li data-target="#carousel-example-generic" data-slide-to="<?php echo $key?>" <?php if ($key == 0 ):?>class="active"<?php endif;?>></li>
		<?php endforeach;?>
	</ol>

  <!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php foreach ($banners AS $key => $val):?>
		<div class="item <?php if ($key == 0 ):?>active<?php endif;?>">
			<a href="<?php echo $val->link?>">
			<img src="<?php echo $val->imagesUrl."1000x442/".$val->id.".jpg"?>">
			</a>
		</div>
		<?php endforeach;?>
  </div>
</div>
<?php endif;?>

<div class="main-h2 mt-65">
	Выберите любимое блюдо
</div>

<div class="gray-text text-center fs-16 text-italic ff-Philosopher mt-30 lh-20">
Мы рады предложить вам великое <br>
множество блюд из меню ресторанов Milimon. <br>
Чтобы вы не выбрали, вы получите именно такой вкус блюд, <br>
к которому привыкли. 
</div>

<div style="display: none;">
	<?php
	/*echo '<pre>';
	print_r($categories);
	echo '</pre>';*/
	?>
</div>
<?php if (!empty($categories)):?>
<ul class="main-menu-cats">
	<?php foreach ($categories AS $key => $val):?>
	<li >
		<?php
		$link ='';
		if (!empty($val->link)) {
			$link = $val->link;
		}
		else {
			$link = $this->createCPUUrl("/menu/".$val->id."/");
		}
		?>
		<a href="<?=$link;?>">
			<div class="main-menu-cats-item-img-cont" style="background: url(../<?php echo $val->imagesUrl."186x160/".$val->id.".png"?>) no-repeat center center;">
			</div>
			<div class="main-menu-cats-name"><?php echo $val->name?></div>
		</a>
	</li>
	<?php endforeach;?>
	<div class="clearfix"></div>
</ul>
<?php endif;?>


<div class="main-yellow-lemon">
	<div class="main-h2">
		Акции сегодня
	</div>

	<div class="text-center fs-16 text-italic  mt-30 lh-20">
	Каждый день рестораны «СьелБыСам», «Бенджамин», «Кембридж»<br>
	 и «OMNI Чайхана» готовят для вас новые акции и специальные предложения.<br>
	Не пропустите все самое интересное.
	</div>
	
	<a href="<?php echo $this->createCPUUrl("/action/")?>" class="green-button mt-30 w-235">
		Посмотреть все акции
	</a>
	
	<div class="row main-actions-list">
		<?php foreach ($actions AS $key => $val):?>
		<div class="col-xs-4 main-actions-list-item">
			<a href="<?php echo $this->createCPUUrl("/action/")?>" class="main-actions-list-item">
				<div class="main-action-list-item-img-block">
					<img src="<?php echo $val->imagesUrl."167x167/".$val->id.".jpg"?>">
				</div>
				<div class="main-actions-list-item-headline">
					<?php echo $val->name?>
				</div>
				<div class="main-actions-list-item-text">
					<?php echo $val->shortText?>
				</div>
			</a>
		</div>
		<?php endforeach;?>
		<div class="col-xs-12"><p style="padding-top: 20px; text-align: center;">Акции действуют только при заказе с сайта и по телефону службы доставки</p></div>
	</div>
</div>

<div class="row main-actions-list mt-20">
	<div class="col-xs-4 main-actions-list-item">
		<a class="main-actions-list-item">
			<img src="img/garant-big.png">
			<div class="main-actions-list-item-headline">
				Гарантия качества
			</div>
			<div class="main-actions-list-item-text gray-text">
				Мы&nbsp;готовим все блюда в&nbsp;наших ресторанах в&nbsp;Самаре. А&nbsp;это означает, что мы&nbsp;ведем строгий контроль качества входящих продуктов и&nbsp;соблюдения технологии производства. Будьте уверены, что получаете одинаково прекрасные блюда каждый день.
			</div>
		</a>
	</div>
	<div class="col-xs-4 main-actions-list-item">
		<a class="main-actions-list-item">
			<img src="img/price-big.png">
			<div class="main-actions-list-item-headline">
				Бесплатная упаковка
			</div>
			<div class="main-actions-list-item-text gray-text">
				Каждый набор включает все самое необходимое: контейнеры для еды, соусник, соевый соус в&nbsp;герметичной упаковке, приборы/палочки, салфетки и&nbsp;зубочистки, буклет для повторного заказа. Все бережно упаковано в&nbsp;отдельный пакет и&nbsp;рассчитано на&nbsp;необходимое количество персон.
			</div>
		</a>
	</div>
	<div class="col-xs-4 main-actions-list-item">
		<a>
			<img src="img/coffe-big.png">
			<div class="main-actions-list-item-headline">
				Только свежая еда
			</div>
			<div class="main-actions-list-item-text gray-text">
				Наши блюда самые свежие, потому что мы&nbsp;начинаем готовить сразу после вашего заказа. В&nbsp;результате&nbsp;&mdash; вы&nbsp;получаете любимое блюдо, каким оно должно быть: свежим, аппетитным и&nbsp;невероятно вкусным.
			</div>
		</a>
	</div>
</div>

<div class="main-review">
	<div class="main-h2">
		что люди говорят<br>
		о доставке milimon
	</div>
	
	<?php if (!empty($reviews)):?>
	<div class="row ">
		<?php foreach ($reviews AS $key => $val):?>
		<div class="col-xs-4">
			<div class="main-review-item">
				«<?php echo $val['text']?>» – <span class="text-italic"><?php echo $val['name']?>.</span>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	<?php endif;?>
	
	<a href="<?php echo $this->createCPUUrl('/review/');?>" class="black-button mt-30">
		Посмотреть все отзывы
	</a>
	
	<div class="main-write-review">
	<a href="<?php echo $this->createCPUUrl('/review/');?>">
		Оставить отзыв
	</a>
	</div>
	
</div>
