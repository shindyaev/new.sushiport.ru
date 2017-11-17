<?php

class TeamController extends FController
{
	
	public function actionIndex()
	{
		$this->menuActiveItems[FController::TEAM_MENU_ITEM] = 1;
		
		$criteria = new CDbCriteria();
 		$criteria->condition = 'visible = 1 AND cityId = :cityId';
 		$criteria->order = "sort";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);

		$workers = Worker::model()->findAll($criteria);
		$images = TeamPhoto::model()->findAll("cityId = :cityId", array(":cityId" => (int)Yii::app()->request->cookies['city_id']->value));

		$this->render("index", array('workers' => $workers, 'images' => $images));
	}
	
}