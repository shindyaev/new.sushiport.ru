<?php
/**
 *
 * SettingsController class
 */
class SettingsController extends RController
{
	public function actionIndex()
	{
		$settings = new Settings();

		if(isset($_POST['Settings'])) {

			$settings->attributes=$_POST['Settings'];
			
			$this->performAjaxValidation($settings);
			if($settings->save()) {
				$err = false;
			} else {
				$err = true;
			}
			echo CJSON::encode(
				array(
					'error'=>$err,
				)
			);
			Yii::app()->end();
			
		}
		
		$this->render('index', array('settings' => $settings));
	}
}
