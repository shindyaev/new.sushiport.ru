<?php
/**
 *
 * ZonesController class
 *
 */
class ZonesController extends RController
{
	public function actionIndex()
	{
		$model = new Zones();
		
		$this->render('index', array('model' => $model));
	}
	
	public function actionItem($id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать';
			$model = $this->loadModel('Zones', $id);
		} else  
		{
			$header = 'Добавить';
			$model = new Zones();
		}
		
		if(isset($_POST['Zones'])) {
			$model->attributes=$_POST['Zones'];
			
			if($model->save()) {
				$this->redirect($this->createUrl('zones/index'));
			}
		}

		$restorans = Restoran::model()
			->findAll(
			);
		$restorans = CHtml::listData($restorans, 'id', 'name');
		
		$this->render('item', array('header' => $header,'restorans'=>$restorans, 'model' => $model));
	}
	
	public function actionDelete($id) {
		Zones::model()->deleteByPk($id);
		$this->redirect($this->createUrl('zones/index'));
	}
}