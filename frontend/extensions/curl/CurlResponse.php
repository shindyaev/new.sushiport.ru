<?php

class CurlResponse {

    /**
     * Оригинальные данные ответа
     *
     * @var string
     */
    protected $raw;

    /**
     * Заголовоки
     *
     * @var string
     */
    protected $headers;

    /**
     * Контент
     *
     * @var string
     */
    protected $content;

    /**
     * Конструктор
     *
     * @param string $response Оригинальные данные ответа
     */
    public function __construct($response) {
        $this->raw = $response;

        // Разбиваем ответ
        $parts = explode("\r\n\r\n", $response, 2);

        if (isset($parts[1])) {
            $this->setHeaders($parts[0]);
            $this->content = $parts[1];
        }
        else {
            $this->content = $parts[0];
        }
    }

    /**
     * Получение оригинальных данных ответа
     *
     * @return string
     */
    public function getRaw() {
        return $this->raw;
    }

    /**
     * Получение заголвоков
     *
     * @return string|array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Установка заголовков
     *
     * При дублировании заголовков их значения
     * будут объединены с помощью `...`.
     * 
     * @param string $headers
     */
    protected function setHeaders($headers) {
        $array = array();

        foreach (explode("\n", $headers) as $i => $header) {
            $header = explode(':', $header, 2);

            if (isset($header[1])) {
                $array[$header[0]] = isset($array[$header[0]]) ?  join(' ... ', array($array[$header[0]], trim($header[1]))) : trim($header[1]);
            }
            else if ($header[0] && !isset($header[1])) {
                $array['Status'] = $header[0];
            }
        }

        $this->headers = $array;
    }

    /**
     * Получение заголвока
     *
     * @param  string $name
     * @return string
     */
    public function getHeader($name) {
        return isset($this->headers[$name]) ? $this->headers[$name] : null;
    }

    /**
     * Получение контента
     *
     * @return string
     */
    public function getContent() {
        return trim($this->content);
    }

    /**
     * Получение контента преобразованного из JSON
     *
     * @return array
     */
    public function getJsonContent() {
        return json_decode($this->content, true);
    }

}