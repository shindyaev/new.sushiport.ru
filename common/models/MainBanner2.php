<?php

/**
 * This is the model class for table "mainBanners".
 *
 * The followings are the available columns in table 'mainBanners':
 * @property integer $id
 * @property string $name
 * @property string $link
 * @property integer $visible
 */
class MainBanner2 extends EActiveRecord
{
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/mainBanners2/';
		$this->imagesUrl = '/data/mainBanners/';
		$this->imageSizes = array(array(1000, 442, true));
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mainBanners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, visible', 'required'),
			array('visible, cityId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('link', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, link, visible', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'link' => 'Ссылка',
			'visible' => 'Видимость',
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('cityId',$this->cityId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MainBanner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
