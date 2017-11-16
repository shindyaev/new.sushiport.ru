<?php

class NewsController extends FController
{
	
	
	public function actionIndex()
	{
		$this->menuActiveItems[FController::NEWS_MENU_ITEM] = 1;
		
		$criteria = new CDbCriteria();
 		$criteria->condition = 'visible = 1 AND dateStart <= NOW() AND cityId = :cityId';
 		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
 		$criteria->order = "dateStart DESC";

		$news = News2::model()->findAll($criteria);
		
		$this->render("index", array('news' => $news));
	}
	
}