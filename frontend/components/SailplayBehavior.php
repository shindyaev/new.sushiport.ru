<?php

// Подключение библиотеки
Yii::import('application.extensions.curl.*');

class SailplayBehavior extends CBehavior
{

	const SERVICE_URL = 'http://sailplay.ru';
	const STATUS_OK = 'ok';
	const STATUS_ERROR = 'error';
	const EXPIRE_TOKEN = 43200; //12*60*60 сутки

	/**
	 * @var array
	 */
	protected $_service_urls = array(
		'login' => '/api/v2/login/',
		'users_add' => '/api/v2/users/add/',
		'users_info' => '/api/v2/users/info/',
		'users_update' => '/api/v2/users/update/',
		'coupon_status' => '/api/v2/gifts/coupons/status/',
		'get_offer_info' => '/api/v2/gifts/offer/',
		'gift_commit_transaction' => '/api/v1/ecommerce/gifts/commit-transaction',
	);

	protected $curlOptions = array(
		'timeout' => 5,
	);

	protected $token = '';

	/**
	 * SailplayBehavior constructor.
	 */
	public function __construct()
	{
		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);
		Yii::app()->curlRequest->setDefaultOptions(
			array(
				'followlocation' => true,
				'returntransfer' => true,
				'header'         => false,
				'verbose'        => true,
				'autoreferer'    => true,
				'connecttimeout' => 30,
				'timeout'        => 30
			)
		);
	}

	public function login()
	{
		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		// Префикс по-умолчанию
		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Авторизуем приложение в SailPlay и получаем токен.
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['login'],
			array(
				'store_department_id' => $sailplay_params['store_department_id'],
				'store_department_key' => $sailplay_params['store_department_key'],
				'pin_code' => $sailplay_params['pin_code']
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;
	}

	public function getToken($renew = FALSE)
	{

		if (empty($this->token)) {
			/**
			 * @var CDbConnection $connection
			 */
			$connection = Yii::app()->db;

			$command = $connection->createCommand('SELECT * FROM sailPlayAuth WHERE id = 1');
			$sailPlayAuth = $command->queryRow();

			$time = strtotime($sailPlayAuth['date']);
			$nowTime = strtotime('now');
			$diff = $nowTime - $time;

			$token = !empty($sailPlayAuth['token']) ? $sailPlayAuth['token'] : NULL;

			if ($renew || !$token || $diff > self::EXPIRE_TOKEN) {

				$result = $this->login();

				if ($result['status'] == self::STATUS_OK) {

					$token = $result['token'];

					$sql = "UPDATE sailPlayAuth SET token = '" . $result['token'] . "', date = NOW() WHERE id = 1";
					$command = $connection->createCommand($sql);
					$command->execute();

				}

			}

			$this->token = $token;
		}

		return $this->token;

	}

	public function addUser($token, $user, array $params = array())
	{
		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['users_add'],
			array_merge(
				$params,
				array(
					//'email' => $user->email,
					'user_phone' => $user->phone,
					'token' => $token,
					'store_department_id' => $sailplay_params['store_department_id'],
					'pin_code' =>$sailplay_params['pin_code'],
					'extra_fields' => 'auth_hash',
				)
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;
	}

	public function getUserInfo($token, $user)
	{
		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['users_info'],
			array(
				//'email' => $user->email,
				'user_phone' => $user->phone,
				'token' => $token,
				'store_department_id' => $sailplay_params['store_department_id'],
				'extra_fields' => 'auth_hash',
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;
	}

	public function updateUserInfo($token, $user)
	{

		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['users_update'],
			array(
				'phone' => $user->phone,
				'add_email' => $user->email,
				'sex' => $user->sex+1,
				'first_name' => $user->name,
				//'last_name' => $user->fname,
				'token' => $token,
				'store_department_id' => $sailplay_params['store_department_id'],
				'extra_fields' => 'auth_hash',
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;

	}

	public function getUserAuthHash($token, $user)
	{
		$auth_hash = NULL;

		$userInfo = $this -> getUserInfo($token, $user);

		if ($userInfo['status'] == self::STATUS_ERROR) {
			$userInfo = $this -> addUser($token, $user);
		}

		if ($userInfo['status'] == self::STATUS_OK && isset($userInfo['auth_hash'])) {
			$auth_hash = $userInfo['auth_hash'];
		}

		return $auth_hash;
	}

	public function getOffer($sku, $token)
	{
		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['get_offer_info'],
			array(
				'sku' => $sku,
				'token' => $token,
				'store_department_id' => $sailplay_params['store_department_id'],
				'extra_fields' => 'auth_hash',
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}
		return $result;
	}

	/**
	 * @param $token
	 * @param $coupon
	 * @param string $action confirm | confirm_cancel
	 * @return array|null
	 */
	public function getCouponStatus($token, $coupon, $action='confirm')
	{

		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['coupon_status'],
			array(
				'token' => $token,
				'store_department_id' => $sailplay_params['store_department_id'],
				'coupon_number' => $coupon,
				'action' => $action,
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;

	}

	public function applyCoupon($token, $coupon)
	{
		$result = false;

		$data = $this->getCouponStatus($token, $coupon, 'confirm');

		if ($data && $data['status'] == self::STATUS_OK && $data['coupon']['is_confirmed']) {
			$result = true;
		}

		return $result;
	}

	public function giftCommitTransaction($gift_public_key)
	{
		$result = NULL;

		$sailplay_params = Yii::app()->params->sailplay;

		Yii::app()->curlRequest->setPrefix(self::SERVICE_URL);

		/**
		 * Добавляем пользователя и возвращаем его hash
		 * @var CurlResponse $response
		 */
		$response = Yii::app()->curlRequest->sendGet(
			$this->_service_urls['gift_commit_transaction'],
			array(
				'token' => $this -> getToken(),
				'store_department_id' => $sailplay_params['store_department_id'],
				'gift_public_key' => $gift_public_key,
				//'partner_id' => 1475,
			),
			$this -> curlOptions
		);

		if ($response) {
			$result = $response->getJsonContent();
		}

		return $result;
	}

}