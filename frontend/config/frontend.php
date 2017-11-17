<?php
/**
 *
 * frontend.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
defined('APP_CONFIG_NAME') or define('APP_CONFIG_NAME', 'frontend');

// web application configuration
return array(
	'name' => '{APPLICATION NAME}',
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
			'class'=>'UrlManager',
			// uncomment the following if you have enabled Apache's Rewrite module.
			'urlFormat' => 'path',
			'showScriptName' => false,

			'rules' => array(
			
				'http://<city>.milimon.dev/<controller:cart>/' => '<controller>/index',
				'http://<city>.milimon.dev/<controller:cart>/<action:(index|success)>' => '<controller>/<action>',

				'<controller:user>/<action:registrationDone>/<hash:\w+>' => '<controller>/<action>',
				'<controller:user>/<action:recoveryDone>/<hash:\w+>' => '<controller>/<action>',

				'<controller:menu>/<id:\d+>/<sort:\w+>' => '<controller>/index',

				array('menu/index', 'pattern'=>'sielbysam/', 'defaultParams'=>array('id'=>11)),
				array('menu/index', 'pattern'=>'sielbysam/price/', 'defaultParams'=>array('id'=>11, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/rolls/', 'defaultParams'=>array('id'=>11)),
				array('menu/index', 'pattern'=>'sielbysam/rolls/sort/', 'defaultParams'=>array('id'=>11, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/rolls/price/', 'defaultParams'=>array('id'=>11, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/pizza/', 'defaultParams'=>array('id'=>13)),
				array('menu/index', 'pattern'=>'sielbysam/pizza/sort/', 'defaultParams'=>array('id'=>13, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/pizza/price/', 'defaultParams'=>array('id'=>13, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/assortiment/', 'defaultParams'=>array('id'=>17)),
				array('menu/index', 'pattern'=>'sielbysam/assortiment/sort/', 'defaultParams'=>array('id'=>17, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/assortiment/price/', 'defaultParams'=>array('id'=>17, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/pasta/', 'defaultParams'=>array('id'=>14)),
				array('menu/index', 'pattern'=>'sielbysam/pasta/sort/', 'defaultParams'=>array('id'=>14, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/pasta/price/', 'defaultParams'=>array('id'=>14, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/goryachie/', 'defaultParams'=>array('id'=>22)),
				array('menu/index', 'pattern'=>'sielbysam/goryachie/sort/', 'defaultParams'=>array('id'=>22, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/goryachie/price/', 'defaultParams'=>array('id'=>22, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/wok/', 'defaultParams'=>array('id'=>24)),
				array('menu/index', 'pattern'=>'sielbysam/wok/sort/', 'defaultParams'=>array('id'=>24, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/wok/price/', 'defaultParams'=>array('id'=>24, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/soup/', 'defaultParams'=>array('id'=>15)),
				array('menu/index', 'pattern'=>'sielbysam/soup/sort/', 'defaultParams'=>array('id'=>15, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/soup/price/', 'defaultParams'=>array('id'=>15, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/shashlyki/', 'defaultParams'=>array('id'=>16)),
				array('menu/index', 'pattern'=>'sielbysam/shashlyki/sort/', 'defaultParams'=>array('id'=>16, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/shashlyki/price/', 'defaultParams'=>array('id'=>16, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/salat/', 'defaultParams'=>array('id'=>21)),
				array('menu/index', 'pattern'=>'sielbysam/salat/sort/', 'defaultParams'=>array('id'=>21, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/salat/price/', 'defaultParams'=>array('id'=>21, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/dessert/', 'defaultParams'=>array('id'=>23)),
				array('menu/index', 'pattern'=>'sielbysam/dessert/sort/', 'defaultParams'=>array('id'=>23, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/dessert/price/', 'defaultParams'=>array('id'=>23, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/napitki/', 'defaultParams'=>array('id'=>25)),
				array('menu/index', 'pattern'=>'sielbysam/napitki/sort/', 'defaultParams'=>array('id'=>25, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/napitki/price/', 'defaultParams'=>array('id'=>25, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/sushi/', 'defaultParams'=>array('id'=>56)),
				array('menu/index', 'pattern'=>'sielbysam/sushi/sort/', 'defaultParams'=>array('id'=>56, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/sushi/price/', 'defaultParams'=>array('id'=>56, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/grill/', 'defaultParams'=>array('id'=>58)),
				array('menu/index', 'pattern'=>'sielbysam/grill/sort/', 'defaultParams'=>array('id'=>58, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/grill/price/', 'defaultParams'=>array('id'=>58, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'sielbysam/burgers/', 'defaultParams'=>array('id'=>59)),
				array('menu/index', 'pattern'=>'sielbysam/burgers/sort/', 'defaultParams'=>array('id'=>59, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'sielbysam/burgers/price/', 'defaultParams'=>array('id'=>59, 'sort'=>'price')),


				array('menu/index', 'pattern'=>'omni-chajhana/', 'defaultParams'=>array('id'=>41)),

				array('menu/index', 'pattern'=>'omni-chajhana/zakuski/', 'defaultParams'=>array('id'=>45)),
				array('menu/index', 'pattern'=>'omni-chajhana/zakuski/sort/', 'defaultParams'=>array('id'=>45, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/zakuski/price/', 'defaultParams'=>array('id'=>45, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/osnovnye/', 'defaultParams'=>array('id'=>42)),
				array('menu/index', 'pattern'=>'omni-chajhana/osnovnye/sort/', 'defaultParams'=>array('id'=>42, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/osnovnye/price/', 'defaultParams'=>array('id'=>42, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/mangal/', 'defaultParams'=>array('id'=>40)),
				array('menu/index', 'pattern'=>'omni-chajhana/mangal/sort/', 'defaultParams'=>array('id'=>40, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/mangal/price/', 'defaultParams'=>array('id'=>40, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/soup/', 'defaultParams'=>array('id'=>43)),
				array('menu/index', 'pattern'=>'omni-chajhana/soup/sort/', 'defaultParams'=>array('id'=>43, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/soup/price/', 'defaultParams'=>array('id'=>43, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/salat/', 'defaultParams'=>array('id'=>44)),
				array('menu/index', 'pattern'=>'omni-chajhana/salat/sort/', 'defaultParams'=>array('id'=>44, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/salat/price/', 'defaultParams'=>array('id'=>44, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/garniry/', 'defaultParams'=>array('id'=>37)),
				array('menu/index', 'pattern'=>'omni-chajhana/garniry/sort/', 'defaultParams'=>array('id'=>37, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/garniry/price/', 'defaultParams'=>array('id'=>37, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/sushi/', 'defaultParams'=>array('id'=>36)),
				array('menu/index', 'pattern'=>'omni-chajhana/sushi/sort/', 'defaultParams'=>array('id'=>36, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/sushi/price/', 'defaultParams'=>array('id'=>36, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/dessert/', 'defaultParams'=>array('id'=>38)),
				array('menu/index', 'pattern'=>'omni-chajhana/dessert/sort/', 'defaultParams'=>array('id'=>38, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/dessert/price/', 'defaultParams'=>array('id'=>38, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'omni-chajhana/bar/', 'defaultParams'=>array('id'=>46)),
				array('menu/index', 'pattern'=>'omni-chajhana/bar/sort/', 'defaultParams'=>array('id'=>46, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'omni-chajhana/bar/price/', 'defaultParams'=>array('id'=>46, 'sort'=>'price')),


				array('menu/index', 'pattern'=>'benjamincafe/', 'defaultParams'=>array('id'=>49)),

				array('menu/index', 'pattern'=>'benjamincafe/goryachie/', 'defaultParams'=>array('id'=>51)),
				array('menu/index', 'pattern'=>'benjamincafe/goryachie/sort/', 'defaultParams'=>array('id'=>51, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/goryachie/price/', 'defaultParams'=>array('id'=>51, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/zakuski/', 'defaultParams'=>array('id'=>47)),
				array('menu/index', 'pattern'=>'benjamincafe/zakuski/sort/', 'defaultParams'=>array('id'=>47, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/zakuski/price/', 'defaultParams'=>array('id'=>47, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/salat/', 'defaultParams'=>array('id'=>48)),
				array('menu/index', 'pattern'=>'benjamincafe/salat/sort/', 'defaultParams'=>array('id'=>48, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/salat/price/', 'defaultParams'=>array('id'=>48, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/soup/', 'defaultParams'=>array('id'=>52)),
				array('menu/index', 'pattern'=>'benjamincafe/soup/sort/', 'defaultParams'=>array('id'=>52, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/soup/price/', 'defaultParams'=>array('id'=>52, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/garniry/', 'defaultParams'=>array('id'=>53)),
				array('menu/index', 'pattern'=>'benjamincafe/garniry/sort/', 'defaultParams'=>array('id'=>53, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/garniry/price/', 'defaultParams'=>array('id'=>53, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/dop-ingredient/', 'defaultParams'=>array('id'=>50)),
				array('menu/index', 'pattern'=>'benjamincafe/dop-ingredient/sort/', 'defaultParams'=>array('id'=>50, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/dop-ingredient/price/', 'defaultParams'=>array('id'=>50, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/dessert/', 'defaultParams'=>array('id'=>54)),
				array('menu/index', 'pattern'=>'benjamincafe/dessert/sort/', 'defaultParams'=>array('id'=>54, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/dessert/price/', 'defaultParams'=>array('id'=>54, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'benjamincafe/napitki/', 'defaultParams'=>array('id'=>55)),
				array('menu/index', 'pattern'=>'benjamincafe/napitki/sort/', 'defaultParams'=>array('id'=>55, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'benjamincafe/napitki/price/', 'defaultParams'=>array('id'=>55, 'sort'=>'price')),


				array('menu/index', 'pattern'=>'cambridgecafe/', 'defaultParams'=>array('id'=>20)),

				array('menu/index', 'pattern'=>'cambridgecafe/burgers/', 'defaultParams'=>array('id'=>57)),
				array('menu/index', 'pattern'=>'cambridgecafe/burgers/sort/', 'defaultParams'=>array('id'=>57, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/burgers/price/', 'defaultParams'=>array('id'=>57, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/rybnye/', 'defaultParams'=>array('id'=>32)),
				array('menu/index', 'pattern'=>'cambridgecafe/rybnye/sort/', 'defaultParams'=>array('id'=>32, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/rybnye/price/', 'defaultParams'=>array('id'=>32, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/pasta/', 'defaultParams'=>array('id'=>30)),
				array('menu/index', 'pattern'=>'cambridgecafe/pasta/sort/', 'defaultParams'=>array('id'=>30, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/pasta/price/', 'defaultParams'=>array('id'=>30, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/zakuski/', 'defaultParams'=>array('id'=>29)),
				array('menu/index', 'pattern'=>'cambridgecafe/zakuski/sort/', 'defaultParams'=>array('id'=>29, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/zakuski/price/', 'defaultParams'=>array('id'=>29, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/salat/', 'defaultParams'=>array('id'=>28)),
				array('menu/index', 'pattern'=>'cambridgecafe/salat/sort/', 'defaultParams'=>array('id'=>28, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/salat/price/', 'defaultParams'=>array('id'=>28, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/soup/', 'defaultParams'=>array('id'=>26)),
				array('menu/index', 'pattern'=>'cambridgecafe/soup/sort/', 'defaultParams'=>array('id'=>26, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/soup/price/', 'defaultParams'=>array('id'=>26, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/dessert/', 'defaultParams'=>array('id'=>33)),
				array('menu/index', 'pattern'=>'cambridgecafe/dessert/sort/', 'defaultParams'=>array('id'=>33, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/dessert/price/', 'defaultParams'=>array('id'=>33, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/dop-ingredient/', 'defaultParams'=>array('id'=>34)),
				array('menu/index', 'pattern'=>'cambridgecafe/dop-ingredient/sort/', 'defaultParams'=>array('id'=>34, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/dop-ingredient/price/', 'defaultParams'=>array('id'=>34, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/napitki/', 'defaultParams'=>array('id'=>35)),
				array('menu/index', 'pattern'=>'cambridgecafe/napitki/sort/', 'defaultParams'=>array('id'=>35, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/napitki/price/', 'defaultParams'=>array('id'=>35, 'sort'=>'price')),

				array('menu/index', 'pattern'=>'cambridgecafe/garnirs/', 'defaultParams'=>array('id'=>60)),
				array('menu/index', 'pattern'=>'cambridgecafe/garnirs/sort/', 'defaultParams'=>array('id'=>60, 'sort'=>'sort')),
				array('menu/index', 'pattern'=>'cambridgecafe/garnirs/price/', 'defaultParams'=>array('id'=>60, 'sort'=>'price')),

				'<controller:menu>/<id:\d+>' => '<controller>/index',

				'<controller:menu>/<action:index>/<id:\d+>/<sort:\w+>' => '<controller>/<action>',
				'<controller:menu>/<action:index>/<id:\d+>' => '<controller>/<action>',

				// default rules
				'http://<city>.milimon.dev/<controller:\w+>/<id:\d+>' => '<controller>/index',
				'http://<city>.milimon.dev/<controller:\w+>' => '<controller>/index',
				'http://<city>.milimon.dev/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'http://<city>.milimon.dev/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				// default rules
				'http://new.<city>.sushiport.ru/<controller:\w+>/<id:\d+>' => '<controller>/index',
				'http://new.<city>.sushiport.ru/<controller:\w+>' => '<controller>/index',
				'http://new.<city>.sushiport.ru/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
				'http://new.<city>.sushiport.ru/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		'user' => array(
			'allowAutoLogin' => true,
		),
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'cache'=>array('class'=>'system.caching.CFileCache'),

        'curlRequest' => array(
            'class' => 'ext.curl.CurlRequest'
        ),
	),
	'params' => array(
		'sailplay' => array(
			'store_department_id' => 1962,
			'store_department_key' => 78536707,
			'pin_code' => 6363,
		),
	)
);
