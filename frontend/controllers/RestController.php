<?php

class RestController extends FController
{
	
	public function actionIndex()
	{
		
		$restorans = Restoran::model()->findAll(['condition' => 'visible = 1', 'order' => 'sort']);

		$model = MainMenu::model()->findByPk(65);

		$this->variables['title'] = $model->title;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;
		$this->variables['h1'] = $model->h1;
		
		$dishes = [];
		foreach ($restorans AS $key => &$val) {
			$tmp = Dish::model()->findAll([
					'condition' => 'root_cat = :root_cat AND  visible = 1 AND recommended = 1',
					'params' => [':root_cat' => $val->menu],
					'order' => 'RAND()',
					'limit' => 3
			]);
			$dishes[$val->id] = $tmp;
			
			$val['wt'] = unserialize($val['wt']);
			
			$n_day = date('N') - 1;
			$from_work  = explode(":", $val['wt'][$n_day]['from']);
			$from_work = $from_work[0] * 60 + $from_work[1];
			$to_work  = explode(":", $val['wt'][$n_day]['to']);
			$to_work = $to_work[0] * 60 + $to_work[1];
			
			if ($from_work > $to_work)
				$to_work += 60 * 24;
			
			$time = date("H") * 60 + date("i");
			
			if ($time < 180)
				$time += 60 * 24;
			
			if ($time > $from_work && $time < $to_work) {
				$val['workTime'] = 'Работает сейчас';
				$val['work'] = 1;
			} else {
				$val['workTime'] = 'Работает с '.$val['wt'][$n_day]['from'];
				$val['work'] = 0;
			}
		}
		
		$this->render("index", ['restorans' => $restorans, 'dishes' => $dishes]);
	}
	
}
