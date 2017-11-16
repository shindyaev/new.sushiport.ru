<?php

/**
 * This is the model class for table "news2".
 *
 * The followings are the available columns in table 'news2':
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $shortText
 * @property integer $visible
 * @property integer $cityId
 */
class News2 extends EActiveRecord
{
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/news2/';
		$this->imagesUrl = '/data/news2/';
		$this->imageSizes = array(array(930, false), array(104, 104));
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, text, shortText, dateStart', 'required'),
			array('visible, cityId', 'numerical', 'integerOnly'=>true),
			array('name, shortText', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, text, shortText, visible, cityId', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'text' => 'Текст',
			'shortText' => 'Краткий текст',
			'visible' => 'Видимость',
			'image' => 'Изображение',
			'dateStart' => 'Дата',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('shortText',$this->shortText,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('cityId',$this->cityId);

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
	 * @return News2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
