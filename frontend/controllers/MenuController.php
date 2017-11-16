<?php
/**
 *
 * MenuController class
 *
 */
class MenuController extends FController
{
	
	public function actionIndex($id = false, $sort = 'sort')
	{
		$sortArray = array('sort' => 'sort', 'price' => 'price');
		$this->menuActiveItems[FController::MENU_MENU_ITEM] = 1;

		$model = Menu::model()->findByPk($id);

		$this->variables['title'] = $model->title;
		$this->variables['description'] = $model->description;
		$this->variables['keywords'] = $model->keywords;
		$this->variables['h1'] = $model->h1;
		$this->variables['seotext'] = $model->seotext;

		if ($model->root_cat > 0)
			$rest = Menu::model()->findByPk($model->root_cat);
		else 
			$rest = $model;

		if ($rest->visible == 0)
			$this->redirect("/");

		$uri_array = parse_url($_SERVER['REQUEST_URI']);
		if (
			!empty($model)
			&& !empty($model->link)
			&&
			(
				$model->link != $uri_array['path']
				&& $model->link.$sort.'/' != $uri_array['path']
			)
		) {
			$this->redirect($model->link, true, 301);
		}

		if (empty($id) || (!empty($id) && empty($model)) || $model->cityId != (int)Yii::app()->request->cookies['city_id']->value) {
			$criteria = new CDbCriteria();
			$criteria->condition = "visible = 1 AND cityId = ".(int)Yii::app()->request->cookies['city_id']->value;
			$criteria->order = "sort";
			$menu = Menu::model()->find($criteria);
			$this->redirect('/menu/'.$menu->id.'/', true, 301);
		}
		
		if (!empty($model) && empty($model->pid)) {
			$criteria = new CDbCriteria();
			$criteria->condition = "visible = 1 AND pid = :pid AND cityId = ".(int)Yii::app()->request->cookies['city_id']->value;
			$criteria->order = "sort";
			$criteria->params = [':pid' => $model->id];
			$menu = Menu::model()->find($criteria);
			$this->redirect('/menu/'.$menu->id.'/', true, 301);
		}
		
		$restoran = Restoran::model()->find([
						'condition' => 'menu = :menu',
						'params' => [':menu' => $model->root_cat]				
		]);
		
		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND popular = 1 AND cityId = :cityId AND pid = :pid";
		$criteria->params = array(":cityId" => (int)Yii::app()->request->cookies['city_id']->value, ':pid' => $model->pid);
		$criteria->order = "sort";
		$popularMenuItems = Menu::model()->findAll($criteria);
		
		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND popular != 1 AND cityId = :cityId AND pid = :pid";
		$criteria->params = array(":cityId" => (int)Yii::app()->request->cookies['city_id']->value, ':pid' => $model->pid);
		$criteria->order = "sort";
		$menuItems = Menu::model()->findAll($criteria);
		
		
		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND pid = :pid AND cityId = :cityId";
		$criteria->params = array(':pid' => $id, ':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
		if (!empty($sortArray[$sort]))
			$criteria->order = $sort;
		else 
			$criteria->order = 'sort';
		$dishList = Dish::model()->findAll($criteria);

		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND recommended = 1 AND cityId = :cityId AND rest= :restId";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value, ':restId' => (int)$restoran->menu);
		$criteria->order = "RAND()";
		if ($restoran->id == 3) {
			$criteria->limit = 5;
		}
		else {
			$criteria->limit = 4;
		}
		$recommendedList = Dish::model()->findAll($criteria);


		/*if (empty($recommendedList)) {
			$criteria->condition = "visible = 1 AND recommended = 1 AND cityId = :cityId";
			$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);

			$recommendedList = Dish::model()->findAll($criteria);
		}*/

		$juiceID = array();
		$juiceID[6] = array(200, 612);
		$juiceID[5] = array(454, 460);
		$juiceID[1] = array(529, 536);
		$juiceID[3] = array(327);
		$juiceID[2] = array(327);
		if (isset($juiceID[$restoran->id])) {
			$criteria = new CDbCriteria();
			$criteria->condition = "id IN (".implode(',', $juiceID[$restoran->id]).")";
			$criteria->order = "RAND()";
			$criteria->limit = 2;
			$recommendedJuiceList = Dish::model()->findAll($criteria);
			$recommendedList = array_merge($recommendedJuiceList, $recommendedList);
		}
		
		$showedDish = false;
		if (!empty(Yii::app()->request->cookies['showedDish']))
			$showedDish = json_decode(Yii::app()->request->cookies['showedDish']->value);
		$showedList = array();
		if (!empty($showedDish)) {
			$criteria = new CDbCriteria();
			$criteria->condition = "visible = 1 AND id IN (".implode(",", $showedDish).") = 1 AND cityId = :cityId";
			$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value);
			$criteria->limit = 6;
			$showedList = Dish::model()->findAll($criteria);
		}

		$criteria = new CDbCriteria();
		$criteria->condition = "visible = 1 AND cityId = :cityId AND count > 0 AND dateEnd > NOW() AND categoryId = :categoryId";
		$criteria->params = array(':cityId' => (int)Yii::app()->request->cookies['city_id']->value, ':categoryId' => $id);
		$criteria->order = "RAND()";
		$action =  DishAction::model()->find($criteria);

		if ($action) {
			$action->dish['action'] = $action;
			array_splice($dishList, 3, 0, array($action->dish));
		}
		
		$likeDish = array();
		if (!Yii::app()->user->isGuest) {
			$likeDish = LikeDish::model()->findAll('userId = :userId', array(':userId' => Yii::app()->user->id));
			$likeDish = CHtml::listData($likeDish, 'dishId', 'dishId');
		}
		
		$settings = new Settings();
		
		$this->render('dishList', array('popularMenuItems' => $popularMenuItems,
										'menuItems' => $menuItems,
										'model' => $model,
										'dishList' => $dishList,
										'recommendedList' => $recommendedList,
										'showedList' => $showedList,
										'likeDish' => $likeDish,
										'id' => $id,
										'sort' => $sort,
										'settings' => $settings,
										'restoran' => $restoran,
		));
		
	}
	
	public function actionAddToLike() {
		if (!Yii::app()->user->isGuest) {
			$id = $_POST['dishId'];
			$ld = new LikeDish();
			$ld->userId = Yii::app()->user->id;
			$ld->dishId = (int)$id;
			$ld->save();
		}
		echo CJSON::encode(
			1
		);
		Yii::app()->end();
	}
	
	public function actionRemoveToLike() {
		if (!Yii::app()->user->isGuest) {
			$id = $_POST['dishId'];
			$ld = LikeDish::model()->find('userId = :userId AND dishId = :dishId', array(':userId' => Yii::app()->user->id, ':dishId' => (int)$id));
			$ld->delete();
		}
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
// 	public function sectionList() {
// 		$criteria=new CDbCriteria;
// 		$criteria->order = "id ASC";
// 		$criteria->condition = "visible = 1 AND level = 0";
// 		$criteria->order = 'sort';
// 		$sections = Menu::model()->findAll($criteria);
		
// 		return $this->renderPartial("sectionListBlock", array('sections' => $sections), true);
// 	}
	
// 	public function cart() {
// 		return $this->renderPartial('cart', array(), true);
// 	}
	
// 	public function recommendedBlock() {
// 		$criteria=new CDbCriteria;
// 		$criteria->order = "RAND()";
// 		$criteria->condition = "visible = 1 AND recommended = 1";
// 		$criteria->limit = 3;
// 		$dish = Dish::model()->findAll($criteria);
	
// 		if ($dish)
// 			return $this->renderPartial("recommendedBlock", array('dish' => $dish), true);
// 		return '';
// 	}
	
// 	public function sectionLeftMenu($section = false) {
// 		$pid = 0;
// 		if (!empty($section)) {
// 			$pid = $section->id;
// 			if ($section->level == 1)
// 				$pid = $section->pid;
// 		}
			
// 		$connection = Yii::app()->db;
// 		$command = $connection->createCommand('SELECT * , 100 * ( IF( pid = 0, id, pid ) ) + id AS srt
// 													FROM  `menu`
// 													WHERE visible = 1 AND
// 													(level = 0 OR pid = '.$pid.')
// 													ORDER BY sort, srt');
// 		$menuItems = $command->queryAll();
			
// 		return $this->renderPartial('sectionLeftMenu', array("menuItems" => $menuItems, "section" => $section), true);
// 	}
	
}
