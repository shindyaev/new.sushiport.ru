<?php

class DeviceController extends CController {

    /**
     * {@inheritdoc}
     */
    public function init() {

        // Подключение библиотеки
        Yii::import('application.extensions.curl.*');

        // Префикс по-умолчанию
        Yii::app()->curlRequest->setPrefix('http://milimon.ru.xspm.ru/sailplay');
    }

    public function actionIndex() {
    }

    /**
     * Очистка данных сессии
     */
    public function actionClearSession() {
        Yii::app()->session->clear();
    }

    /**
     * Просмотр данных сессии
     */
    public function actionViewSession() {
        var_dump(Yii::app()->session->toArray());
    }

    /**
     * Тест проверки авторизованности пользователя
     */
    public function actionTestAuth() {
        $params = isset(Yii::app()->session['sp_session_id']) ? array('session_id' => Yii::app()->session['sp_session_id']) : array();
        $response = Yii::app()->curlRequest->sendPost('/checkAuth/', $params);

        if ($response) {
            $json = $response->getJsonContent();

            // @device Сохраняем CSRF-токен
            Yii::app()->session['sp_csrf_token'] = $json['csrf_token'];

            if ($json['status'] !== 'ok') {

                // @device Имитация перенаправления на форму авторизации
                $this->log('Перенаправление на форму авторизации', $response->getContent());  
                
                $this->actionTestReg();

                Yii::app()->end();
            }

            // @device Имитация перенаправления в раздел пользователя
            $this->log('Перенаправление в раздел пользователя');
        }

        Yii::app()->end();
    }

    /**
     * Тест регистрации пользователя
     */
    public function actionTestReg() {
        $response = Yii::app()->curlRequest->sendPost('/reg/', array(
            'csrf_token' => Yii::app()->session['sp_csrf_token'],

            'phone' => '+79178239994',
            'user_password' => '1234',
            'agreement' => 'on'
        ));

        if ($response) {
            $this->log('Получен ответ после попытки зарегистрироваться/авторизоваться', $response->getContent());

            $json = $response->getJsonContent();

            // Регистрация
            if (!isset($json['session_id'])) {
                if ($json['status'] !== 'ok') {
                    Yii::app()->end();
                }

                // @device Сохраняем данные
                Yii::app()->session['sp_phone'] = $json['phone'];

                $this->log('Перенаправление в подтверждение регистрации с помощью кода');

                // @device Имитация ввода кода с телефона
                // $this->actionTestRegConfirm();
            }

            // Авторизация
            
            // @device Сохраняем данные
            Yii::app()->session['sp_session_id'] = $json['session_id'];
            Yii::app()->session['sp_phone']      = $json['phone'];

            $this->log('Необходимо опять проверить аторизацию');

            $this->actionTestAuth();
        }

        Yii::app()->end();
    }

    /**
     * Тест подтверждения регистрации
     */
    public function actionTestRegConfirm() {
        $response = Yii::app()->curlRequest->sendPost('/regConfirm/', array(
            'csrf_token' => Yii::app()->session['sp_csrf_token'],
            'phone'      => Yii::app()->session['sp_phone'],
            'sms_code'   => 4458
        ));

        if ($response) {
            $this->log('Получен ответ после попытки подтверждения регистрации', $response->getContent());

            $json = $response->getJsonContent();

            if ($json['status'] !== 'ok') {
                Yii::app()->end();
            }

            $this->log('Необходимо опять проверить аторизацию');

            // $this->actionTestAuth();
        }

        Yii::app()->end();
    }

    /**
     * Тест восстановления пароля
     *
     * Проверка телефона.
     */
    public function actionTestRestorePassCheckPhone() {
        $response = Yii::app()->curlRequest->sendPost('/restorePassCheckPhone/', array(
            'csrf_token' => Yii::app()->session['sp_csrf_token'],
            'phone'      => '+79178239994'
        ));

        if ($response) {
            $this->log('Получен ответ после попытки восстановления пароля (проверка телефона)', $response->getContent());

            $json = $response->getJsonContent();

            if ($json['status'] !== 'ok') {
                Yii::app()->end();
            }

            // @device Сохраняем данные
            Yii::app()->session['sp_phone'] = $json['phone'];
        }
    }

    /**
     * Тест восстановления пароля
     *
     * Проверка кода.
     */
    public function actionTestRestorePassCheckCode() {
        $response = Yii::app()->curlRequest->sendPost('/restorePassCheckCode/', array(
            'csrf_token' => Yii::app()->session['sp_csrf_token'],
            'phone'      => Yii::app()->session['sp_phone'],
            'sms_code'   => 7116
        ));

        if ($response) {
            $this->log('Получен ответ после попытки восстановления пароля (проверка кода)', $response->getContent());

            $json = $response->getJsonContent();

            if ($json['status'] !== 'ok') {
                Yii::app()->end();
            }

            // @device Сохраняем данные
            Yii::app()->session['sp_sms_code'] = $json['sms_code'];
        }
    }

    /**
     * Тест восстановления пароля
     *
     * Проверка введенных паролей.
     */
    public function actionTestRestorePassCheckPasswords() {
        $response = Yii::app()->curlRequest->sendPost('/restorePassCheckPasswords/', array(
            'csrf_token' => Yii::app()->session['sp_csrf_token'],
            'phone'      => Yii::app()->session['sp_phone'],
            'sms_code'   => Yii::app()->session['sp_sms_code'],
            'password_1' => '1234',
            'password_2' => '1234'
        ));

        if ($response) {
            $this->log('Получен ответ после попытки восстановления пароля (проверка паролей)', $response->getContent());
        }
    }

    /**
     * Тест запрос информации о пользователе
     */
    public function actionTestGetInfo() {
        $params = isset(Yii::app()->session['sp_phone']) ? array('phone' => Yii::app()->session['sp_phone']) : array();
        $response = Yii::app()->curlRequest->sendPost('/getInfo/', $params);

        if ($response) {
            $this->log('Получен ответ после попытки запросить информацию о пользователе', $response->getContent());
        }
    }

    /**
     * Тест начисления баллов
     */
    public function actionTestNewPurchase() {
        $response = Yii::app()->curlRequest->sendPost('/newPurchase/', array(
            'phone' => Yii::app()->session['sp_phone'],
            'price' => 550
        ));

        if ($response) {
            $this->log('Получен ответ после попытки начисления баллов', $response->getContent());
        }
    }

    /**
     * Проверка отправки заказа
     */
    public function actionTestSendOrder() {
        Yii::app()->curlRequest->setPrefix('http://api.gedza.ru');

        $response = Yii::app()->curlRequest->sendPost('/send.php', array(
            'dishes[482]' => 1,
            'dishes[483]' => 1,
            'userPhone' => '+79178239994',
            'userName' => 'Kristofor',
            'orderMethod' => 1,
            'isIOS' => 1,
            'cityID' => 2,
            'orderMethodText' => 'Доставка',
            'restID' => 0,
            'userAddress' => 'ул. Samarskaya, д. 6v, пд. 1, эт. 1, кв. 5',
            'payMethod' => 1,
            'toTime' => '1411478714',
            'firstOrderBonus' => 1,
            'payMethodText' => 'Наличные',
            'userComment' => '',
            'personsCount' => 1
        ));

        if ($response) {
            $this->log('Получен ответ после попытки отправить заказ', $response->getContent());
        }
    }

    /**
     * Отчет
     */
    protected function log($message, $data = null) {
        print_r("\n================ ".$message."\n\n");
        var_dump($data);
        print_r("\n================\n\n");
    }

}
