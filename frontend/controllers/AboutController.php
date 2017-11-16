<?php

class AboutController extends FController
{
	
	public function actionIndex($id = 0)
	{
		$this->layout='/layouts/offer';
		
		$model = new AboutText();
		
		$filial1 = new AboutFilial1();
		$filial2 = new AboutFilial2();

		$this->render("index", array('model' => $model, 'filial1' => $filial1, 'filial2' => $filial2));
	}
	
}