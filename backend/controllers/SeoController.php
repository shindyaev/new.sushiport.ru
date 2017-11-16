<?php
/**
 *
 * SeoController class
 *
 */
class SeoController extends RController
{
	public function actionIndex()
	{
		
		$mainSeo = new MainSeo();
		
		if(isset($_POST['MainSeo'])) {
			$mainSeo->attributes=$_POST['MainSeo'];
		
			if($mainSeo->save()) {
				$this->redirect($this->createUrl('/seo/'));
			}
		}
		
		$model = new Seo();
		$this->render('index', array('model' => $model, 'mainSeo' => $mainSeo));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Seo', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Seo();
		}
		
		if(isset($_POST['Seo'])) {
			$model->attributes=$_POST['Seo'];
			
			if($model->save()) {
				$this->redirect($this->createUrl('seo/index'));
			}
		}
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		Seo::model()->deleteByPk($id);
		$this->redirect($this->createUrl('seo/index'));
	}
}