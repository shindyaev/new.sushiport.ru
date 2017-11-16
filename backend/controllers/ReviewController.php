<?php

class ReviewController extends RController
{
	public function actionIndex()
	{
		$model = new Review();
		$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Review', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Review();
		}
		
		if(isset($_POST['Review'])) {
			$old_answer = false;
			if (!empty($model->id)) {
				$old_answer = $model->answer;
			}
			$model->attributes=$_POST['Review'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;

			if (!empty($model->id)) {
				
				if ($model->answerDate == '0000-00-00 00:00:00' && $old_answer != $model->answer) {
					$model->answerDate = date("Y-m-d H:i:s");
				}
			}

			$timestamp = CDateTimeParser::parse($model->date,'dd/MM/yyyy HH:mm');
			$model->date = date("Y-m-d H:i:s", $timestamp);
			
			if($model->save()) {
				$this->redirect($this->createUrl('review/index'));
			}
		}
		
		$model->date = Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm:ss', $model->date);
		
		$this->render('item', array('header' => $header, 'model' => $model));
	}
	
	public function actionDelete($id) {
		Review::model()->deleteByPk($id);
		$this->redirect($this->createUrl('review/index'));
	}
}