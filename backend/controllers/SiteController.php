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
class SiteController extends RController
{
	public function actionIndex()
	{
/*		
		$wt = [
			0 => ['from' => '11:00', 'to' => '23:30'],
			1 => ['from' => '11:00', 'to' => '23:30'],
			2 => ['from' => '11:00', 'to' => '23:30'],
			3 => ['from' => '11:00', 'to' => '23:30'],
			4 => ['from' => '11:00', 'to' => '00:30'],
			5 => ['from' => '12:00', 'to' => '00:30'],
			6 => ['from' => '12:00', 'to' => '23:30'],
		];
*/		
		$this->render('index');
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
			$this->render('error', $error);
	}
	
	public function actionLogin() {
		
		$this->layout = '//layouts/login';
		$model = new LoginForm();
		
		/**
		 * @var CWebUser $user
		*/
		$user = Yii::app()->user;
		if (!$user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
		
			if($model->validate() && $model->login()) {
				$this->redirect('/');
			}
		}
		
		$this->render('login',array(
			'model'=>$model,
		));
		
	}
	
	public function actionBanners()
	{
		$model = new MainBanner();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('mainBanners', array('model' => $model));
	}
	
	public function actionBannerItem($id = false)
	{
		if ($id !== false)
		{
			$header = 'Редактировать';
			$model = $this->loadModel('MainBanner', $id);
				
		} else
		{
			$header = 'Добавить';
			$model = new MainBanner();
		}
	
		if(isset($_POST['MainBanner'])) {
			$model->attributes=$_POST['MainBanner'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
				
			if($model->save()) {
				if (!empty($_FILES['MainBanner']['tmp_name']['image'])) {
	
					$model->saveImage($_FILES['MainBanner']['tmp_name']['image'], true);
				}
	
				$this->redirect('/site/banners/');
			}
		}
	
		$this->render('bannerItem', array('header' => $header, 'model' => $model));
	}
	
	public function actionDeleteBanner($id) {
		$model = MainBanner::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/site/banners/');
	}
	
	public function actionChangeCity($id) {
		$city = City::model()->findByPk($id);
		if (!empty($city)) {
			Yii::app()->request->cookies['city_id'] = new CHttpCookie('city_id', $city->id, array('expire' => time() + (60*60*24)*360));
		}
	
		$this->redirect(Yii::app()->request->urlReferrer);
	}
	
	
	
	
	
	
	public function actionMainMenu($id = 0)
	{
		$currentSection = false;
		if (!empty($id))
		{
			$currentSection = $this->loadModel('MainMenu', $id);
			if($currentSection->cityId != (int)Yii::app()->request->cookies['city_id']->value) {
				$this->redirect('/site/mainMenu/');
			}
			$modelMenu = $currentSection;
 			$this->breadcrumbs = $this->buildBreadkrumbsCatalog($currentSection);
			$modelMenu->pid = $id;
// 			$modelMenu->pid = $id;
		} else {
			$this->breadcrumbs[] = 'Меню';
			$modelMenu = new MainMenu();
			$modelMenu->pid = 0;
			$modelMenu->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		}
	
		$this->render('mainMenu', array('modelMenu' => $modelMenu, 'currentSection' => $currentSection));
	}
	
	public function actionMainMenuItem($pid = 0, $id = false)
	{
		if ($id !== false)
		{
			$header = 'Редактировать раздел';
			$model = $this->loadModel('MainMenu', $id);
			$new = false;
		}
		else
		{
			$header = 'Добавить раздел';
			$model = new MainMenu();
			$new = true;
		}
	
		if(isset($_POST['MainMenu'])) {
			$model->attributes=$_POST['MainMenu'];
				
			$model->pid = $pid;
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
				
			if (!empty($pid)) {
				$parentMenu = $this->loadModel('MainMenu', $pid);
				$model->level = $parentMenu->level + 1;
			}
				
			if($model->save()) {
				if ($new) {
					$model->sort = $model->id;
					$model->save();
				}
				$this->redirect($this->createUrl('site/mainMenu', array('id' => $pid)));
			}
		}
	
		if (!empty($pid)) {
			$currentSection = $this->loadModel('MainMenu', $pid);
			$this->breadcrumbs = $this->buildBreadkrumbsCatalog($currentSection, true);
			$this->breadcrumbs[] = $header;
		} else {
			$this->breadcrumbs=array(
				'Меню' => $this->createUrl('site/mainMenu'),
				$header
			);
		}
	
		$this->render('mainMenuItem', array('header' => $header, 'model' => $model));
	}
	
	private function buildBreadkrumbsCatalog($parentSection, $lastLink = false) {
		if ($lastLink)
			$breadcrumbs[$parentSection->name] = $this->createUrl('site/mainMenu', array('id'=>$parentSection->id));
		else
			$breadcrumbs[] = $parentSection->name;
	
		while(true)
		{
			if (empty($parentSection->pid))
			{
				break;
			}
			$parentSection = $this->loadModel('MainMenu', $parentSection->pid);
			$breadcrumbs[$parentSection->name] = $this->createUrl('site/mainMenu', array('id'=>$parentSection->id));
		}
		$breadcrumbs['Главное меню'] = $this->createUrl('site/mainMenu');
		$breadcrumbs = array_reverse($breadcrumbs);
		return $breadcrumbs;
	}
	
	public function actionDeleteMainMenuItem($id) {
		$section = $this->loadModel('MainMenu', $id);
		$pid = $section->pid;
		$section->recurciveDelete();
		$this->redirect($this->createUrl('site/mainMenu', array('id' => $pid)));
	}
	
	public function actionSaveSortSection() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE mainMenu SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
			1
		);
		Yii::app()->end();
	}
	
	
	
	
	public function actionSelectMenu()
	{

		$this->breadcrumbs[] = 'Подберите меню на сегодня';
		$model = new SelectMenu();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
	
		$this->render('selectMenu', array('model' => $model));
	}
	
	public function actionSelectMenuItem($pid = 0, $id = false)
	{
		if ($id !== false)
		{
			$header = 'Редактировать';
			$model = $this->loadModel('SelectMenu', $id);
			$new = false;
		}
		else
		{
			$header = 'Добавить';
			$model = new SelectMenu();
			$new = true;
		}
	
		if(isset($_POST['SelectMenu'])) {
			$model->attributes=$_POST['SelectMenu'];
	
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
	
			if($model->save()) {
				if ($new) {
					$model->sort = $model->id;
					$model->save();
				}
				$this->redirect($this->createUrl('site/selectMenu'));
			}
		}
	
		
		$this->breadcrumbs=array(
			'Подберите меню на сегодня' => $this->createUrl('site/selectMenu'),
			$header
		);
	
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND cityId = :cityId';
		$criteria->order = "sort";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		
		$categories = Menu::model()->findAll($criteria);
		$categories = CHtml::listData($categories, 'id', 'name');
		
		$this->render('selectMenuItem', array('header' => $header, 'model' => $model, 'categories' => $categories));
	}
	
	public function actionDeleteSelectMenuItem($id) {
		$model = $this->loadModel('SelectMenu', $id);
		$model->deleteFull();
		$this->redirect($this->createUrl('site/selectMenu'));
	}
	
	public function actionSaveSortSelectMenu() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE selectMenu SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect("/site/login/");
	}
	
	public function actionSaveSortBanners() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE mainBanners SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
}
