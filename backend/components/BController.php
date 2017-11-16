<?php
/**
 * BController class
 */
class BController extends EController
{
	const DESKTOP_MENU_ITEM = "desktop";
	const SETTINGS_MENU_ITEM = "settings";
	const SETTINGS_ZONE_MENU_ITEM = "settingsZone";
	const SEO_MENU_ITEM = "seo";
	const MENU_MENU_ITEM = "menu";
	const NEWS_MENU_ITEM = "news";
	const NEWS1_MENU_ITEM = "news1";
	const NEWS2_MENU_ITEM = "news2";
	const REVIEW_MENU_ITEM = "review";
	const ABOUT_MENU_ITEM = "about";
	const ABOUT_FILIAL1_MENU_ITEM = "aboutFilial1";
	const ABOUT_FILIAL2_MENU_ITEM = "aboutFilial2";
	const MAIN_MENU_ITEM = "main";
	const MAIN_BANNER_MENU_ITEM = "mainBanner";
	const OFFERS_MENU_ITEM = "offers";
	const STATISTIC_MARKET_MENU_ITEM = "statisticMarket";
	const STATISTIC_VISIT_MENU_ITEM = "statisticVisit";
	const MAILER_MENU_ITEM = "mailer";
	const TEAM_MENU_ITEM = "team1";
	const TEAM2_MENU_ITEM = "team2";
	const PAGES_MENU_ITEM = "pages";
	const ACTION_DISH_MENU_ITEM = 'actionDish';
	const PRESENT_MENU_ITEM = 'price';
	const MAIN_MENU_MENU_ITEM = 'mainMenu';
	const MOBILE_MENU_ITEM = 'mobile';
	const CHANGE_MENU_TODAY = 'menuToday';
	const RESTORANS_MENU_ITEM = 'restorans';
	const PROMO_MENU_ITEM = 'promo';

	
	
	
	public $breadcrumbs;
	public $breadcrumbs_button;
	public $menuActiveItems = array();
	public $title_h3;
	
	public $variables = array();

	protected function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
				
			$citys = City::model()->findAll();
			$firstCity = $citys[0];
			$citys = CHtml::listData($citys, 'id', 'name');
			$this->variables['citys'] = $citys;
			
// 			if (!empty(Yii::app()->request->cookies['city_id']))
// 				$city_id = (int)Yii::app()->request->cookies['city_id']->value;
			
			if (!empty($city_id)) {
				$this->variables['city'] = $citys[$city_id];
			} else {
				$this->variables['city'] = $firstCity->name;
				Yii::app()->request->cookies['city_id'] = new CHttpCookie('city_id', $firstCity->id, array('expire' => time() + (60*60*24)*360));
			}				
				
			return true;
		}
		return false;
	}
}
