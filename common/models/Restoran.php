<?php

/**
 * This is the model class for table "restorans".
 *
 * The followings are the available columns in table 'restorans':
 * @property integer $id
 * @property string $addr
 * @property string $phone
 * @property string $map
 * @property string $service
 * @property integer $cityId
 */
class Restoran extends EActiveRecord
{
	
	public $work = 0;
	
	public function init()
	{
		parent::init();
		$this->imagesPath = Yii::getPathOfAlias('common').'/data/restorans/';
		$this->imagesUrl = '/data/restorans/';
		$this->imageSizes = array(array(230, 230, false, CImageHandler::IMG_PNG), array(100, 100, false, CImageHandler::IMG_PNG));
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'restorans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('addr', 'required'),
			array('cityId, menu, minCheck, visible, sort', 'numerical', 'integerOnly'=>true),
			array('addr, addr2, phone, phone2, kittchen, site, name', 'length', 'max'=>100),
			array('workTime, shortText', 'length', 'max'=>255),
			array('delivery', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service, map, map2, text', 'safe'),
			array('id, addr, phone, map, service, cityId, menu', 'safe', 'on'=>'search'),
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
			'images'=>array(self::HAS_MANY, 'RestoranPhoto', 'restoranid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'addr' => 'Адрес',
			'addr2' => 'Адрес2' ,
			'phone' => 'Телефон',
			'phone2' => 'Телефон 2',
			'map' => 'Карта',
			'map2' => 'Карта 2',
			'service' => 'Услуги',
			'cityId' => 'City',
			'workTime' => 'Время работы',
			'text' => 'Текст',
			'site' => 'Сайт',
			'kittchen' => 'Кухня',
			'name' => 'Название',
			'image' => "Логотип",
			'menu' => 'Меню',
			'shortText' => 'Краткий текст',
			'minCheck' => 'Мин. сумма заказа',
			'delivery' => 'Стоимость доставки',
			'visible' => 'Видимость'
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
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('map',$this->map,true);
		$criteria->compare('service',$this->service,true);
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
	 * @return Restoran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function deleteFull($format = CImageHandler::IMG_JPEG) {
	
		$models = RestoranPhoto::model()->findAll('restoranId = :restoranId', array(':restoranId' => $this->id));
		foreach($models AS $key => $val) {
			$val->deleteFull();
		}
	
		parent::deleteFull($format);
	}
}
