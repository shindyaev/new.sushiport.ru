<?php

/**
 * This is the model class for table "dishActions".
 *
 * The followings are the available columns in table 'dishActions':
 * @property integer $id
 * @property integer $categoryId
 * @property integer $dishId
 * @property integer $count
 * @property integer $price
 * @property string $dateEnd
 * @property integer $cityId
 * @property integer $visible
 */
class DishAction extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dishActions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('categoryId, restoranId, dishId, count, price', 'required'),
			array('categoryId, restoranId, dishId, count, price, priceOld, cityId, visible', 'numerical', 'integerOnly'=>true),
			array('dateEnd', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, categoryId, dishId, count, price, dateEnd, cityId, visible', 'safe', 'on'=>'search'),
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
			'dish'=>array(self::BELONGS_TO, 'Dish', 'dishId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'categoryId' => 'Категория',
			'dishId' => 'Блюдо',
			'count' => 'Количество',
			'price' => 'Цена',
			'dateEnd' => 'Дата окончания',
			'cityId' => 'Город',
			'visible' => 'Видимость',
			'priceOld' => 'Старая цена',
			'restoranId' => 'Ресторан',
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
		$criteria->compare('categoryId',$this->categoryId);
		$criteria->compare('dishId',$this->dishId);
		$criteria->compare('count',$this->count);
		$criteria->compare('price',$this->price);
		$criteria->compare('dateEnd',$this->dateEnd,true);
		$criteria->compare('cityId',$this->cityId);
		$criteria->compare('visible',$this->visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DishAction the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
