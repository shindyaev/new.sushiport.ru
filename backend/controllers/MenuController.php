<?php
/**
 *
 * MenuController class
 *
 */
class MenuController extends RController
{
	public function actionIndex($id = 0)
	{
		$modelDish = false;
		$currentSection = false;
		$modelMenu = new Menu();
		$modelMenu->cityId = (int)Yii::app()->request->cookies['city_id']->value;
		$modelMenu->pid = $id;
		if (!empty($id)) 
		{
			$currentSection = $this->loadModel('Menu', $id);
			if ($currentSection->cityId != (int)Yii::app()->request->cookies['city_id']->value) {
				$this->redirect('/menu/');
			}
			$this->breadcrumbs = $this->buildBreadkrumbsCatalog($currentSection);
			if ($currentSection->level == $currentSection->depth) {
				$modelDish = new Dish();
				$modelDish->pid = $id;
				$modelDish->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			}
		} else {
			$this->breadcrumbs[] = 'Меню';
		}
		
		$this->render('index', array('modelMenu' => $modelMenu, 'currentSection' => $currentSection, 'modelDish' => $modelDish));
	}
	
	public function actionSection($pid = 0, $id = false) 
	{
		if ($id !== false) 
		{
			$header = 'Редактировать раздел';
			$model = $this->loadModel('Menu', $id);
			$first = false;
		}
		else
		{
			$header = 'Добавить раздел';
			$model = new Menu();
			$first = true;
		}
		
		if(isset($_POST['Menu'])) {
			$model->attributes=$_POST['Menu'];
			
			if (!empty($pid)) {
				$parent_cat = Menu::model()->findByPk($pid);
			}
			
			if (!empty($parent_cat) && !empty($parent_cat->root_cat))
				$model->root_cat = $parent_cat->root_cat;
			else if (!empty($parent_cat) && empty($parent_cat->root_cat))
				$model->root_cat = $parent_cat->id;
			
			$model->pid = $pid;
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			
			if (!empty($pid)) {
				$parentMenu = $this->loadModel('Menu', $pid);
				$model->level = $parentMenu->level + 1; 
			}
			
			if($model->save()) {
				if ($first) {
					$model->sort = $model->id;
					$model->save();
				}
				if (!empty($_FILES['Menu']['tmp_name']['image'])) {
					$model->saveImage($_FILES['Menu']['tmp_name']['image'], true);
				}
				$this->redirect($this->createUrl('menu/index', array('id' => $pid)));
			}
		}
		
		if (!empty($pid)) {
			$currentSection = $this->loadModel('Menu', $pid);
			$this->breadcrumbs = $this->buildBreadkrumbsCatalog($currentSection, true);
			$this->breadcrumbs[] = $header;
		} else {
			$this->breadcrumbs=array(
				'Меню' => $this->createUrl('menu/index'),
				$header
			);
		}
		
		$this->render('section', array('header' => $header, 'model' => $model));
	}
	
	private function buildBreadkrumbsCatalog($parentSection, $lastLink = false) {
		if ($lastLink)
			$breadcrumbs[$parentSection->name] = $this->createUrl('menu/index', array('id'=>$parentSection->id));
		else 
			$breadcrumbs[] = $parentSection->name;
		
		while(true)
		{
			if (empty($parentSection->pid))
			{
				break;
			}
			$parentSection = $this->loadModel('Menu', $parentSection->pid);
			$breadcrumbs[$parentSection->name] = $this->createUrl('menu/index', array('id'=>$parentSection->id));
		}
		$breadcrumbs['Меню'] = $this->createUrl('menu/index');
		$breadcrumbs = array_reverse($breadcrumbs);
		return $breadcrumbs;
	}

	public function actionDish($pid, $id = false) {
		if ($id !== false) 
		{
			$header = 'Редактировать блюдо';
			$model = $this->loadModel('Dish', $id);
			$first = false;
		}
		else
		{
			$header = 'Добавить блюдо';
			$model = new Dish();
			$first = true;
		}
		$model->pid = $pid;
		
		if(isset($_POST['Dish'])) {
			$model->attributes=$_POST['Dish'];
			$model->cityId = (int)Yii::app()->request->cookies['city_id']->value;
			
			if (!empty($pid)) {
				$parent_cat = Menu::model()->findByPk($pid);
				$model->root_cat = $parent_cat->root_cat; 
			}
			
			$model->rest = Menu::model()->getMainCat($model->pid);
			
			if($model->save()) {
				if ($first) {
					$model->sort = $model->id;
					$model->save();
				}
				if (!empty($_FILES['Dish']['tmp_name']['image'])) {
					$model->saveImage($_FILES['Dish']['tmp_name']['image'], true);
				}
				
				$this->redirect($this->createUrl('menu/index', array('id' => $pid)));
			}
		}
		

		$currentSection = $this->loadModel('Menu', $pid);
		$this->breadcrumbs = $this->buildBreadkrumbsCatalog($currentSection, true);
		$this->breadcrumbs[] = $header;
		
		$this->render('dish', array('header' => $header, 'model' => $model));
	}
	
	public function actionDeleteDish($id) {
		$dish = $this->loadModel('Dish', $id);
		$pid = $dish->pid;
		$dish->deleteFull();
		$this->redirect($this->createUrl('menu/index', array('id' => $pid)));
	}
	
	public function actionDeleteSection($id) {
		$section = $this->loadModel('Menu', $id);
		$pid = $section->pid;
		$section->recurciveDelete();
		$this->redirect($this->createUrl('menu/index', array('id' => $pid)));
	}
	
	public function actionSaveSortSection() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE menu SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
	public function actionSaveSortDish() {
	
		$data = $_POST['data'];
	
		foreach ($data AS $key => $val) {
			$connection=Yii::app()->db;
			$command=$connection->createCommand("UPDATE dish SET sort = ".(int)$key." WHERE id = ".(int)$val);
			$command->execute();
		}
	
		echo CJSON::encode(
				1
		);
		Yii::app()->end();
	}
	
	public function actionCopyMenu() {
		die("AA");
		$models = Menu::model()->findAll('pid = 140 AND id IN (132,134,137)');
		foreach ($models AS $key => $val) {
			$menu = new Menu();
			$menu->pid = 141;
			$menu->level = 1;
			$menu->name = $val->name;
			$menu->visible = $val->visible;
			$menu->sort = $val->sort;
			$menu->cityId = $val->cityId;
			$menu->popular = $val->popular;
			$menu->commentHeader = $val->commentHeader;
			$menu->comment = $val->comment;
			$menu->note = $val->note;
			
			$menu->save();
			
			if (file_exists($val->imagesPath."original/".$val['id'].".jpg"))
				$menu->saveImage($val->imagesPath."original/".$val['id'].".jpg", true);
			
			$dishs = Dish::model()->findAll('pid = '.$val['id']);
			foreach ($dishs AS $k => $v) {
				$dish = new Dish();
				$dish->pid = $menu->id;
				$dish->name = $v->name;
				$dish->text = $v->text;
				$dish->price = $v->price;
				$dish->weight = $v->weight;
				$dish->weightType = $v->weightType;
				$dish->recommended = $v->recommended;
				$dish->hit = $v->hit;
				$dish->hot = $v->hot;
				$dish->vegan = $v->vegan;
				$dish->rest = $v->rest;
				$dish->new = $v->new;
				$dish->visible = $v->visible;
				$dish->sort = $v->sort;
				$dish->cityId = $v->cityId;
				
				$dish->save(false);
				
				if (file_exists($v->imagesPath."original/".$v['id'].".jpg"))
					$dish->saveImage($v->imagesPath."original/".$v['id'].".jpg", true);
			
			}
			
			
		}
		die('finish');
	}
}
