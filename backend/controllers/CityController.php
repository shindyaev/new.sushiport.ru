<?php

class CityController extends BController
{
	public function actionIndex()
	{
		$model = new City();
		$this->render('index', array('model' => $model));
	}

	public function actionItem($id = false)
	{
		//$id = 1;
		if ($id !== false)
		{
			$header = 'Редактировать';
			$model = $this->loadModel('City', $id);
		} else
		{
			$header = 'Добавить';
			$model = new City();
		}

		if(isset($_POST['City'])) {

			$model->attributes=$_POST['City'];
			#$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;

			$model->save();
			$this->redirect($this->createUrl('city/index'));
		}

		$menus = Menu::model()->findAll('pid = 0');
		$menus = CHtml::listData($menus, 'id', 'name');


		$this->render('item', array('header' => $header, 'model' => $model, 'menus' => $menus));
	}

	public function actionDelete($id) {
		$model = City::model()->findByPk($id);
		$model->deleteFull();

		$this->redirect($this->createUrl('city/index'));
	}
}