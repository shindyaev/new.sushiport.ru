<?php
class FileController extends RController
{
	public function actionUpload() {
		
		$_FILES['file']['type'] = strtolower($_FILES['file']['type']);
		
		if ($_FILES['file']['type'] == 'image/png'
		|| $_FILES['file']['type'] == 'image/jpg'
		|| $_FILES['file']['type'] == 'image/gif'
		|| $_FILES['file']['type'] == 'image/jpeg'
		|| $_FILES['file']['type'] == 'image/pjpeg')
		{
			$directory = Yii::app()->basePath."/www/data/redactor/images/";
	
			$file = md5(date('YmdHis')).'.'.pathinfo(@$_FILES['file']['name'], PATHINFO_EXTENSION);
			
			if (move_uploaded_file(@$_FILES['file']['tmp_name'], $directory.$file)) {
				$array = array(
					'filelink' => '/data/redactor/images/'.$file
				);
			}
			
			echo CJSON::encode($array);
			Yii::app()->end();
		}
	}
}