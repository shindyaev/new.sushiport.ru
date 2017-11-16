<?php
class PagesController extends RController
{
	public function actionIndex()
	{
		$model = new Page();
		
		$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
			<a class="btn blue dash-btn" href="'.$this->createUrl('pages/item').'"><i class="icon-plus"></i>Добавить страницу</a>
		</li>';
		
		
		$this->render('/pages/index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать страницу';
			$model = $this->loadModel('Page', $id);
		} else  
		{
			$header = 'Добавить страницу';
			$model = new Page();
		}
		
		if(isset($_POST['Page'])) {
			$model->attributes=$_POST['Page'];
			
			$model->save();
			$this->redirect($this->createUrl('pages/index'));
		}
		
		$this->render('/pages/item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		Page::model()->deleteByPk($id);
		
		$this->redirect($this->createUrl('pages/index'));
	}
}