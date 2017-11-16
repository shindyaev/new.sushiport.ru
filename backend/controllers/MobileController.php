<?php

class MobileController extends RController
{
	protected $file_dir = '';
	
	protected function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
				
			$this->file_dir = $_SERVER['DOCUMENT_ROOT'].'/../../../www/api.gedza.ru/';
				
			return true;
		}
		return false;
	}
	
	public function actionIndex()
	{

		// время обновления меню
		$data['last_update_time'] = filemtime($this->file_dir.'all_data.json');
		
		// версия меню
		$data['data_version'] = (int)file_get_contents($this->file_dir.'version.txt');
		
		$this->render('index', $data);
	}
	
	public function actionUpdate() {
		
		$all_data	= array();
		$total_rows	= 0;
		
		// подключаем города
		$citys = City::model()->findAll();
		foreach ($citys AS $key => $val) {
			$all_data['cities'][] = array('id' => (int)$val['id'], 'title' => $val['name']);
			$total_rows++;
		}
		
		// подключаем категории
		$criteria = new CDbCriteria();
		$criteria->condition = 'pid IN (140, 142) AND visible = 1';
		$criteria->order = 'sort';
		$cats = Menu::model()->findAll($criteria);
		
		$all_data['categories'] = array();
		foreach ($cats AS $key => $val) {
			$cat = array(	'id' => (int)$val['id'], 
							'sort' => (int)$val['sort'], 
							'title' => $val['name'], 
							'image_path' => 'http://gedza.ru/data/menu/section/admin_preview/'.$val['id'].'.jpg',
							'image_path_ver' => 'http://gedza.ru/data/menu/section/admin_preview/'.$val['id'].'.jpg', 
							'in_cities' => array((int)$val['cityId']));
			
			$total_rows += 2;
			
			$criteria = new CDbCriteria();
			$criteria->condition = 'pid = :pid AND visible = 1';
			$criteria->params = array(':pid' => $val['id']);
			$criteria->order = 'sort';
			$dishs = Dish::model()->findAll($criteria);
			$cat['dishes_list'] = array();
			foreach ($dishs AS $k => $v) {
				$dish = array(	'id' => (int)$v['id'], 
								'title' => $v['name'], 
								'note' => $v['text'], 
								'weight' => $v['weight'],
								'image_path' => 'http://gedza.ru'.$v->imagesUrl."229x229/".$v['id'].".jpg",
								'image_path_ver' => 'http://gedza.ru'.$v->imagesUrl."229x229/".$v['id'].".jpg",
								'big_image_path' => 'http://gedza.ru'.$v->imagesUrl."500x500/".$v['id'].".jpg",
								'big_image_path_ver' => 'http://gedza.ru'.$v->imagesUrl."500x500/".$v['id'].".jpg",
								'in_cities' => array(array('city_id' => (int)$v['cityId'], 'visible' => '1', 'price' => (int)$v['price'])),
							);
				$cat['dishes_list'][] = $dish;
				
				$total_rows += 2;
			}
			
			$all_data['categories'][] = $cat;
		}
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'visible = 1 AND NOW() BETWEEN dateStart AND dateEnd';
		$actions = News::model()->findAll($criteria);
		
		$all_data['actions'] = array();
		foreach ($actions AS $key => $val) {
			$action = array(	'id' => (int)$val['id'],
								'category_id' => (int)$val['pid'],
								'title' => $val['name'],
								'text' => $val['text'],
								'date_start' => strtotime($val['dateStart']),
								'date_finish' => strtotime($val['dateEnd']),
								'in_cities' => array($val['cityId']),
								'image_path' => 'http://gedza.ru'.$val->imagesUrl."680x/".$val['id'].".jpg",
								'image_path_ver' => 'http://gedza.ru'.$val->imagesUrl."680x/".$val['id'].".jpg",
			);
			$all_data['actions'][] = $action;
			$total_rows += 2;
		}
		
		$all_data['actions_categories'] = array(
				array('id' => 1, 'title' => 'В ресторане'),
				array('id' => 2, 'title' => 'На доставке'),
		);
		$total_rows += 2;
		
		$all_data['restourants'] = array(
			
				array(	'id' => 1,
						'city_id' => 1,
						'address' => 'Молодогвардейская улица, 182',
						'phone' => '+7 (846) 270-07-66',
						'worktime' => 'Воскресенье - четверг с 12:00 до 00:00 Пятница - суббота с 12:00 до 02:00',
						'latitude' => 53.199789,
						'longitude' => 50.104775,
						'images_list' => array(),
				),
				array(	'id' => 2,
						'city_id' => 1,
						'address' => 'Московское шоссе, 252',
						'phone' => '+7 (846) 203-00-00',
						'worktime' => 'Воскресенье - четверг с 12:00 до 00:00 Пятница - суббота с 12:00 до 02:00',
						'latitude' => 53.244494,
						'longitude' => 50.210866,
						'images_list' => array(),
				),
				array(	'id' => 3,
						'city_id' => 2,
						'address' => 'ул. Октябрьской революции, 78',
						'phone' => '+7 (347) 246-4-246',
						'worktime' => 'Воскресенье - четверг с 12:00 до 02:00 Пятница - суббота с 12:00 до 05:00',
						'latitude' => 54.713652,
						'longitude' => 55.962356,
						'images_list' => array(),
				),
				array(	'id' => 4,
						'city_id' => 2,
						'address' => 'ул. Свердлова, 90',
						'phone' => '+7 (347) 246-4-246',
						'worktime' => 'Воскресенье - четверг с 11:00 до 02:00 Пятница - суббота с 11:00 до 06:00',
						'latitude' => 54.725425375734,
						'longitude' => 55.938236472568,
						'images_list' => array(),
				)
		);
		$total_rows += 4;
		
		
		$current_version	= (int)file_get_contents($this->file_dir.'version.txt');
		
		$new_version = $current_version + 1;
		
		// для удобства подключаем номер версии БД
		$all_data['version'] = $new_version;
			
		// а также общее количество записей (для удобства прогресс-бара)
		$all_data['total_rows']	= $total_rows;
		
		// пишем в файлик
		file_put_contents($this->file_dir.'all_data.json', json_encode($all_data));
		file_put_contents($this->file_dir.'version.txt', $new_version);
		
		
		$this->redirect("/mobile/");
	}
	
}
