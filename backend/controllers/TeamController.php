<?php
class TeamController extends RController
{
	public function actionWorkers()
	{
		$model = new Worker();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		
		$this->render('workers', array('model' => $model));
	}
	
	public function actionWorker($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Worker', $id);
			$first = false;
		} else  
		{
			$header = 'Добавить';
			$model = new Worker();
			$first = true;
		}
		
		if(isset($_POST['Worker'])) {
			$model->attributes=$_POST['Worker'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			
			if($model->save()) {
				if ($first) {
					$model->sort = $model->id;
					$model->save();
				}
				if (!empty($_FILES['Worker']['tmp_name']['image'])) {
				
					$model->saveImage($_FILES['Worker']['tmp_name']['image']);
				}
				
				$this->redirect('/team/workers/');
			}
		}
		
		$this->render('worker', array('header' => $header, 'model' => $model));
	}
	
	public function actionDeleteWorker($id) {
		$model = Worker::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/team/workers/');
	}
	
	public function actionPhoto() {
		$model = new TeamPhoto();
		
		if(isset($_FILES['TeamPhoto'])) {
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			if($model->save()) {
				if (!empty($_FILES['TeamPhoto']['tmp_name']['image'])) {
					$model->saveImage($_FILES['TeamPhoto']['tmp_name']['image'], true);
				}
					
				$this->redirect($this->createUrl('team/photo'));
			}
		}
			
		$images = TeamPhoto::model()->findAll("cityId = :cityId", array(":cityId" => (int)Yii::app()->request->cookies['city_id']->value));
		
		$this->render('teamPhoto', array('images' => $images, 'model' => $model));
	}
	
	public function actionSaveSortWorkers() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE workers SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
	public function actionDeleteImage() {
		$id = $_POST['id'];
		$galleryImage = $this->loadModel('TeamPhoto', $id);
		$galleryImage->deleteFull();
	}
}
