<?php
class News2Controller extends RController
{
	public function actionIndex()
	{
		$model = new News2();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('News2', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new News2();
		}
		
		if(isset($_POST['News2'])) {
			$model->attributes=$_POST['News2'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			$model->dateStart = Yii::app()->dateFormatter->format('yyyy-MM-dd', $model->dateStart);
			
			if($model->save()) {
				if (!empty($_FILES['News2']['tmp_name']['image'])) {
				
					$model->saveImage($_FILES['News2']['tmp_name']['image'], true);
				}
				
				$this->redirect('/news2/');
			}
		}
		
		$model->dateStart = Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->dateStart);
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		$model = News2::model()->findByPk($id);
		$model->deleteFull();
		$this->redirect('/news2/');
	}
}
