<?php
/**
 *
 * main.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
return array(
	'language' => 'ru',
	'preload' => array('log'),
	'aliases' => array(
		'frontend' => dirname(__FILE__) . '/../..' . '/frontend',
		'common' => dirname(__FILE__) . '/../..' . '/common',
		'backend' => dirname(__FILE__) . '/../..' . '/backend',
		'vendor' => dirname(__FILE__) . '/../..' . '/common/lib/vendor'
	),
	'import' => array(
		'common.extensions.components.*',
		'common.components.*',
		'common.helpers.*',
		'common.models.*',
		'application.components.*',
		'application.controllers.*',
		'application.extensions.*',
		'application.helpers.*',
		'application.models.*'
	),
	'params' => array(
		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'Europe/Samara',
		'smtp' => array(
				"host" => "smtp.volga-rmz.ru", //smtp сервер
				"debug" => 0, //отображение информации дебаггера (0 - нет вообще)
				"auth" => true, //сервер требует авторизации
				"port" => 25, //порт (по-умолчанию - 25)
				"username" => "service@volga-rmz.ru", //имя пользователя на сервере
				"password" => "IHWsK5WYT8", //пароль
				"addreply" => "service@milimon.ru", //ваш е-mail
				"replyto" => "", //e-mail ответа
				"fromname" => "Milimon.ru - система доставки вашей любимой еды", //имя
				"from" => "service@milimon.ru", //от кого
				"charset" => "utf-8", //от кого
		),
		'site' => 'smr.milimon.ru.',
	)
);
