<?php
/**
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
return array(
	'components' => array(
// 		change to suit your needs
		'db' => array(
			'connectionString' => 'mysql:host=178.63.199.127;dbname=milimon',
			'username' => 'milimon',
			'password' => 'milimon',
			'enableProfiling' => true,
			'enableParamLogging' => true,
			'charset' => 'utf8',
		),
		'mailer' => array(
			'class' => 'common.extensions.mailer.EMailer',
		),
	),
);
