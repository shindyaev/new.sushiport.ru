<?php

class ReviewController extends FController
{
	
	public function actionIndex()
	{
		$this->menuActiveItems[FController::REVIEW_MENU_ITEM] = 1;
		
		
		$criteria = new CDbCriteria();
 
		$count = Review::model()->count($criteria);
	 
		$pages=new CPagination($count);
		// элементов на страницу
		$pages->pageSize=20;
		$pages->applyLimit($criteria);
		$criteria->condition = 'visible = 1 AND cityId = :cityId';
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
	 
		$reviews = Review::model()->findAll($criteria);

		$this->render("index", array('reviews' => $reviews, 'pages' => $pages));
	}
	
	public function actionSubmit() {
		$review = new Review();
		$review->attributes = $_POST['review'];
		$review->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		
		$review->save();
		
		echo CJSON::encode(
			array(
				'error'=>false,
			)
		);
		Yii::app()->end();
		
	}
	
}
