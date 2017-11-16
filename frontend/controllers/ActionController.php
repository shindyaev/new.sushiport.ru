<?php

class ActionController extends FController
{
	
	
	public function actionIndex($id = 54)
	{
		$model = MainMenu::model()->findByPk($id);
		$this->variables['title'] = $model->title;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;

		$this->menuActiveItems[FController::ACTION_MENU_ITEM] = 1;
		
		$criteria = new CDbCriteria();
 		$criteria->condition = 'visible = 1 AND dateStart <= NOW() AND cityId = :cityId';
 		$criteria->order = "dateStart DESC";
 		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		if ($id != 0) {
			$criteria->addCondition('pid = :pid', 'AND');
			$criteria->params[':pid'] = $id;
		}

		$actions = News::model()->findAll($criteria);
		
		$this->render("action", array('actions' => $actions, 'pid' => $id));
	}
	
}