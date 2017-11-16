<?php

/**
 * This is the model class for table "menu".
 *
 * The followings are the available columns in table 'menu':
 * @property integer $id
 * @property integer $pid
 * @property integer $level
 * @property string $name
 * @property integer $visible
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $seotext
 */
class Menu extends EActiveRecord
{
	
	private $_depth = 1;
	
	public function getDepth() {
		return $this->_depth;
	}
	
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/menu/section/';
		$this->imagesUrl = '/data/menu/section/';
		$this->imageSizes = array(array(186, 160, false, CImageHandler::IMG_PNG));
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('pid, visible, level, cityId, popular', 'numerical', 'integerOnly'=>true),
			array('name, note', 'length', 'max'=>100),
			array('commentHeader, comment', 'length', 'max'=>255),
			array('title', 'safe'),
			array('description', 'safe'),
			array('keywords', 'safe'),
			array('h1', 'safe'),
			array('seotext', 'safe'),
// 			array('image', 'file', 'types'=>'jpg, gif, png'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, level, name, visible', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'selectMenu'=>array(self::HAS_MANY, 'SelectMenu', 'idCategory'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'pid' => Yii::t('main', 'Pid'),
			'name' => Yii::t('main', 'Name'),
			'level' => Yii::t('main', 'Level'),
			'visible' => Yii::t('main', 'Visible'),
			'image' => Yii::t('main', 'Image'),
			'popular' => 'Популярное',
			'commentHeader' => 'Заголовок комментария',
			'comment' => 'Комментарий',
			'note' => 'Примечание',
			'h1' => 'Заголовок h1',
			'title' => 'Заголовок страницы',
			'description' => 'Описание',
			'keywords' => 'Ключевые слова',
			'seotext' => 'Сеотекст',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('level',$this->level);
// 		$criteria->compare('name',$this->name,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('cityId',$this->cityId);

		$criteria->order = 'sort';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>40,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function recurciveDelete() {
		$currents = Menu::model()->findAll('pid=:pid', array(':pid'=>$this->id));
		foreach($currents AS $key => $val) {
			$val->recurciveDelete();
		}
		$dishes = Dish::model()->findAll('pid=:pid', array(':pid'=>$this->id));
		foreach($dishes AS $key => $val) {
			$val->deleteFull();
		}
		$this->deleteFull();
	}
	
	
	/*
	 * рекурсивный запрос к БД!!!
	 * всегда кэшировать при использовании!!!
	 */
	public function getSubSectionsId($id) {
		$sections = array($id);
		$connection = Yii::app()->db;
		$sql = "SELECT id FROM menu WHERE visible = 1 AND pid = ".$id;
		$command = $connection->createCommand($sql);
		$rows = $command->queryColumn();
		foreach($rows AS $key => $val) {
 			$sections = array_merge($sections, $this->getSubSectionsId($val));
		}
		
		return $sections;
	}
	
	public function getMainCat($id) {
		$cat = Menu::model()->findByPk($id);
		if (empty($cat->pid))
			return $cat->id;
		while(true) {
			if (empty($cat->pid))
				return $cat->id;
			$cat = Menu::model()->findByPk($cat->pid);
		}
	}
}
