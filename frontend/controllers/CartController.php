<?php

class CartController extends FController
{
	
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND cityId = :cityId';
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		$criteria->order = 'price DESC';
		$presents = Present::model()->findAll($criteria);
		
		$this->variables['incart'] = 1;
		
		
		$rests = Menu::model()->findAll('pid = 0');

		$this->render("index", array('presents' => $presents, 'rests' => $rests, 'coupon_model' => new CouponForm()));
	}
	
	public function actionSuccess()
	{
		$this->render("success");
	}
	
	public function actionSubmitOffer() {
		$data = $_POST['order'];

		$sailPlay_gifts = Yii::app()->session['sailplay_gifts'];

		$offer = new Offer();
		$offer->attributes = $data;

		$offer->status = 0;
		
		$firstOrder = false;
		if (!Yii::app()->user->isGuest) {
			$offer->userId = Yii::app()->user->id;
			$user = User::model()->findByPk(Yii::app()->user->id);
			if ($user->firstOrder == 0) {
				$firstOrder = true;
				$user->firstOrder = 1;
				$user->save(false);
			}
		}

		$firstOrder = false;
		$offer->hash = md5(json_encode($data['dishes']).$data['time']);
		
		if (!$offer->save()) {
			Yii::app()->end();
		}
		
		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND cityId = :cityId AND count > 0 AND dateEnd > NOW()";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		$action =  DishAction::model()->findAll($criteria);
		$action = CHtml::listData($action, 'dishId', 'price');
		
		
		$sum = 0;
		$rest = 0;
		foreach ($data['dishes'] AS $key => &$val) {
			$val['action'] = '';
			$model = new OffersDishes();
			$model->idOffer = $offer->id;
			$model->idDish = $val['id'];
			$model->count = $val['count'];
			
			if (!empty($action[$val['id']])) {
				$val['price'] = $action[$val['id']];
				$val['action'] = '(цена по акции)';
			} else  {
				$dish = Dish::model()->findByPk($val['id']);

				if (!empty($val['is_gift']) && isset($sailPlay_gifts[$val['id']])) {
					$val['price'] = 0;
				} else {
					$val['price'] = $dish['price'];
				}
			}
			$model->price = $val['price'];
			
			$sum += $val['price']*$val['count'];
			
			$rest = $val['rest'];

			$model->save();
		}
		
		
		$offer->rest = $rest;
		$offer->sum = $sum;
		$offer->save();
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND cityId = :cityId AND price <= :price AND restoranId = :rest';
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value, ':price' => $sum, ':rest' => $rest);
		$criteria->order = 'price DESC';
		$present = Present::model()->find($criteria);
		
		$data['city'] = City::model()->findByPk((int)Yii::app()->request->cookies['city_id']->value);
		
		$c = new CDbCriteria();
		$c->index = 'id';
		$c->condition = "pid = 0";
		$restorans = Menu::model()->findAll($c);
		
		$mailBlank = $this->renderPartial("//mailBlank/order", array("data" => $data, 'offer' => $offer, 'present' => $present, 'firstOrder' => $firstOrder, 'restorans' => $restorans), true);
			
		$settings = new Settings();
		
		if ($this->variables['city-id'] == 1) 
			$emails = $settings->orderEmailSmr;
		if ($this->variables['city-id'] == 2)
			$emails = $settings->orderEmailUfa;

		$emails = explode(",", $emails);

		foreach ($emails AS $key => $val) {
			SendMail::send($val, "Заявка", $mailBlank);
		}
		
		//sailPlay
		$phone = preg_replace("/\D/","",$offer->phone);
		
		$email = '';
		if (!empty($order->email))
			$email = $order->email;
		
		$url = "http://sailplay.ru/api/v2/users/info/".
				"?user_phone=".$phone.
				"&token=".$this->variables['sailPlayAuthToken'].
				"&store_department_id=1962".
				"&extra_fields=auth_hash";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 4s
		$result = curl_exec($ch); // run the whole process
		curl_close($ch);
		$result = json_decode($result);

		if ($result->status == 'error') {
		
			$url = 'http://sailplay.ru/api/v2/users/add/'.
					'?phone='.$phone.
					'&token='.$this->variables['sailPlayAuthToken'].
					'&store_department_id=1962'.
					'&first_name='.$offer->name.
					'&extra_fields=auth_hash';
				
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
			curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 4s
			$result = curl_exec($ch); // run the whole process
			curl_close($ch);
			$result = json_decode($result);

			if ($result->status == 'ok') {
				$url = 'http://sailplay.ru/api/v2/users/update/'.
						'?phone='.$phone.
						'&token='.$this->variables['sailPlayAuthToken'].
						'&store_department_id=1962'.
						'&add_email='.$email.
						'&extra_fields=auth_hash';
		
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
// 				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
				curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 4s
// 				curl_setopt($ch, CURLOPT_GET, 1); // set POST method
				$result = curl_exec($ch); // run the whole process
				curl_close($ch);
				$result = json_decode($result);

			}
		
		}
		
		Yii::app()->session['sailPlayPublicKey'] = "none";
			
		$url = "http://sailplay.ru/api/v1/purchases/new/".
				"?user_phone=".$phone.
				"&token=".$this->variables['sailPlayAuthToken'].
				"&store_department_id=1962".
				"&pin_code=6363".
				"&price=".$offer->sum.
				"&fields=public_key";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 4s
		$result = curl_exec($ch); // run the whole process
		curl_close($ch);
		$result = json_decode($result);

		Yii::app()->session['sailPlayPublicKey'] =  $result->purchase->public_key;

		if ($sailPlay_gifts = Yii::app()->session['sailplay_gifts']) {
			foreach ($sailPlay_gifts as $id => $gift) {
				if (
					$gift = $this->sailplayBehavior->giftCommitTransaction($gift['gift_public_key'])
					and $gift['status'] == SailplayBehavior::STATUS_OK
				) {
					//Ok
				}
				unset($sailPlay_gifts[$id]);
			}

			Yii::app()->session['sailplay_gifts'] = $sailPlay_gifts;
		}

		//sailPlay
		
		
		
		echo CJSON::encode(
			array(
				'cityId' => $this->variables['city-id'],
				'error'=>false,
			)
		);
		Yii::app()->end();

	}
	
	public function actionCheckPromo() {
	
		$code = $_POST['code'];
		
		$promo = Promo::model()->find('code = :code', array(':code' => $code));
		
		$ret = 'Промо-код не найден.';
		
		if (!empty($promo)) {
			if (!empty($promo['rub']))
				$ret = 'Скидка по промо-коду: '.$promo['rub'].' руб.';
			else if (!empty($promo['proc']))
				$ret = 'Скидка по промо-коду: '.$promo['proc'].' %';
		}
	
		echo CJSON::encode(
			$ret
		);
		Yii::app()->end();
	}

	public function actionConfirmCoupon()
	{

		$model=new CouponForm();
		
		$model->attributes=$_REQUEST['CouponForm'];

		if ($model->validate() && !$this->sailplayBehavior->applyCoupon($this->sailplayBehavior->getToken(), $model->coupon)) {

			$this->addError('coupon','Указаный Вами промокод недейстительный');

		}

	}

	public function actionCancelCoupon() {

	}
}
