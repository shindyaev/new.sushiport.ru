<?php

class DeliveryController extends FController
{
	
	public function actionIndex($id = 53)
	{
		$model = MainMenu::model()->findByPk($id);
		$this->variables['title'] = $model->title;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;

		$this->layout='/layouts/offer';
		
		$this->render("index");
	}
	
}