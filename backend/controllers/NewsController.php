<?php
class NewsController extends RController
{
	public function actionView($id = 0)
	{
		$model = new News();
		if (!empty($id))
			$model->pid = $id;
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($pid, $id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('News', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new News();
			$model->pid = $pid;
		}
		
		if(isset($_POST['News'])) {
			$model->attributes=$_POST['News'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			$model->dateStart = Yii::app()->dateFormatter->format('yyyy-MM-dd', $model->dateStart);
			$model->dateEnd = Yii::app()->dateFormatter->format('yyyy-MM-dd', $model->dateEnd);
			
			if($model->save()) {
				if (!empty($_FILES['News']['tmp_name']['image'])) {
				
					$model->saveImage($_FILES['News']['tmp_name']['image'], true);
				}
				
				$this->redirect('/news/'.$model->pid.'/');
			}
		}
		$model->dateStart = Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->dateStart);
		$model->dateEnd = Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->dateEnd);
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		$model = News::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/news/'.$model->pid.'/');
	}
	
	public function actionDishActions() {
		$model = new DishAction();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('dishActions', array('model' => $model));
	}
	
	public function actionDishAction($id = false)
	{
		if ($id !== false)
		{
			$header = 'Редактировать';
			$model = $this->loadModel('DishAction', $id);
		} else
		{
			$header = 'Добавить';
			$model = new DishAction();
		}
		if(isset($_POST['DishAction'])) {
			$model->attributes=$_POST['DishAction'];
			$this->performAjaxValidation($model);
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			$model->dateEnd = Yii::app()->dateFormatter->format('yyyy-MM-dd', $model->dateEnd);
				
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
		
		$restorans = Menu::model()->findAll("visible = 1 AND pid = 0 AND cityId = :cityId", array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$restoranId = $restorans[0]->id;
		$restorans = CHtml::listData($restorans, 'id', 'name');
		
		if (!empty($model->restoranId))
			$restoranId = $model->restoranId;

		$categorys = Menu::model()->findAll("visible = 1 AND pid = :pid AND cityId = :cityId", array(':pid' => $restoranId , ':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$categoryId = $categorys[0]->id;
		$categorys = CHtml::listData($categorys, 'id', 'name');
	
		if (!empty($model->categoryId))
			$categoryId = $model->categoryId;
	
		$dishs = Dish::model()->findAll('visible = 1 AND pid = :pid AND cityId = :cityId', array(':pid' => $categoryId, ':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$dishs = CHtml::listData($dishs, 'id', 'name');
		
		$model->dateEnd = Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->dateEnd);
		
		$this->render('dishAction', array('header' => $header, 'model' => $model, 'restorans' => $restorans, 'categorys' => $categorys, 'dishs' => $dishs));
	}
	
	public function actionDeleteDishAction($id) {
		$model = DishAction::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/news/dishActions/');
	}
	
	
	public function actionPresents() {
		$model = new Present();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('presents', array('model' => $model));
	}
	
	public function actionPresent($id = false)
	{
		if ($id !== false)
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Present', $id);
		} else
		{
			$header = 'Добавить';
			$model = new Present();
		}
		if(isset($_POST['Present'])) {
			$model->attributes=$_POST['Present'];
			$this->performAjaxValidation($model);
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
	
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
	
		$restorans = Menu::model()->findAll("visible = 1 AND pid = 0 AND cityId = :cityId", array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$restoranId = $restorans[0]->id;
		$restorans = CHtml::listData($restorans, 'id', 'name');
		
		if (!empty($model->restoranId))
			$restoranId = $model->restoranId;

		$categorys = Menu::model()->findAll("visible = 1 AND pid = :pid AND cityId = :cityId", array(':pid' => $restoranId , ':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$categoryId = $categorys[0]->id;
		$categorys = CHtml::listData($categorys, 'id', 'name');
	
		if (!empty($model->categoryId))
			$categoryId = $model->categoryId;
	
		$dishs = Dish::model()->findAll('visible = 1 AND pid = :pid AND cityId = :cityId', array(':pid' => $categoryId, ':cityId' => (int)Yii::app()->request->cookies['city_id']->value));
		$dishs = CHtml::listData($dishs, 'id', 'name');
	
		$this->render('present', array('header' => $header, 'model' => $model, 'restorans' => $restorans, 'categorys' => $categorys, 'dishs' => $dishs));
	}
	
	public function actionDeletePresent($id) {
		$model = Present::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/news/presents/');
	}
	
	
	
	public function actionGetDishes() {
		$data = Dish::model()->findAll('visible = 1 AND pid= :pid', array(':pid' => (int)$_POST['categoryId']));
		$data = CHtml::listData($data, 'id', 'name');
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
		}
	}
	
	public function actionGetCategories() {
		$data = Menu::model()->findAll('visible = 1 AND pid= :pid', array(':pid' => (int)$_POST['restoranId']));
		$data = CHtml::listData($data, 'id', 'name');
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
		}
	}
}
