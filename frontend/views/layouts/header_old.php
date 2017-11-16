<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<!-- DC Mobile Landing -->
<script type="text/javascript">!function(e,n,o,r,t,c){var i,p,a,d,s,l=[];
c.length&&l.push("pa="+encodeURIComponent(c)),n.referrer.length&&l.push
("r="+encodeURIComponent(n.referrer)),n.cookie.indexOf(t)>-1&&
(i=n.cookie.split(t+"="),p=1,2===i.length&&(p=i.pop().split(";").shift()),
l.push("c="+encodeURIComponent(p))),a="",l.length&&(a="?"+l.join("&")),
d=n.createElement(o),d.src=r+a,d.async=!0,s=n.getElementsByTagName(o)[0],
s.parentNode.insertBefore(d,s)}(window,document,"script",
"//www.delivery-club.ru/landing.js","dc_l_s",
"undefined"==typeof dc_magic_param?"":dc_magic_param);</script>
<!-- /DC Mobile Landing -->

	<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title></title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />

    <meta name="apple-itunes-app" content="app-id=765543132">
    <meta name="google-play-app" content="app-id=pro.gildiya.gedza">

	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700italic,400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/css/style.css" type="text/css" />
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/selectric.css" type="text/css" />
    <link rel="stylesheet" href="/css/jquery.smartbanner.css" type="text/css" />
    <link rel="stylesheet" href="/css/lightbox.css" type="text/css" />
	
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
</head>

<body>

<div class="cart-fixed-container">
	<div class="cart-fixed-container-2">
		<div class="cart" id="cart">
			<div class="cart-headline">Корзина</div>
			
			<div class="cart-text mt-15">

				<span data-bind="text: totalCount"></span> 
				<span data-bind="text: totalCountText"></span> 
				<span data-bind="text: totalPriceRZ"></span><span class="rouble-font nobolder">a</span>
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
				<div class="order-button"></div>
			</a>
		</div>
	</div>
</div>

<div class="wrapper">


	<div class="header-text-line bolder">
		<a href="/pages/22/" class="no-underline"><span class="red-text">ГАРАНТИЯ</span> ВОЗВРАТА</a> <span class="header-text-line-sep">|</span> <span class="red-text">БЕСПЛАТНАЯ</span> ДОСТАВКА <span class="header-text-line-sep">|</span> <span class="red-text">БЫСТРАЯ</span> ДОСТАВКА
	</div>
	
	<div class="header">
	
		<a href="/" class="logo">
			<img src="/img/gedza_delivery_logo.svg">
		</a>
		
		<div class="logo-text">			
		</div>
		
		<div class="head-phone-container">
			<div class="head-phone-container-text">Закажите по телефону</div>
			<div class="head-phone-container-phone">
				<?php if ($this->variables['city-id'] == 1):?>
					<span class="ya-phone">
						<?php echo $this->variables['phone'];?>
					</span>
				<?php else:?>
					<?php echo $this->variables['phone'];?>
				<?php endif;?>
			</div>
			<div class="head-call-me-button" data-toggle="modal" data-target="#call-me-modal">Перезвоните мне</div>
		</div>
		
	</div><!-- .header-->
	
	<div class="city-head-menu">
		
		<div class="city-change-city-head-menu mr-20">
			<a><?php echo $this->variables['city']?></a>
			<ul class="change-city-list">
				<?php foreach ($this->variables['citys'] AS $key => $val):?>
					<li><a href="/site/changeCity/<?php echo $key;?>/"><?php echo $val?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		
		<div class="pull-left fs-12 mt-10">
			<div class="bolder" data-toggle="modal" data-target="#city-modal">Нужна помощь?</div>
			<div>Круглосуточный <a href="http://hello.gedza.ru" target="_blank">центр помощи</a> клиентам GEDZA.</div>
		</div>
		
		<?php if (Yii::app()->user->isGuest) :?>
			<div class="first-bonus-text-city-head-menu"><!-- – Получите 200 рублей в счет первого заказа! --></div>
			
			<div class="reg-href-cont">
				<a href="<?php echo $this->createCPUUrl('/user/registration/');?>">Регистрация</a>
			</div>
			
			<div class="login-href-cont">
				<a href="<?php echo $this->createCPUUrl('/user/login/');?>">Вход</a>
			</div>
		<?php else:?>
		
			<div class="auth-user-head">
				<a href="<?php echo $this->createCPUUrl('/user/offers/');?>"><?php echo Yii::app()->user->name?></a>
				|
				<a href="<?php echo $this->createCPUUrl('/user/logout/');?>">Выход</a></li>
			</div>
			
			
		<?php endif;?>
	
	</div>
	
	<div class="main-menu">
		<ul>
		
			<?php foreach ($this->variables['mainMenuList'] AS $key => $val):?>
			<li class="main-menu-item <?php echo $val['active']?> 
				<?php if (!empty($this->menuActiveItems[FController::MENU_MENU_ITEM]) && $val['link'] == "/menu/") echo 'active';?>
				">
				<a href="<?php
					if (!empty($val['link'])) 
						echo $this->createCPUUrl($val['link']);
					else 
						echo "javascript: void(0);";
					
				?>""><?php echo $val['name']?></a>
				
				<?php if (!empty($val['submenuList'])):?>
					<ul class="main-submenu">
					<?php foreach ($val['submenuList'] AS $k => $v):?>
							<li><a href="<?php echo $this->createCPUUrl($v['link']);?>"><?php echo $v['name']?></a></li>
					<?php endforeach;?>
					</ul>
				<?php endif;?>
				
			</li>
			<?php endforeach;?>
			
		</ul>
	</div>
