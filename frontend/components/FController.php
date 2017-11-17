<?php
/**
 * FController class
 */
class FController extends EController
{
	const MENU_MENU_ITEM = "menu";
	const ACTION_MENU_ITEM = "action";
	const NEWS_MENU_ITEM = "news";
	const TEAM_MENU_ITEM = "team";
	const REVIEW_MENU_ITEM = "review";

	
	public $variables = array();
	public $menuActiveItems = array();

	public function behaviors(){
		return array(
			'sailplayBehavior' => array(
				'class' => 'SailplayBehavior',
			),
		);
	}

	protected function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
			
			$this->variables['title'] = "";
			$this->variables['headline'] = "";
			$this->variables['keywords'] = "";
			$this->variables['description'] = "";
			
			$seo = Yii::app()->urlManager->seo;

			if (!empty($seo)) {
				$this->variables['title'] = $seo->title;
				$this->variables['headline'] = $seo->headline;
				$this->variables['keywords'] = $seo->keywords;
				$this->variables['description'] = $seo->description;
			}


				$citys = City::model()->findAll();
				$firstCity = $citys[0];
				$this->variables['citysFull'] = $citys;
				$citys = CHtml::listData($citys, 'id', 'name');
				$this->variables['citys'] = $citys;

				$this->variables['firstVisit'] = true;
				if (!empty(Yii::app()->request->cookies['firstVisit']))
					$this->variables['firstVisit'] = false;

				Yii::app()->request->cookies['firstVisit'] = new CHttpCookie('firstVisit', '1', array('expire' => time() + (60 * 60 * 24) * 360));

				if (isset($_REQUEST['city'])) {
					#$city = City::model()->findByAttributes('alias = :alias', ['alias' => $_REQUEST['city']]);
					#$city = Yii::app()->db->createCommand('SELECT id, alias, phone, email, name, nameR, nameD FROM citys WHERE alias = "' . htmlspecialchars($_REQUEST['city'], ENT_QUOTES) . '";')->queryRow();

					#$city = City::model()->findByPk(1);
					$city = City::model()->find('alias = :alias', array(':alias' => $_REQUEST['city']));
					$city_id = (int)$city->id;

					$this->variables['city'] = $citys[$city_id];
					$this->variables['phone'] = $city->phone;
					$this->variables['city-id'] = (int)$city->id;
					$this->variables['city-r'] = $city->nameR;
					$this->variables['city-d'] = $city->nameD;
					Yii::app()->request->cookies['city_id'] = new CHttpCookie('city_id', $city->id, array('expire' => time() + (60 * 60 * 24) * 360));
					$settings = new Settings();


				}
				else {
					if (!empty(Yii::app()->request->cookies['city_id']))
						$city_id = (int)Yii::app()->request->cookies['city_id']->value;
					if (!empty($city_id)) {
						$this->variables['city'] = $citys[$city_id];
					} else {
						$this->variables['city'] = $firstCity->name;
						Yii::app()->request->cookies['city_id'] = new CHttpCookie('city_id', $firstCity->id, array('expire' => time() + (60 * 60 * 24) * 360));
						$city_id = $firstCity->id;
					}

					$settings = new Settings();
					if ($city_id == 1) {
						$this->variables['phone'] = $settings->phoneSmr;
					}

					if ($city_id == 2) {
						$this->variables['phone'] = $settings->phoneUfa;
					}
					$this->variables['city-id'] = $city_id;
					$this->variables['city-r'] = '';
					if ($this->variables['city-id'] == 1) {
						$this->variables['city-r'] = 'Самары';
						$this->variables['city-d'] = 'Самаре';
					}
					if ($this->variables['city-id'] == 2) {
						$this->variables['city-r'] = 'Уфы';
						$this->variables['city-d'] = 'Уфе';
					}
				}
			#die(var_dump($this->variables));
				$this->variables['emailModel'] = new Email();
				$this->variables['writeModel'] = new Write();
				$this->variables['callMeModel'] = new CallMe();
				$this->variables['androidLink'] = $settings->androidLink;
				$this->variables['iphoneLink'] = $settings->iphoneLink;
				$this->variables['restoransText'] = $settings->restoransText;
			
			

			// sail Play
//			$this->variables['sailPlayPublicKey'] = Yii::app()->session['sailPlayPublicKey'];
//			Yii::app()->session['sailPlayPublicKey'] = "none";
//
//			$sailPlayFirstPopap = Yii::app()->session['sailPlayFirstPopap'];
//			$this->variables['sailPlayFirstPopap'] = 0;
//			if (empty(Yii::app()->session['sailPlayFirstPopap']))
//				$this->variables['sailPlayFirstPopap'] = 1;
//			Yii::app()->session['sailPlayFirstPopap'] = 1;
//
//
//
//			$connection=Yii::app()->db;
//
//			$command=$connection->createCommand('SELECT * FROM sailPlayAuth WHERE id = 1');
//			$sailPlayAuth = $command->queryRow();
//
//			$time = strtotime($sailPlayAuth['date']);
//			$nowTime = strtotime('now');
//			$diff = $nowTime - $time;
//
//			if ($diff > 12*60*60 || empty($sailPlayAuth['token'])) {
//
//				$url = "http://sailplay.ru/api/v1/login/?store_department_key=78536707&store_department_id=1962&pin_code=6363";
//				$ch = curl_init();
//				curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
//				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
//				curl_setopt($ch, CURLOPT_TIMEOUT, 5); // times out after 4s
// 				$result = curl_exec($ch); // run the whole process
//				curl_close($ch);
//				$result = json_decode($result);
//
//				$sql = "UPDATE sailPlayAuth SET token = '".$result->token."', date = NOW() WHERE id = 1";
//
//				$command=$connection->createCommand($sql);
//				$rowCount=$command->execute();
//
//				$this->variables['sailPlayAuthToken'] = $result->token;
//			} else {
//				$this->variables['sailPlayAuthToken'] = $sailPlayAuth['token'];
//			}
//
//			// sail Play

			if ($token = $this -> sailplayBehavior -> getToken()) {
				$this->variables['sailPlayAuthToken'] = $token;
			}

			$user = Yii::app()->getUser();
			if (
				$user->id
				and !empty($user->allowSailPlay)
				and empty(Yii::app()->session['sailPlayAuthHash'])
				and $userAuthHash = $this->sailplayBehavior->getUserAuthHash($token, $user)
			) {

				Yii::app()->session['sailPlayAuthHash'] = $userAuthHash;

			}

			if (!empty(Yii::app()->session['sailPlayAuthHash'])) {

				$this->variables['sailPlayAuthHash'] = Yii::app()->session['sailPlayAuthHash'];

			}

			//sil Play
			
			$criteria = new CDbCriteria();
			$criteria->condition = 'visible = 1 AND cityId = '.(int)$city_id;
			$criteria->order = "pid, sort";
			$mainMenu = MainMenu::model()->findAll($criteria);
			$mainMenuList = array();
			foreach ($mainMenu AS $key => $val){
				if ($val['pid'] == 0)
					$mainMenuList[$val['id']] = array('name' => $val['name'], 'link' => $val['link'], 'active' => '', 'text' => $val['text']);
				else 
					$mainMenuList[$val['pid']]['submenuList'][$val['id']] = array('name' => $val['name'], 'link' => $val['link'], 'text' => $val['text']);
				
//				if ($_SERVER['REQUEST_URI'] == $val['link']) {
				if ($val['selected'] == 1) {
					if ($val['pid'] == 0)
						$mainMenuList[$val['id']]['active'] = 'active';
					else
						$mainMenuList[$val['pid']]['active'] = 'active';
				}
			}
			$this->variables['mainMenuList'] = $mainMenuList;

			if (!empty(Yii::app()->user->id)) {
				$likeDishCount = LikeDish::model()->count('userId = :userId', array(':userId' => Yii::app()->user->id));
				
				$this->variables['likeDishCount'] = $likeDishCount;
			}
			
			
			
			
			$restorans = Restoran::model()->findAll();
			
			foreach ($restorans AS $key => &$val) {
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
					$val['work'] = 1;
				} else {
					$val['work'] = 0;
				}
			}
			
			$this->variables['restorans'] = $restorans;
			
			
			
// 			var_dump($_SERVER);
// 			die();
			return true;
		}
		return false;
	}
	
	public function createCPUUrl($url) {
		return Yii::app()->urlManager->createCPUUrl($url);
	}
	
}
