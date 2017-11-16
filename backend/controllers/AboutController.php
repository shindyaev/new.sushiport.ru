<?php

class AboutController extends RController
{
	public function actionIndex()
	{
		$text = new AboutText();
		
		if(isset($_POST['AboutText'])) {
		
			$text->attributes=$_POST['AboutText'];
				
			$this->performAjaxValidation($text);
			if($text->save()) {
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
		
		$this->render('index', array('model' => $text));
	}
	
	public function actionFilial1() {
		$model = new AboutFilial1();
		
		if(!empty($_FILES['AboutFilial1']['name']['image'])) {
			$model->saveImage($_FILES['AboutFilial1']['tmp_name']['image'], true);
			$this->redirect("/about/filial1/");
		}
		
		$this->render('filial1', array('model' => $model));
		
	}
	
	public function actionFilial2() {
		$model = new AboutFilial2();
	
		if(!empty($_FILES['AboutFilial2']['name']['image'])) {
			$model->saveImage($_FILES['AboutFilial2']['tmp_name']['image'], true);
			$this->redirect("/about/filial2/");
		}
	
		$this->render('filial2', array('model' => $model));
	
	}
	
	public function actionDeleteFilial1Img() {
		if (isset($_POST['name'])) {
			$model = new AboutFilial1();
			$model->deleteImage($_POST['name']);
		}
	}
	
	public function actionDeleteFilial2Img() {
		if (isset($_POST['name'])) {
			$model = new AboutFilial2();
			$model->deleteImage($_POST['name']);
		}
	}
	
}