<?php
/**
 *
 * backend.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'backend');

// web application configuration
return array(
	'name' => 'Admin Panel',
	'basePath' => realPath(__DIR__ . '/..'),
	// path aliases
	'aliases' => array(
		'bootstrap' => dirname(__FILE__) . '/../..' . '/common/lib/vendor/2amigos/yiistrap',
		'yiiwheels' =>  dirname(__FILE__) . '/../..' . '/common/lib/vendor/2amigos/yiiwheels'
	),

	// application behaviors
	'behaviors' => array(),

	// controllers mappings
	'controllerMap' => array(),

	// application modules
	'modules' => array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => 'yii',
			'ipFilters' => array('127.0.0.1','::1'),
		),
		'rights'=>array(
			'superuserName'=>'Admin', // Name of the role with super user privileges.
			'authenticatedName'=>'Authenticated', // Name of the authenticated user role.
			'userClass' => 'Admins',
			'userIdColumn'=>'id', // Name of the user id column in the database.
			'userNameColumn'=>'login', // Name of the user name column in the database.
			'enableBizRule'=>true, // Whether to enable authorization item business rules.
			'enableBizRuleData'=>false, // Whether to enable data for business rules.
			'displayDescription'=>true, // Whether to use item description instead of name.
			'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
			'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.
			'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
			'layout'=>'rights.views.layouts.main', // Layout to use for displaying Rights.
			'appLayout'=>'application.views.layouts.main', // Application layout.
			'cssFile'=>'rights.css', // Style sheet file to use for Rights.
			'install'=>false, // Whether to enable installer.
			'debug'=>true,
		),
	),

	// application components
	'components' => array(

		'bootstrap' => array(
			'class' => 'bootstrap.components.TbApi',
		),

		'clientScript' => array(
			'scriptMap' => array(
				'bootstrap.min.css' => false,
				'bootstrap.min.js' => false,
				'bootstrap-yii.css' => false,
				'jquery.min.js' => false
			)
		),
		'urlManager' => array(
			// uncomment the following if you have enabled Apache's Rewrite module.
			'urlFormat' => 'path',
			'showScriptName' => false,

			'rules' => array(
				'<controller:(menu)>/<action:(section|dish)>/<pid:\d+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:(menu)>/<action:(section|dish)>/<pid:\d+>'=>'<controller>/<action>',

				'<controller:site>/<action:mainMenuItem>/<pid:\d+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:site>/<action:mainMenuItem>/<pid:\d+>'=>'<controller>/<action>',

				'<controller:news>/<action:item>/<pid:\d+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:news>/<action:item>/<pid:\d+>'=>'<controller>/<action>',

				// default rules
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',


				'<module:\w+>/<controller:\w+>'=>'<module>/<controller>/index',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
			),
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
				'class'  => 'CLogRouter',
				'routes' => array(
						array(
								'class'        => 'CDbLogRoute',
								'connectionID' => 'db',
								'levels'       => 'error, warning',
						),
				),
		),
		'user'=>array(
			'class'=>'RWebUser',
			'allowAutoLogin' => true,
			'loginUrl'=>array('site/login'),
		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
			'defaultRoles' => array('Guest')
		),
		'ih'=>array(
				'class'=>'CImageHandler',
		),
	),
	'params' => array(
			'yii.handleErrors'   => true,
			'yii.debug' => true,
			'yii.traceLevel' => 3,
	),
	'import' => array(
		'application.modules.rights.*',
		'application.modules.rights.components.*',
	),
);
