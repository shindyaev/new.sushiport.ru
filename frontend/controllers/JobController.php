<?php

class JobController extends FController
{
	
	public function actionIndex()
	{
		$this->layout='/layouts/offer';
		
		$this->render("index");
	}
	
	public function actionSubmitJob() {
		$data = $_POST['job'];
		
		$mailBlank = $this->renderPartial("//mailBlank/job", array("data" => $data), true);
		$settings = new Settings();
		SendMail::send($settings->emailAdmin, "Анкета соискателя", $mailBlank);
		SendMail::send($settings->emailDirector, "Анкета соискателя", $mailBlank);
		
		echo CJSON::encode(
			array(
				'error'=>false,
			)
		);
		Yii::app()->end();
	}
	
}