<div class="page-sidebar nav-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->        
	<ul class="page-sidebar-menu">
		<li>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler hidden-phone"></div>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		</li>
		
		<?php if(Yii::app()->user->checkAccess('Site.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::MAIN_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::MAIN_BANNER_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::CHANGE_MENU_TODAY])
									) { echo 'active'; } ?>">
			<a href="javascript: ;">
				<i class="icon-home"></i> 
				<span class="title">Главная</span>
				<span class="selected"></span>
				<span class="arrow <?php if (!empty($this->menuActiveItems[BController::MAIN_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::MAIN_BANNER_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::CHANGE_MENU_TODAY])
									) { echo 'open'; } ?>"></span>
			</a>
			<ul class="sub-menu" <?php if (empty($this->menuActiveItems[BController::MAIN_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::MAIN_BANNER_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::CHANGE_MENU_TODAY])
									) { echo 'style="display:none;"'; } ?>>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::MAIN_MENU_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('site/mainMenu') ?>">Главное меню</a>
				</li>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::MAIN_BANNER_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('site/banners') ?>">Баннеры на главной</a>
				</li>
<!--				
				<li  class="<?php if (!empty($this->menuActiveItems[BController::CHANGE_MENU_TODAY])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('site/selectMenu') ?>">Подберите меню на сегодня</a>
				</li>
-->				
			</ul>
		</li>
		<?php endif;?>
		
		
		<?php if(Yii::app()->user->checkAccess('Menu.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::MENU_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('menu/index') ?>">
				<i class="icon-reorder"></i> 
				<span class="title">Меню</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
<!--		
		<?php if(Yii::app()->user->checkAccess('News2.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::NEWS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('news2/') ?>">
				<i class="icon-fire"></i> 
				<span class="title">Новости</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
-->		
		<?php if(Yii::app()->user->checkAccess('News.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::NEWS1_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::NEWS2_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::ACTION_DISH_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::PRESENT_MENU_ITEM])
									) { echo 'active'; } ?>">
			<a href="javascript: ;">
				<i class="icon-flag"></i>
				<span class="title">Акции</span>
				<span class="selected"></span>
				<span class="arrow <?php if (!empty($this->menuActiveItems[BController::NEWS1_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::NEWS2_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::ACTION_DISH_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::PRESENT_MENU_ITEM])
									) { echo 'open'; } ?>"></span>
			</a>
			<ul class="sub-menu" <?php if (empty($this->menuActiveItems[BController::NEWS1_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::NEWS2_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::ACTION_DISH_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::PRESENT_MENU_ITEM])
									) { echo 'style="display:none;"'; } ?>>
				<li class="<?php if (!empty($this->menuActiveItems[BController::NEWS1_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('news/1') ?>">Акции</a>
				</li>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::ACTION_DISH_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('news/dishActions') ?>">Акции на блюда</a>
				</li>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::PRESENT_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('news/presents') ?>">Подарки</a>
				</li>
			</ul>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Review.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::REVIEW_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('review/index') ?>">
				<i class="icon-book"></i>
				<span class="title">Отзывы</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Promo.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::PROMO_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('promo/index') ?>">
				<i class="icon-book"></i>
				<span class="title">Промо-коды</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Offers.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::OFFERS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('offers/index') ?>">
				<i class="icon-shopping-cart"></i>
				<span class="title">Заказы</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
<!--		
		<?php if(Yii::app()->user->checkAccess('Team.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::TEAM_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::TEAM2_MENU_ITEM])
									) { echo 'active'; } ?>">
			<a href="javascript: ;">
				<i class="icon-group"></i> 
				<span class="title">Наша команда</span>
				<span class="selected"></span>
				<span class="arrow <?php if (!empty($this->menuActiveItems[BController::TEAM_MENU_ITEM])
											|| !empty($this->menuActiveItems[BController::TEAM2_MENU_ITEM])
									) { echo 'open'; } ?>"></span>
			</a>
			<ul class="sub-menu" <?php if (empty($this->menuActiveItems[BController::TEAM_MENU_ITEM])
											&& empty($this->menuActiveItems[BController::TEAM2_MENU_ITEM])
									) { echo 'style="display:none;"'; } ?>>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::TEAM_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('team/workers') ?>">Сотрудники</a>
				</li>
				<li  class="<?php if (!empty($this->menuActiveItems[BController::TEAM2_MENU_ITEM])) { echo 'active'; } ?>">
					<a href="<?php echo $this->createUrl('team/photo') ?>">Галлерея</a>
				</li>
			</ul>
		</li>
		<?php endif;?>
-->		
		<?php if(Yii::app()->user->checkAccess('Restorans.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::RESTORANS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('restorans/index') ?>">
				<i class="icon-sitemap"></i>
				<span class="title">Рестораны</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>


		<?php if(Yii::app()->user->checkAccess('City.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::CITY_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('city/index') ?>">
				<i class="icon-sitemap"></i>
				<span class="title">Города</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Pages.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::PAGES_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('pages/index') ?>">
				<i class="icon-text-height"></i>
				<span class="title">Текстовые страницы</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
<!--		
		<?php if(Yii::app()->user->checkAccess('Mobile.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::MOBILE_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('mobile/index') ?>">
				<i class="icon-apple"></i>
				<span class="title">Мобильные приложения</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
-->		
		<?php if(Yii::app()->user->checkAccess('Settings.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::SETTINGS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('settings/index') ?>">
				<i class="icon-wrench"></i>
				<span class="title">Настройки</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>

		<?php if(Yii::app()->user->checkAccess('Seo.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::SEO_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('seo/index') ?>">
				<i class="icon-apple"></i>
				<span class="title">SEO</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		<?php if(Yii::app()->user->checkAccess('Zones.*')): ?>
			<li class="start <?php if (!empty($this->menuActiveItems[BController::SETTINGS_ZONE_MENU_ITEM])) { echo 'active'; } ?>">
				<a href="<?php echo $this->createUrl('zones/index') ?>">
					<i class="icon-wrench"></i>
					<span class="title">Зоны доставки</span>
					<span class="selected"></span>
				</a>
			</li>
		<?php endif;?>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
