<?php

class SailplayController extends CController {

	const STATUS_OK = 'ok';
	const STATUS_ERROR = 'error';

//    /**
//     * Служебные сообщения
//     *
//     * @var array
//     */
//    protected $messages = array(
//        'sp_auth_error'       => 'Необходимо авторизоваться.',
//        'sp_connection_error' => 'Невозможно подключиться к SailPlay, повторите попытку чуть позже.',
//        'sp_token_error'      => 'Невозможно получить token доступа. Обратитесь в службу поддержки.',
//        'sp_session_error'    => 'Невозможно получить идентификатор сессии. Обратитесь в службу поддержки.',
//        'sp_login_error'      => 'Невозможно получить token доступа для приложения. Обратитесь в службу поддержки.',
//
//        'phone_type_error'    => 'Неправильный формат телефона.'
//    );

	public function behaviors()
	{
		return array(
			'sailplayBehavior' => array(
				'class' => 'SailplayBehavior',
			),
		);
	}

//    /**
//     * {@inheritdoc}
//     */
//    public function init() {
//
//        // Подключение библиотеки
//        Yii::import('application.extensions.curl.*');
//
//        // Префикс по-умолчанию
//        Yii::app()->curlRequest->setPrefix('http://sailplay.ru');
//
//        // Авторизуем приложение в SailPlay и
//        // получаем токен.
//        $response = Yii::app()->curlRequest->sendGet('/api/v2/login/', array(
//            'store_department_id' => 1962,
//            'store_department_key' => 78536707,
//            'pin_code' => 6363
//        ));
//
//        if ($response) {
//            $json = $response->getJsonContent();
//
//            if ($json['status'] !== 'ok') {
//                $this->renderJson(array(
//                    'status' => 'error',
//                    'message' => $this->messages['sp_login_error']
//                ));
//            }
//
//            // Устанавливаем параметры по-умолчанию
//            Yii::app()->curlRequest->setDefaultParams(array(
//                'store_department_id' => 987,
//                'partner_id' => 734,
//                'token' => $json['token'],
//                'redirect_url' => 'http://www.gedza.ru'
//            ));
//        }
//    }
//
//    public function actionIndex() {
//    }
//
//    /**
//     * Проверка авторизован ли пользователь
//     *
//     * @uses $_POST['session_id'] Идентификатор сессии
//     */
//    function actionCheckAuth() {
//        $options = isset($_POST['session_id']) ? array('Cookie' => 'sessionid='.$_POST['session_id']) : array();
//        $response = Yii::app()->curlRequest->sendGet('/external/', array(), $options);
//
//        if ($response) {
//
//            // Получем CSRF-токен
//            $csrf_token = preg_match('/csrftoken\=(?P<token>[a-zA-Z0-9]+)\;/', $response->getHeader('Set-Cookie'), $match) ? $match['token'] : '';
//            // $referer = Yii::app()->curlRequest->getOption('url');
//
//            if (!$csrf_token) {
//                $this->renderJson(array(
//                    'status' => 'error',
//                    'message' => $this->messages['sp_token_error']
//                ));
//            }
//
//            if (preg_match('/Авторизуйтесь/', $response->getContent())) {
//                $this->renderJson(array(
//                    'status' => 'error',
//                    'csrf_token' => $csrf_token,
//                    'message' => $this->messages['sp_auth_error']
//                ));
//            }
//
//            $this->renderJson(array(
//                'status' => 'ok',
//                'csrf_token' => $csrf_token,
//                'session_id' => $_POST['session_id']
//            ));
//        }
//    }
//
//    /**
//     * Авторизация/регистрация пользователя
//     *
//     * @uses $_POST['csrf_token']    CSRF-токен
//     * @uses $_POST['phone']         Телефон пользователя
//     * @uses $_POST['user_password'] Пароль пользователя
//     * @uses $_POST['agreement']     Флаг об соглашении с требованиями соглашения
//     */
//    public function actionReg() {
//        $this->validatePost(array('csrf_token', 'phone', 'user_password', 'agreement'));
//
//        $csrf_token = $_POST['csrf_token'];
//        $phone = $_POST['phone'];
//        $user_password = $_POST['user_password'];
//        $agreement = $_POST['agreement'];
//
//        // Парсим номер телефона
//        if (preg_match('/\+(?P<phone_code>[0-9])(?P<phone>[0-9]+)/', $phone, $matches)) {
//            $phone_code = $matches['phone_code'];
//            $phone = $matches['phone'];
//        }
//        else {
//            $this->renderJson(array(
//                'status' => 'error',
//                'message' => $this->messages['phone_type_error']
//            ));
//        }
//
//        $response = Yii::app()->curlRequest->sendPost('/users/ajax/registration/', array(
//            'csrfmiddlewaretoken' => $csrf_token,
//
//            // Данные пользователя
//            'phone' => $phone,
//            'phone_code' => $phone_code,
//            'password' => $user_password,
//            'agreement' => $agreement,
//        ), array(
//            'httpheader' => array(
//                'Cookie' => 'csrftoken='.$csrf_token.'; client_type=desktop',
//                'Content-Type' => 'application/json;charset=UTF-8',
//                'Connection' => 'keep-alive',
//                'X-Requested-With' => 'XMLHttpRequest'
//            )
//        ));
//
//        // Проверям авторизация или регистрация
//        if ($response) {
//            $json = $response->getJsonContent();
//
//            if ($json['status'] !== 'ok') {
//                $this->render($response->getContent());
//            }
//
//            // Получем sessionid. Используеться как флаг
//            // авторизации пользователя.
//            $session_id = preg_match('/sessionid\=(?P<session_id>[a-zA-Z0-9]+)\;/', $response->getHeader('Set-Cookie'), $match) ? $match['session_id'] : '';
//
//            // Регистрация
//            if (!$session_id) {
//                $this->renderJson(array_merge($json, array(
//                    'csrf_token' => $csrf_token
//                )));
//            }
//
//            // Авторизация
//            $this->renderJson(array_merge($json, array(
//                'csrf_token' => $csrf_token,
//                'session_id' => $session_id,
//                'phone' => $phone_code.$phone
//            )));
//        }
//        else {
//            $this->renderJson(array(
//                'status' => 'error',
//                'message' => $this->messages['sp_connection_error']
//            ));
//        }
//    }
//
//    /**
//     * Подтверждение регистрации пользователя кодом
//     *
//     * @uses $_POST['csrf_token'] CSRF-токен
//     * @uses $_POST['phone']      Телефон пользователя
//     * @uses $_POST['sms_code']   Код, полученный по SMS
//     */
//    public function actionRegConfirm() {
//        $this->validatePost(array('csrf_token', 'phone', 'sms_code'));
//
//        $csrf_token = $_POST['csrf_token'];
//        $phone = $_POST['phone'];
//        $sms_code = $_POST['sms_code'];
//
//        $response = Yii::app()->curlRequest->sendPost('/users/ajax/phone-verification/', array(
//            'csrfmiddlewaretoken' => $csrf_token,
//
//            // Данные пользователя
//            'phone' => $phone,
//            'sms_code' => $sms_code
//        ), array(
//            'httpheader' => array(
//                'Cookie' => 'csrftoken='.$csrf_token.'; client_type=desktop',
//                'Content-Type' => 'application/json;charset=UTF-8',
//                'Connection' => 'keep-alive',
//                'X-Requested-With' => 'XMLHttpRequest'
//            )
//        ));
//
//        if ($response) {
//            $this->render($response->getContent());
//        }
//    }
//
//    /**
//     * Восстановление пароля
//     *
//     * Этап проверки телефона.
//     *
//     * @uses $_POST['csrf_token'] CSRF-токен
//     * @uses $_POST['phone']      Телефон пользователя
//     */
//    public function actionRestorePassCheckPhone() {
//        $this->validatePost(array('csrf_token', 'phone'));
//
//        $csrf_token = $_POST['csrf_token'];
//        $phone = $_POST['phone'];
//
//        // Парсим номер телефона
//        if (preg_match('/\+(?P<phone_code>[0-9])(?P<phone>[0-9]+)/', $phone, $matches)) {
//            $phone_code = $matches['phone_code'];
//            $phone = $matches['phone'];
//        }
//        else {
//            $this->renderJson(array(
//                'status' => 'error',
//                'message' => $this->messages['phone_type_error']
//            ));
//        }
//
//        $response = Yii::app()->curlRequest->sendPost('/users/ajax/restore-password/check-phone/', array(
//            'csrfmiddlewaretoken' => $csrf_token,
//
//            // Данные пользователя
//            'phone' => $phone,
//            'phone_code' => $phone_code
//        ), array(
//            'httpheader' => array(
//                'Cookie' => 'csrftoken='.$csrf_token.'; client_type=desktop',
//                'Content-Type' => 'application/json;charset=UTF-8',
//                'Connection' => 'keep-alive',
//                'X-Requested-With' => 'XMLHttpRequest'
//            )
//        ));
//
//        if ($response) {
//            $json = $response->getJsonContent();
//
//            if ($json['status'] !== 'ok') {
//                $this->render($response->getContent());
//            }
//
//            $this->renderJson(array(
//                'status' => 'ok',
//                'phone' => '+'.$json['login']
//            ));
//        }
//    }
//
//    /**
//     * Восстановление пароля
//     *
//     * Этап проверки кода, полученнего по SMS.
//     *
//     * @uses $_POST['csrf_token'] CSRF-токен
//     * @uses $_POST['login']      Телефон пользователя
//     * @uses $_POST['sms_code']   Код, полученный по SMS
//     */
//    public function actionRestorePassCheckCode() {
//        $this->validatePost(array('csrf_token', 'phone', 'sms_code'));
//
//        $csrf_token = $_POST['csrf_token'];
//        $login = str_replace('+', '', $_POST['phone']);
//        $sms_code = $_POST['sms_code'];
//
//        $response = Yii::app()->curlRequest->sendPost('/users/ajax/restore-password/check-smscode/', array(
//            'csrfmiddlewaretoken' => $csrf_token,
//
//            // Данные пользователя
//            'login' => $login,
//            'code' => $sms_code
//        ), array(
//            'httpheader' => array(
//                'Cookie' => 'csrftoken='.$csrf_token.'; client_type=desktop',
//                'Content-Type' => 'application/json;charset=UTF-8',
//                'Connection' => 'keep-alive',
//                'X-Requested-With' => 'XMLHttpRequest'
//            )
//        ));
//
//        if ($response) {
//            $json = $response->getJsonContent();
//
//            if ($json['status'] !== 'ok') {
//                $this->render($response->getContent());
//            }
//
//            $this->renderJson(array(
//                'status' => 'ok',
//                'sms_code' => $sms_code
//            ));
//        }
//    }
//
//    /**
//     * Восстановление пароля
//     *
//     * Этап проверки совпадения новых паролей.
//     *
//     * @uses $_POST['csrf_token'] CSRF-токен
//     * @uses $_POST['login']      Телефон пользователя
//     * @uses $_POST['sms_code']   Код, полученный по SMS
//     * @uses $_POST['password_1']
//     * @uses $_POST['password_2']
//     */
//    public function actionRestorePassCheckPasswords() {
//        $this->validatePost(array('csrf_token', 'phone', 'sms_code', 'password_1', 'password_2'));
//
//        $csrf_token = $_POST['csrf_token'];
//        $login = str_replace('+', '', $_POST['phone']);
//        $sms_code = $_POST['sms_code'];
//        $password_1 = $_POST['password_1'];
//        $password_2 = $_POST['password_2'];
//
//        $response = Yii::app()->curlRequest->sendPost('/users/ajax/restore-password/check-passwords/', array(
//            'csrfmiddlewaretoken' => $csrf_token,
//
//            // Данные пользователя
//            'login' => $login,
//            'code' => $sms_code,
//            'password1' => $password_1,
//            'password2' => $password_2
//        ), array(
//            'httpheader' => array(
//                'Cookie' => 'csrftoken='.$csrf_token.'; client_type=desktop',
//                'Content-Type' => 'application/json;charset=UTF-8',
//                'Connection' => 'keep-alive',
//                'X-Requested-With' => 'XMLHttpRequest'
//            )
//        ));
//
//        if ($response) {
//            $this->render($response->getContent());
//        }
//    }
//
//    /**
//     * Получение общей информации о пользователе
//     *
//     * @uses $_POST['phone'] Телефон пользователя
//     */
//    public function actionGetInfo() {
//        $this->validatePost(array('phone'));
//
//        $response = Yii::app()->curlRequest->sendGet('/api/v2/users/info/', array(
//            'user_phone' => $_POST['phone'],
//            'history' => 1,
//        ));
//
//        if ($response) {
//            $this->render($response->getContent());
//        }
//    }
//
//    public function actionNewPurchase() {
//        $this->validatePost(array('phone', 'price'));
//
//        $response = Yii::app()->curlRequest->sendGet('/api/v1/purchases/new/', array(
//            'user_phone' => $_POST['phone'],
//            'price' => $_POST['price'],
//            'force_complete' => 1
//        ));
//
//        if ($response) {
//            $this->render($response->getContent());
//        }
//    }

	public function actionAddGift()
	{
		$msg = '';
		$status = self::STATUS_ERROR;

		$gift_sku = Yii::app()->request->getQuery('gift_sku');

		$gift_public_key = Yii::app()->request->getQuery('gift_public_key');

		if($gift_sku && $gift_public_key) {

			if ($dish_model = Dish::model()->findByPk($gift_sku)) {

//				if (
//					$gift = $this->sailplayBehavior->giftCommitTransaction($gift_public_key)
//					and $gift['status'] == self::STATUS_OK
//				) {

					$status = self::STATUS_OK;

					$sailPlay_gifts = isset(Yii::app()->session['sailplay_gifts']) ? Yii::app()->session['sailplay_gifts'] : [];

					$sailPlay_gifts[$dish_model['id']] = array_merge(
						$dish_model->getAttributes(),
						array(
							'is_gift' => TRUE,
							'image' => $dish_model->imagesUrl . '229x229/' . $dish_model->id . '.jpg',
							'points_delta' => isset($gift['purchase_gift']['points_delta']) ? $gift['purchase_gift']['points_delta'] : NULL,
							'price' => 0,
							'count' => 1,
							'gift_public_key' => $gift_public_key
						)
					);
					Yii::app()->session['sailplay_gifts'] = $sailPlay_gifts;
//				} else {
//					$msg = 'Transaction error: ' . print_r($gift, true);
//				}
			} else {
				$msg = 'gift not found by gift_sku';
			}
		} else {
			$msg = 'missed gift_sku or gift_public_key';
		}

		$result = array('status' => $status);

		if (!empty($msg)) {
			$result = array_merge($result, array('msg' => $msg));
		}

		$this->renderJson($result);
	}

	public function actionRemoveGift()
	{
		$status = self::STATUS_OK;
		$msg = '';

		$sailPlay_gifts = Yii::app()->session['sailplay_gifts'];

		if ($gift_sku = Yii::app()->request->getQuery('sku')) {

			unset($sailPlay_gifts[$gift_sku]);
			Yii::app()->session['sailplay_gifts'] = $sailPlay_gifts;

		} else {

			$status = self::STATUS_ERROR;
			$msg = 'missed sku';
		}

		$this->renderJson(array('status' => $status, 'msg' => $msg));
	}

    /**
     * Проверка на заполненность полей в $_POST
     *
     * @param  array  $fields Обязательные поля
     * @return string
     */
    public function validatePost($fields = array()) {
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                $this->renderJson(array(
                    'status' => 'error',
                    'message' => 'Заполнены не все поля.'
                ));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function render($string, $data = null, $return = false) {
        echo $string;

        Yii::app()->end();
    }

    /**
     * Возвращаем ответ в формате JSON
     *
     * @param array $array
     */
    public function renderJson($array) {
        echo json_encode($array);

        Yii::app()->end();
    }

}
