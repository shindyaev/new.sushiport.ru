<div class="page-sidebar nav-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->        
	<ul class="page-sidebar-menu">
		<li>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler hidden-phone"></div>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		</li>
		
		<?php if(Yii::app()->user->checkAccess('Site.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::DESKTOP_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('site/index') ?>">
				<i class="icon-home"></i> 
				<span class="title">Главная</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Banners.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::BANNERS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('banners/index') ?>">
				<i class="icon-asterisk"></i> 
				<span class="title">Баннеры</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('BigProducts.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::BIGPRODUCTS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('bigProducts/index') ?>">
				<i class=" icon-heart"></i> 
				<span class="title">Товары по бокам</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('Catalog.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::CATALOG_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('catalog/index') ?>">
				<i class="icon-reorder"></i> 
				<span class="title">Меню</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
		
		<?php if(Yii::app()->user->checkAccess('News.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::NEWS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('news/') ?>">
				<i class="icon-fire"></i> 
				<span class="title">Страницы</span>
				<span class="selected"></span>
			</a>
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
		
		<?php if(Yii::app()->user->checkAccess('Settings.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::SETTINGS_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('settings/index') ?>">
				<i class="icon-wrench"></i>
				<span class="title">Настройки</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
<!-- 		
		<?php if(Yii::app()->user->checkAccess('Seo.*')): ?>
		<li class="start <?php if (!empty($this->menuActiveItems[BController::SEO_MENU_ITEM])) { echo 'active'; } ?>">
			<a href="<?php echo $this->createUrl('seo/index') ?>">
				<i class="icon-asterisk"></i> 
				<span class="title">SEO</span>
				<span class="selected"></span>
			</a>
		</li>
		<?php endif;?>
 -->
		
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
