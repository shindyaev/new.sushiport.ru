<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head class='qqqwww'>
	<?php
		$local_title = '';
		$local_keywords = '';
		$local_description = '';
		if (isset($this->variables['title']) && trim($this->variables['title']) != '') {
			$local_title = $this->variables['title'];
		}
		if (isset($this->variables['keywords']) && trim($this->variables['keywords']) != '') {
			$local_keywords = $this->variables['keywords'];
		}
		if (isset($this->variables['description']) && trim($this->variables['description']) != '') {
			$local_description = $this->variables['description'];
		}

		$url = parse_url($_SERVER['REQUEST_URI']);
		if ($url['path'] == '/') {
			$local_title = 'Доставка еды на дом и в офис из ресторанов в Самаре - "Milimon"| Доставка обедов';
			$local_description = 'Доставка блюд из Omni, Кембридж кафе, Бенджамин и СъелбыСам на дом и в офис в Самаре';
		}
	?>
	<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?=$local_title;?></title>
	<meta name="keywords" content="<?=$local_keywords;?>" />
	<meta name="description" content="<?=$local_description;?>" />

    <meta name="apple-itunes-app" content="app-id=990580933">
    <meta name="google-play-app" content="app-id=air.com.rework.sielbysam">


	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Philosopher:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/selectric.css" type="text/css" />
    <link rel="stylesheet" href="/css/jquery.smartbanner.css" type="text/css" />
    <link rel="stylesheet" href="/css/lightbox.css" type="text/css" />
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	
	<link rel="shortcut icon" href="/favicon-mil.ico" type="image/x-icon">
	
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/knockout-3.0.0.js"></script>
	<script type="text/javascript" src="/js/jstorage.min.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="/js/jquery.smartbanner.js"></script>
	<script type="text/javascript" src="/plugins/jquery-inputmask/jquery.inputmask.js"></script>
	<script type="text/javascript" src="/plugins/jquery-inputmask/jquery.inputmask.date.extensions.js"></script>
	<script type="text/javascript" src="/plugins/jquery-inputmask/jquery.inputmask.numeric.extensions.js"></script>
	<script type="text/javascript" src="/js/jquery.selectric.js"></script>
	<script type="text/javascript" src="/js/lightbox.min.js"></script>
	<script type="text/javascript" src="/js/cart.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/mobile.css" type="text/css" />

	<script type="text/javascript">
		var restorans = new Array();
		<?php foreach($this->variables['restorans'] AS $key => $val):?>
			restorans[<?php echo $val['menu']?>] = <?php echo $val['work']?>;
		<?php endforeach;?>
	</script>
</head>

<body>
	<div class="wrapper">
	<?php if (empty($this->variables['incart'])):?>
	<div class="header-text-line">
		<div id="header-fixed-top">
			<a target="_blank" href="http://www.milimon-family.ru/" class="top-milimon-family">MILIMON<br>FAMILY</a>

			<div class="top-phone-block">
				<div class="top-phone-block-header">200-02-20</div>
				<div class="top-phone-block-footer">Закажите по телефону</div>
			</div>

			<div class="city-head-menu" style="float: left; margin-left: 30px; background: #eeeff1;">
				<div class="city-change-city-head-menu mr-20">
					<a><?php echo $this->variables['city']?></a>
					<ul class="change-city-list">
						<?
							foreach ($this->variables['citysFull'] as $city) {
								echo '<li><a href="http://' . $city->alias . '.new.milimon.ru">' . $city->name . '</a></li>';
							}
						?>

						<?/*php foreach ($this->variables['citys'] AS $key => $val):?>
							<li><a href="/site/changeCity/<?php echo $key;?>/"><?php echo $val?></a></li>
						<?php endforeach;*/?>

					</ul>
				</div>
			</div>

			<a href="<?php echo $this->createCPUUrl('/cart/')?>" class="header-text-line-go-to-cart" data-bind="css: cartClass">
				Перейти в корзину
			</a>

			<div class="header-text-line-cart">
				Ваш заказ на
				<b class="bolder">
					<span data-bind="text: totalPriceRZ"></span> + <span data-bind="text: delivPrice"></span>
					<i class="fa fa-rub"></i>
				</b>
				за доставку
				<div class="header-text-line-cart-note">Бесплатная доставка от 700 Р</div>
			</div>
		</div>
	</div>
	<?php endif;?>
	
	
	<div class="header">
		<?php if (empty($this->variables['incart'])):?>
		<a href="/" class="logo">
			<img src="/img/logo.png">
		</a>
		<?php else :?>
			<a href="/" class="logo nocart">
				<img src="/img/logo.png">
			</a>
		<?php endif;?>

		<div class="header-lk-block">
			<?php if (Yii::app()->user->isGuest) :?>
				<a href="<?php echo $this->createCPUUrl('/user/login/');?>" class="header-lk-block-login-button">Войти</a>
				<div class="small-gray-text mt-10">Первый раз? <a href="<?php echo $this->createCPUUrl('/user/registration/');?>" class="small-gray-text">Начните здесь</a></div>
			<?php else:?>
				<a href="<?php echo $this->createCPUUrl('/user/likeDish/');?>" class="logined-link"><?php echo Yii::app()->user->name?></a>
				<br>
				<a class="logout-link" href="<?php echo $this->createCPUUrl('/user/logout/');?>">Выйти</a>
			<?php endif;?>
		</div>



		<ul class="header-main-menu">
			<?php foreach ($this->variables['mainMenuList'] AS $key => $val):?>
				<li class="
					<?php if ($val['link'] == "/delivery/") echo 'active';?> 
					<?php if (!empty($this->menuActiveItems[FController::MENU_MENU_ITEM]) && $val['link'] == "/menu/") echo 'active';?> 
					<?php if (!empty($val['submenuList'])) echo 'submenu';?>
				">
					<a 
						<?php if (strpos($val['link'], "http") !== false):?>
							target="_blank"
						<?php endif;?>
					href="
						<?php
							if (!empty($val['link'])) 
								echo $this->createCPUUrl($val['link']);
							else 
								echo "javascript: void(0);";
							
						?>
					">
						
						<?php if (!empty($this->variables['likeDishCount']) && $key == 62):?>
							<span class="like-dish-menu"><?php echo $this->variables['likeDishCount'];?></span>
						<?php endif?>
						
						<?php echo $val['name']?> 
					</a>
					<?php if (!empty($val['text'])):?>
						<div class="small-gray-text text-italic lh-12 mt-10"><?php echo $val['text']?></div> 
 					<?php endif;?>
 					
 					<?php if (!empty($val['submenuList'])):?>
						<div class="header-main-menu-submenu-block">
						<ul class="header-main-menu-submenu">
							<?php foreach ($val['submenuList'] AS $key => $val):?>
								<li>
									<a 
										<?php if (strpos($val['link'], "http") !== false):?>
											target="_blank"
										<?php endif;?>
									href="
									<?php
										if (!empty($val['link'])) 
											echo $this->createCPUUrl($val['link']);
										else 
											echo "javascript: void(0);";
										
									?>
								"><?php echo $val['name']?></a>
								</li>
							<?php endforeach;?>
						</ul>
						</div>
 					<?php endif;?>
 					
				</li>
			<?php endforeach;?>
		</ul>
		
	</div><!-- .header-->
