<?php

class PromoController extends RController
{
	public function actionIndex()
	{
		$model = new Promo();
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Promo', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Promo();
		}
		
		if(isset($_POST['Promo'])) {
			$model->attributes=$_POST['Promo'];

			if($model->save()) {
				$this->redirect($this->createUrl('promo/index'));
			}
		}
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		Promo::model()->deleteByPk($id);
		$this->redirect($this->createUrl('promo/index'));
	}
}