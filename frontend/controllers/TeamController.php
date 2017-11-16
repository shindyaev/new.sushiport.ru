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
		//------------------------
		$mess = 'test';
		Yii::log($mess, 'message', 'test');
		setcookie('test','test');	
		//-------------------------
		$this->render("index", array('workers' => $workers, 'images' => $images));
	}
	
	public function actionSubmit() {
		//$data = 'Test';//$_POST['test'];
		$restorans = 'SBS';
		
		//setcookie('Первый этап','Ок');
		
		//$mailBlank = $this->renderPartial("//mailBlank/test", array('restorans' => $restorans), true);
		
		//setcookie('Второй этап','Ок');
		
		$email = 'shindyaev.s@milimon.ru';
		
		SendMail::send($email, "Тестовое письмо", $mailBlank);
		
	}
	
}