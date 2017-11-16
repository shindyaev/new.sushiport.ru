<?php
/**
 *
 * SiteController class
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
 //Отправка в MailChimp не удалять
 //include('/home/admin/web/smr.milimon.ru/mil/frontend/www/mailchimp/MailChimp.php'); 
  //use \DrewM\MailChimp\MailChimp;
  
 
 
class SiteController extends FController
{

	public function actionIndex()
	{
		
		$banners = MainBanner::model()->findAll(['condition' => "cityId = :cityId AND visible = 1", 'params' => array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value), 'order' => 'sort']);
		
		$criteria = new CDbCriteria();
 		$criteria->condition = 'visible = 1 AND dateStart <= NOW() AND cityId = :cityId';
 		$criteria->order = "dateStart DESC";
 		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
 		$criteria->limit = 3;

		$actions = News::model()->findAll($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND cityId = :cityId';
		$criteria->order = "RAND()";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		$criteria->limit = 3;
		
		$reviews = Review::model()->findAll($criteria);
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND cityId = :cityId AND popular = 1';
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		$criteria->limit = 4;
		
		$categories = Menu::model()->findAll($criteria);
		
// 		$criteria = new CDbCriteria();
// 		$criteria->condition = 'cityId = :cityId';
// 		$criteria->order = "sort";
// 		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
// 		$criteria->limit = 4;
		
// 		$selectMenu = SelectMenu::model()->findAll($criteria);
		
		
		
		$criteria = new CDbCriteria();
		$criteria->order = "sort";
		$criteria->limit = 4;
		$criteria->condition = 'visible = 1';
		
		$restorans = Restoran::model()->findAll($criteria);
		
		$this->render('index', array(	'banners' => $banners, 
										'actions' => $actions, 
										'reviews' => $reviews, 
										'categories' => $categories, 
// 										'selectMenu' => $selectMenu, 
										'restorans' => $restorans));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		
// 		Yii::app()->request->redirect('/', true, 301);
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionChangeCity($id) {
		$city = City::model()->findByPk($id);
		if (!empty($city)) {
			Yii::app()->request->cookies['city_id'] = new CHttpCookie('city_id', $city->id, array('expire' => time() + (60*60*24)*360));
		}
	
		$this->redirect(Yii::app()->request->urlReferrer);
	}
	
	public function actionAddEmail() {
		
		$model = new Email();
		if(isset($_POST['Email'])) {
		
			//Отправка в MailChimp не удалять
//			$MailChimp = new MailChimp('401ff06fb56dd9f02933d7cfe96d072c-us10');
//			$list_id = '1a018c60f3';
//			$chimpMail = $_POST['Email'];
//			$result = $MailChimp->post("lists/$list_id/members", [
//				'email_address' => $chimpMail['email'],
//			    'merge_fields'    => array('FNAME'=> 'DeliveryForm', 'LNAME'=>''),
//			    'status'        => 'subscribed',
//			]);
			
			$model->attributes=$_POST['Email'];
			$this->performAjaxValidation($model);
			if($model->save()) {
				$err = false;
			} else {
				$err = true;
			}
		}
		
		echo CJSON::encode(
			array(
				'error'=>$err,
			)
		);
		Yii::app()->end();
	}
	
	public function actionWriteUs() {
	
		$err = true;
		$model = new Write();
		if(isset($_POST['Write'])) {
		
			$model->attributes=$_POST['Write'];
			$this->performAjaxValidation($model);
			
			$mailBlank = $this->renderPartial("//mailBlank/writeUs", array("data" => $model), true);
			
			$settings = new Settings();
				
			SendMail::send($settings->emailAdmin, "Сообщение", $mailBlank);
			$err = false;
		}
		
		echo CJSON::encode(
			array(
				'error'=>$err,
			)
		);
		Yii::app()->end();
	}
	
	public function actionCallMe() {
	
		$err = true;
		$model = new CallMe();
		if(isset($_POST['CallMe'])) {
			$model->attributes=$_POST['CallMe'];
			$this->performAjaxValidation($model);
				
			$mailBlank = $this->renderPartial("//mailBlank/callMe", array("data" => $model), true);

			$settings = new Settings();
	
			SendMail::send($settings->emailAdmin, "Обратный звонок", $mailBlank);
			$err = false;
		}
	
		echo CJSON::encode(
			array(
				'error'=>$err,
			)
		);
		Yii::app()->end();
	}
}
