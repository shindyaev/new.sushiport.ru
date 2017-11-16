<?php

/**
 * This is the model class for table "workers".
 *
 * The followings are the available columns in table 'workers':
 * @property integer $id
 * @property string $name
 * @property string $dish
 * @property integer $visible
 * @property integer $cityId
 */
class Worker extends EActiveRecord
{
	
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/worker/';
		$this->imagesUrl = '/data/worker/';
		$this->imageSizes = array(array(200, 200));
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'workers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, dish', 'required'),
			array('visible, cityId, sort', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('dish', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, dish, visible, cityId', 'safe', 'on'=>'search'),
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
			'name' => 'Имя',
			'dish' => 'Любимое блюдо',
			'visible' => 'Видимость',
			'cityId' => 'City',
			'image' => 'Изображение',
				
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('dish',$this->dish,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('cityId',$this->cityId);

		$criteria->order = 'sort, id';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>100
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Worker the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
