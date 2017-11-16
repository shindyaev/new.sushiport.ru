<?php
/**
 *
 * SessionController class
 *
 */

class SessionController extends CController
{

	protected $availableSessionNames=['sailplay_gifts'];

	public function actionGetSessionData()
	{
		$result = [];

		$neededData = (array) Yii::app()->request->getQuery('session_data');

		foreach ($neededData as $data) {
			if (in_array($data, $this->availableSessionNames)) {
				$result[$data] = Yii::app()->session[$data];
			}
		}

		$this->renderJson($result);

	}

	/**
	 * Возвращаем ответ в формате JSON
	 *
	 * @param array $array
	 */
	public function renderJson($array) {

		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode($array);

		Yii::app()->end();
	}
}