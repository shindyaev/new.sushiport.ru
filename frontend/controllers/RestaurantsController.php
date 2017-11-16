<?php

class RestaurantsController extends FController
{
	public function actions()
	{
	  return array(
		'captcha'=>array(
		'class'=>'CCaptchaAction',
		'width'=>'110',
		'height'=>'40',
		'maxLength' => 5,
		'minLength' => 4,
		'testLimit'=> 1,
		),
	  );
	}
	
	public function actionIndex($id = 60)
	{
		$this->createAction('captcha')->getVerifyCode(true);
		$model = MainMenu::model()->findByPk($id);
		$this->variables['title'] = $model->title;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;

		$restorans = Restoran::model()->findAll();
		
		$model = new WriteUsForm();
		
		if(isset($_POST['WriteUsForm'])) {
			$model->attributes=$_POST['WriteUsForm'];

			$this->performAjaxValidation($model);
			
			
			$mailBlank = $this->renderPartial('//mailBlank/writeUs', ['data' => $model], true);
			
			$settings = new Settings();
			SendMail::send($settings->emailAdmin, "Сообщение с сайта Доставки Milimon", $mailBlank);
			
			echo CJSON::encode(
				1
			);
			Yii::app()->end();
		}
		
		$this->render("index", ['restorans' => $restorans, 'model' => $model]);
	}
	
}
