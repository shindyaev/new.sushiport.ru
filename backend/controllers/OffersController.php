<?php

class OffersController extends RController
{
	public function actionIndex()
	{
		$model = new Offer();
		$status = array(0,2,3);
		
		$this->title_h3='Заказы';
		
		$this->breadcrumbs=array(
				'Заказы'
		);
		
		$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('offers/arch').'">История заказов</a>
							</li>';

		$this -> _saveModelFilters();

		$c = new CDbCriteria();
		$c->index = 'id';
		$c->condition = "pid = 0";
		$restorans = Menu::model()->findAll($c);


		$this->render('index', array('model' => $model, 'status' => $status, 'restorans' => $restorans));
	}
	
	public function actionArch()
	{
		$model = new Offer();
		$status = 4;
		
		$this->title_h3='Архив заказов';
		
		$this->breadcrumbs=array(
			'Архив заказов'
		);
		
		$this->breadcrumbs_button = '<li class="pull-right no-text-shadow">
								<a class="btn blue dash-btn" href="'.$this->createUrl('offers/index').'">Актуальные заказы</a>
							</li>';
							
		$c = new CDbCriteria();
		$c->index = 'id';
		$c->condition = "pid = 0";
		$restorans = Menu::model()->findAll($c);
	
		$this->render('index', array('model' => $model, 'status' => $status, 'restorans' => $restorans));
	}
	
	public function actionItem($id) {
		
		$model = Offer::model()->findByPk($id);
		
		if(isset($_POST['Offer'])) {
			$model->attributes=$_POST['Offer'];
			$this->performAjaxValidation($model);
				
			if($model->save()) {
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
		
		$dishes = new OffersDishes();
		$dishes->idOffer = $id; 
		
		$c = new CDbCriteria();
		$c->index = 'id';
		$c->condition = "pid = 0";
		$restorans = Menu::model()->findAll($c);
		
		$this->render('item', array('model' => $model, 'dishes' => $dishes, 'restorans' => $restorans));
	}

	protected function _saveModelFilters()
	{
		if (Yii::app()->request->isAjaxRequest || (!isset($_SERVER['HTTP_REFERER']) || (!strpos($_SERVER['HTTP_REFERER'], 'offers')))) {
			// reset the page information
			Yii::app()->user->setState('OfferPage', null);
		}

		if (isset($_GET['Offer_page']))
		{
			Yii::app()->user->setState('OfferPage', $_GET['Offer_page']);
		}
		elseif ($page = Yii::app()->user->getState('OfferPage'))
		{
			$_GET['Offer_page'] = $page;
		}

	}
}
