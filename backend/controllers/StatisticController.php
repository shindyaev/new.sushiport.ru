<?php

class StatisticController extends RController
{
	public function actionMarket()
	{
		$dishes = false;
		if (!empty($_POST['periodStart']) && !empty($_POST['periodEnd'])) {
			$start = Yii::app()->dateFormatter->format('yyyy-MM-dd 00:00:00', $_POST['periodStart']);
			$end = Yii::app()->dateFormatter->format('yyyy-MM-dd 23:59:59', $_POST['periodEnd']);
			
			$sql = 'SELECT id FROM offers
					WHERE date >= "'.$start.'" AND date <= "'.$end.'"';
				
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$offers=$command->queryColumn();

			if (!empty($offers)) {
				$idOffers = implode(",", $offers);
				
				$sql = 'SELECT d.name, od.price , SUM(count) cn FROM `offersDishes` od 
						LEFT JOIN  dish d ON d.id = od.idDish
						WHERE od.idOffer IN ('.$idOffers.')
						GROUP BY `idDish`
						ORDER BY cn DESC';
				
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$dishes=$command->queryAll();
			}
		}
		
		$this->render('market', array('dishes' => $dishes));
	}
	
	public function actionVisit()
	{
		$yaData = false;
		$yaData2 = false;
		if (!empty($_POST['periodStart']) && !empty($_POST['periodEnd'])) {
			$start = Yii::app()->dateFormatter->format('yyyyMMdd', $_POST['periodStart']);
			$end = Yii::app()->dateFormatter->format('yyyyMMdd', $_POST['periodEnd']);
			
			
			$url = 'http://api-metrika.yandex.ru/stat/traffic/summary.json?id=2138128&pretty=1&oauth_token=05dd3dd84ff948fdae2bc4fb91f13e22&date1='.$start.'&date2='.$end;
			$ch = curl_init();
		
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
			curl_setopt($ch, CURLOPT_URL, $url);
		
			$data = curl_exec($ch);
			curl_close($ch);
				
			$yaData = json_decode($data);
			
			
			
			$url = 'http://api-metrika.yandex.ru/stat/sources/summary.json?id=2138128&pretty=1&oauth_token=05dd3dd84ff948fdae2bc4fb91f13e22&date1='.$start.'&date2='.$end;
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
			curl_setopt($ch, CURLOPT_URL, $url);
			
			$data = curl_exec($ch);
			curl_close($ch);
			
			$yaData2 = json_decode($data);
			
			
			
			$url = 'http://api-metrika.yandex.ru/stat/sources/phrases.json?id=2138128&pretty=1&oauth_token=05dd3dd84ff948fdae2bc4fb91f13e22&date1='.$start.'&date2='.$end;
			
			$ch = curl_init();
				
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
			curl_setopt($ch, CURLOPT_URL, $url);
				
			$data = curl_exec($ch);
			curl_close($ch);
				
			$yaData3 = json_decode($data);
			
		}
	
		$this->render('visit', array('yaData' => $yaData, 'yaData2' => $yaData2, 'yaData3' => $yaData3,));
	}
}