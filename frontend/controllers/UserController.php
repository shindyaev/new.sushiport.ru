<?php
/**
 *
 * UserController class
 *
 */
class UserController extends FController
{

	protected function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
			
			$this->layout='/layouts/offer';
			
			$tmp = Menu::model()->findAll('pid = 0 AND visible = 1');
			$rests = [];
			$rests[0] = clone($tmp[0]);

			$rests[0]->name = 'Все блюда';
			$rests[0]->id = 0;
			
			foreach($tmp AS $key => $val) {
				$rests[$val['id']] = $val;
			}
			
			$this->variables['rests'] = $rests;
			
			
			return true;
		}
		return false;
	}
	
	public function actionIndex($id)
	{
		$this->render('index');
	}
	
	public function actionView($id)
	{
		$model = User::model()->findByPk($id);
		$this->render('view', array('model' => $model));
	}
	
	public function actionRegistration()
	{
		
		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$model = new User();
		
		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			$this->performAjaxValidation($model);

			//убрал подтверждение почты.
			$model->password = $model->confirmPassword = crypt($model->password, $model->getSoult($model->password));
			$model->active = 1;

			if (!empty($_POST['User']['mailer'])) {
				$model->mailerAction = 1;
				$model->mailerNews = 1;
				$model->mailerNewMenu = 1;
			}

			if($model->save()) {
//				$this->redirect(array('user/registrationDone/'));
				$mailBlank = $this->renderPartial("//mailBlank/registration", array("model" => $model), true);
				SendMail::send($model->email, "Успешная регистрация на Milimon.ru", $mailBlank);
				
				$err = false;
			} else {
				$err = true;
			}

			if(!$err) {
				$token = $this->sailplayBehavior->getToken();
				$userInfo = $this->sailplayBehavior->getUserInfo($token, $model);
				if (!$userInfo || $userInfo['status'] == SailplayBehavior::STATUS_ERROR) {
					$this->sailplayBehavior->addUser($token, $model);
				}
				$this->sailplayBehavior->updateUserInfo($token, $model);
			}

			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);

			Yii::app()->end();
		}
		
		$this->render('registration', array('model' => $model));
	}
	
	public function actionRegistrationDone($hash = false)
	{
		if (!empty($hash)) {
			$user = User::model()->find(User::model()->getSqlSoult()."= :hash", array(':hash' => $hash));
			$user->active = 1;
			$user->save(false);
			$this->render('registrationActivate');
			
		} else {
			$this->render('login', array('model' => new LoginForm(), 'registration_done' => true));
		}
	}
	
	public function actionLogin() {
		$model = new LoginForm();
		
		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			$_SESSION['login-email'] = $_POST['LoginForm']['email'];
		
			if($model->validate() && $model->login()) {
				$this->redirect('/user/likeDish/');
			}
		}
		
		$this->render('login', array('model' => $model));
	}
	
	public function smallLoginForm() {
		return $this->renderPartial('smallLoginForm',false,true);
	}
	
	public function actionEdit()
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
	
		$model = User::model()->findByPk(Yii::app()->user->id);

		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			$this->performAjaxValidation($model);
			
			if (empty($model->password)) {
				unset($model->password);
			} else {
				$model->password = $model->confirmPassword = crypt($model->password, $model->getSoult($model->password));
			}
			
// 			$model->bdate = $_POST['User']['byear']."-".$_POST['User']['bmonth']."-".$_POST['User']['bday'];
				
			if($model->save()) {
				$err = false;
			} else {
				$err = true;
			}
			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);
			Yii::app()->end();
		}
		
		$model->password = "";
	
		$this->render('edit', array('model' => $model));
	}
	
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect('/user/login');
	}
	
	public function actionRecovery() {
		$model = new RecoveryForm();

		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		if(isset($_POST['RecoveryForm']))
		{
			$model->attributes=$_POST['RecoveryForm'];
			$this->performAjaxValidation($model);
			
			$user = User::model()->find("email = :email", array(':email' => $model->email));
			$hash = md5($user->getActivateSoult($user->email).strtotime("NOW"));
			$user->recoveryHash = $hash;
			$user->recoveryDate = date("Y-m-d H:i:s");
			$user->save(false);
			
			$mailBlank = $this->renderPartial("//mailBlank/recovery", array("hash" => $hash), true);
			SendMail::send($model->email, "Восстановление пароля", $mailBlank);
			
			echo CJSON::encode(
				array()
			);
			Yii::app()->end();
		}

		$login_email = '';
		if (!empty($_SESSION['login-email'])) {
			$login_email = $_SESSION['login-email'];
			$_SESSION['login-email'] = '';
			$model->email = $login_email;
		}

		$this->render('recovery', array('model' => $model, 'login_email' => $login_email));
	}
	
	public function actionRecoveryDone($hash) {
		$model = User::model()->find("recoveryHash = :hash AND recoveryDate >= :date", array(':hash' => $hash, ':date' => date("Y-m-d H:i:s", strtotime("-24 hour"))));
		
		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			$this->performAjaxValidation($model);
				
			$model->password = $model->confirmPassword = crypt($model->password, $model->getSoult($model->password));
			
			$model->recoveryDate = "0000-00-00 00:00:00";
			$model->recoveryHash = "";
		
			if($model->save()) {
				$err = false;
			} else {
				$err = true;
			}
			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);
			Yii::app()->end();
		}
		if (!empty($model))
			$model->password = "";
		
		$this->render('recoveryDone', array('model' => $model));
	}
	
	public function actionAddr() {

		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$model = new UserAddr();
		$model->userId = $model->userId = Yii::app()->user->id;
		
		if(isset($_POST['UserAddr'])) {
			$model->attributes=$_POST['UserAddr'];
			$this->performAjaxValidation($model);
			
			if($model->save()) {
				$err = false;
			} else {
				$err = true;
			}
			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);
			Yii::app()->end();			
		}
		
		$this->render('addr', array('model' => $model));
	}
	
	public function actionDeleteAddr($id) {
		UserAddr::model()->deleteAll('userId = :userId AND id = :id', array(':userId' => Yii::app()->user->id, ':id' => $id));

		$this->redirect($this->createUrl('user/addr'));
	}
	
	public function actionMailer() {
	
		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
	
		$model = User::model()->findByPk(Yii::app()->user->id);
		unset($model->password);
	
		if(isset($_POST['User'])) {
			$model->attributes=$_POST['User'];
			$this->performAjaxValidation($model);
				
			if($model->save()) {
				$err = false;
			} else {
				$err = true;
			}
			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);
			Yii::app()->end();
		}
	
		$this->render('mailer', array('model' => $model));
	}
	
	public function actionOffers($id = false) {
		
		if (empty($id)) {
			$criteria = new CDbCriteria();
			$criteria->condition = "userId = :userId";
			$criteria->params = array(':userId' => Yii::app()->user->id);
			$criteria->order = 'id DESC';
			$offers = Offer::model()->findAll($criteria);
		
			$this->render('offers', array('offers' => $offers));
		} else {
			$model = Offer::model()->findByPk($id);
			
			if (empty($model) || $model->userId != Yii::app()->user->id)
				$this->redirect($this->createUrl("user/offers"));
			
			$dishes = OffersDishes::model()->findAll('idOffer = :idOffer', array(':idOffer' => $id));
			
			$this->render('offer', array('model' => $model, 'dishes' => $dishes));
		}
	}
	
	public function actionLikeDish($id = 0) {
		if (Yii::app()->user->isGuest) {
			$this->redirect('/user/login/');
		}
		$dishList = array();
		
		$likeDish = LikeDish::model()->findAll('userId = :userId', array(':userId' => Yii::app()->user->id));
		if (!empty($likeDish)) {
			$likeDish = CHtml::listData($likeDish, 'dishId', 'dishId');
			$dishList = Dish::model()->findAll('visible = 1 AND cityId = :cityId AND id IN ('.implode(",", $likeDish).')', array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
			
			foreach($dishList AS $key => $val) {
				if ($val['rest'] != $id && $id > 0)
					unset($dishList[$key]);
			}
		}
		
		$this->render('likeDish', array('dishList' => $dishList, 'likeDish' => $likeDish, 'id' => $id));
	}
	
}
