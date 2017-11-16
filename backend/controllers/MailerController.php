<?php
class MailerController extends RController
{
	public function actionIndex($id = 0)
	{
		$model = new Mailer();

		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Mailer', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Mailer();
		}
		
		if(isset($_POST['Mailer'])) {
			$model->attributes=$_POST['Mailer'];
			
			if ($model->status == 1) {
				$model->date = date('Y-m-d H:i:s');
			}
			
			if($model->save()) {
				if ($model->status == 1) {
					$this->sendMailer($model->id);
				}
				
				$this->redirect('/mailer/');
			}
		}
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		$model = Mailer::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/mailer/');
	}
	
	public function sendMailer($id) {
		$mailer = Mailer::model()->findByPk($id);

		if ($mailer->type == 1)
			$users = User::model()->findAll('mailerAction = 1');
		if ($mailer->type == 2)
			$users = User::model()->findAll('mailerNews = 1');
		if ($mailer->type == 3)
			$users = User::model()->findAll('mailerNewMenu = 1');
		
		$mailer->blank = str_replace('<img', '<img style="max-width: 730px;"', $mailer->blank);
		
		$mailBlank = $this->renderPartial("//mailBlank/mailer", array("mailer" => $mailer), true);
		$mailBlank = str_replace('src="', 'src="http://wasabisamara.ru', $mailBlank);

		if (!empty($users)) {
			foreach ($users AS $key => $val) {
				SendMail::send($val->email, "Рассылка", $mailBlank);
			}
		}
		
	}
	
	public function actionPreview($id = false) {
		$mailer = Mailer::model()->findByPk($id);
		
		$mailer->blank = str_replace('<img', '<img style="max-width: 730px;"', $mailer->blank);
		
		$mailBlank = $this->renderPartial("//mailBlank/mailer", array("mailer" => $mailer), true);
		$mailBlank = str_replace('src="', 'src="http://wasabisamara.ru', $mailBlank);
		
		echo $mailBlank;
		Yii::app()->end();
	}
}
