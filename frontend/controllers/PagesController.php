<?php

class PagesController extends FController
{
	
	public function actionIndex($id)
	{
		$model = Page::model()->findByPk($id);

		$this->variables['title'] = $model->pagetitle;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;

		$this->menuActiveItems['pages'.$id] = 1;
		
// 		$criteria = new CDbCriteria();
// 		$criteria->condition = "visible = 1 AND cityId = :cityId AND count > 0 AND dateEnd > NOW()";
// 		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
// 		$criteria->order = "RAND()";
// 		$action =  DishAction::model()->find($criteria);
		
// 		$this->render("index", array('model' => $model, 'actionDish' => $action));
		$this->render("index", array('model' => $model));
	}
	
}