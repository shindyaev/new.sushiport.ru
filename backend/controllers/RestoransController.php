<?php
class RestoransController extends RController
{
	public function actionIndex()
	{
		$model = new Restoran();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		//$id = 1;
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Restoran', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Restoran();
		}
		
		$modelImage = false;
		if (!empty($model->id)) {
			$modelImage = new RestoranPhoto();
			$modelImage->restoranId = $model->id;
		}
		
		if(isset($_FILES['RestoranPhoto'])) {
			if($modelImage->save()) {
				if (!empty($_FILES['RestoranPhoto']['tmp_name']['image'])) {
					$modelImage->saveImage($_FILES['RestoranPhoto']['tmp_name']['image'], true);
				}
					
				$this->redirect($this->createUrl('restorans/item', array('id' => $model->id)));
			}
		}
		
		if(isset($_POST['Restoran'])) {
			
			if (!empty($_FILES['Restoran']['tmp_name']['image'])) {
				$model->saveImage($_FILES['Restoran']['tmp_name']['image'], true);
			}
			
			$model->attributes=$_POST['Restoran'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			
			$model->save();
			$this->redirect($this->createUrl('restorans/index'));
		}
		
		$menus = Menu::model()->findAll('pid = 0');
		$menus = CHtml::listData($menus, 'id', 'name');

		$cities = City::model()->findAll();
		$cities = CHtml::listData($cities, 'id', 'name');

		
		$this->render('item', array('header' => $header, 'model' => $model, 'modelImage' => $modelImage, 'menus' => $menus, 'cities' => $cities));
	}
	
	public function actionDelete($id) {
		$model = Restoran::model()->findByPk($id);
		$model->deleteFull();
		
		$this->redirect($this->createUrl('restorans/index'));
	}
	
	public function actionDeleteRestoranImage () {
		if (isset($_POST['id'])) {
			$model = RestoranPhoto::model()->findByPk($_POST['id']);
			$model->deleteFull();
		}
	}
	
	public function actionSaveSortRest() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE restorans SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
}
