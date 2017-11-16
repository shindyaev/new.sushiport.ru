<?php

class CurlRequest {

    /**
     * @var \Curl
     */
    protected $curl;

    /**
     * Префикс адреса
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Параметры запроса по-умолчанию
     *
     * @var array
     */
    protected $defaultsParams = array();

    /**
     * Опции запроса по-умолчанию
     *
     * @var array
     */
    protected $defaultsOptions = array(
        'followlocation' => false,
        'returntransfer' => true,
        'header'         => true,
        'verbose'        => true,
        'autoreferer'    => true,         
        'connecttimeout' => 30,
        'timeout'        => 30
    );

    /**
     * Опции запроса
     *
     * Собираются каждый раз во время
     * инициализации запроса.
     * 
     * @var array
     */
    protected $options = array();

    /**
     * Конструктор
     *
     * @param \Curl $curl
     */
    public function __construct(Curl $curl = null) {
        $this->curl = $curl ? $curl : new Curl();
    }

    /**
     * Инициализация
     *
     * Автоматически вызывается в Yii framework.
     */
    public function init() {}

    /**
     * Получение cURL объекта
     *
     * @return \Curl
     */
    public function getCurl() {
        return $this->curl;
    }

    /**
     * Получение префикса адреса
     *
     * @return string
     */
    public function getPrefix() {
        return $this->prefix;
    }

    /**
     * Установка префикса адреса
     *
     * @param string $prefix
     */
    public function setPrefix($prefix) {
        $this->prefix = $prefix;
    }

    /**
     * Получение параметров по-умолчанию
     *
     * @return array
     */
    public function getDefaultParams() {
        return $this->defaultsParams;
    }

    /**
     * Установка параметров по-умолчанию
     *
     * @param array $params
     */
    public function setDefaultParams($params) {
        $this->defaultsParams = $params;
    }

    /**
     * Добавление параметров по-умолчанию
     *
     * @param array $params
     */
    public function addDefaultParams($params) {
        $this->defaultsParams = array_merge($this->defaultsParams, $params);
    }

    /**
     * Получение опций по-умолчанию
     *
     * @return array
     */
    public function getDefaultOptions() {
        return $this->defaultsOptions;
    }

    /**
     * Установка опций по-умолчанию
     *
     * @param array $options
     */
    public function setDefaultOptions($options) {
        $this->defaultsOptions = $options;
    }

    /**
     * Добавление опций по-умолчанию
     *
     * @param array $options
     */
    public function addDefaultOptions($options) {
        $this->defaultsOptions = array_merge($this->defaultsOptions, $options);
    }

    /**
     * Получение опций
     *
     * Вызываеться после выполнения запроса для отладки.
     * 
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * Получение опции
     *
     * Вызываеться после выполнения запроса для отладки.
     *
     * @return string
     */
    public function getOption($name) {
        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * Установка HTTP-метода
     *
     * @param string $method
     */
    protected function setMethod($method) {
        switch ($method) {
            case 'GET':
                $this->options['httpget'] = true;
                break;

            case 'POST':
                $this->options['post'] = true;
                break;

            default:
                $this->options['customrequest'] = $this->method;
        }
    }

    /**
     * Установка адреса
     *
     * @param string $url
     */
    protected function setUrl($url) {
        $this->options['url'] = $this->prefix.$url;
    }
    public function getUrl() {
        return $this->options['url'];
    }
    /**
     * Установка заголовков
     *
     * @todo Реализовать поддержку заголовков по-умолчанию
     */
    protected function setHeaders() {
        if (!isset($this->options['httpheader'])) {
            return;
        }

        $headers = array();

        foreach ($this->options['httpheader'] as $key => $value) {
            $headers[] = $key.': '.$value;
        }

        $this->options['httpheader'] = $headers;
    }

    /**
     * Установка параметров
     *
     * @param string $params
     */
    protected function setPostfields($params) {
        $this->options['postfields'] = http_build_query(array_merge($this->defaultsParams, $params), '', '&');
    }

    /**
     * Создание GET-запроса
     *
     * @param  string $url
     * @param  array  $params
     * @param  array  $options
     * @return mixed
     */
    public function sendGet($url, $params = array(), $options = array()) {
        $url .= (stripos($url, '?') !== false) ? '&' : '?';
        $url .= http_build_query(array_merge($this->defaultsParams, $params), '', '&');

        return $this->sendRequest('GET', $url, array(), $options);
    }

    /**
     * Создание POST-запроса
     *
     * @param  string $url
     * @param  array  $params
     * @param  array  $options
     * @return mixed
     */
    public function sendPost($url, $params = array(), $options = array()) {
        return $this->sendRequest('POST', $url, $params, $options);
    }

    /**
     * Срздание запроса
     *
     * @param  string $method  HTTP-метод запроса
     * @param  string $url
     * @param  array  $params
     * @param  array  $options
     * @return \CurlResponse
     */
    protected function sendRequest($method, $url, $params = array(), $options = array()) {
        $this->options = array_merge($this->defaultsOptions, $options);

        $this->setMethod($method);
        $this->setUrl($url);
        $this->setHeaders();

        if (!empty($params)) {
            $this->setPostfields($params);
        }

        // Инициализация соединения
        $this->curl->init();

        foreach ($this->options as $key => $value) {
            $this->curl->setopt(constant('CURLOPT_'.strtoupper($key)), $value);
        }

        // Ответ
        $response = $this->curl->exec();

        if ($response) {
            $response = new CurlResponse($response);
        }

        $this->curl->close();

        return $response;
    }

}
