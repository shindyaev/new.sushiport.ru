<?php

/**
 * This is the model class for table "mainMenu".
 *
 * The followings are the available columns in table 'mainMenu':
 * @property integer $id
 * @property integer $pid
 * @property integer $level
 * @property string $name
 * @property string $link
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property integer $visible
 * @property integer $sort
 * @property integer $cityId
 */
class MainMenu extends EActiveRecord
{
	private $_depth = 1;
	
	public function getDepth() {
		return $this->_depth;
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mainMenu';
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
			array('pid, level, visible, sort, cityId, selected', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			array('text', 'length', 'max'=>255),
			array('link', 'safe'),
			array('title', 'safe'),
			array('description', 'safe'),
			array('h1', 'safe'),
			array('keywords', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pid, level, name, link, visible, sort, cityId', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => 'Pid',
			'level' => 'Level',
			'name' => 'Название',
			'link' => 'Ссылка',
			'title' => 'Заголовок страницы',
			'description' => 'Описание',
			'keywords' => 'Ключевые слова',
			'h1' => 'Заголовок h1',
			'visible' => 'Видимость',
			'sort' => 'Sort',
			'cityId' => 'City',
			'text' => 'Комментарий',
			'selected' => 'Выделенный',
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

// 		$criteria->compare('id',$this->id);
		$criteria->compare('pid',$this->pid);
// 		$criteria->compare('level',$this->level);
// 		$criteria->compare('name',$this->name,true);
// 		$criteria->compare('link',$this->link,true);
// 		$criteria->compare('visible',$this->visible);
// 		$criteria->compare('sort',$this->sort);
		$criteria->compare('cityId',$this->cityId);
		
		$criteria->order = 'sort';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MainMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function recurciveDelete() {
		$currents = MainMenu::model()->findAll('pid=:pid', array(':pid'=>$this->id));
		foreach($currents AS $key => $val) {
			$val->recurciveDelete();
		}

		$this->deleteFull();
	}
}
