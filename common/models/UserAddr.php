<?php

/**
 * This is the model class for table "userAddr".
 *
 * The followings are the available columns in table 'userAddr':
 * @property integer $id
 * @property integer $userId
 * @property string $street
 * @property string $house
 * @property string $str
 * @property string $pd
 * @property string $fl
 * @property string $kv
 * @property string $df
 */
class UserAddr extends EActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'userAddr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, street, house, kv', 'required'),
			array('userId', 'numerical', 'integerOnly'=>true),
			array('street', 'length', 'max'=>128),
			array('house, str, pd, fl, kv, df', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, userId, street, house, str, pd, fl, kv, df', 'safe', 'on'=>'search'),
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
			'userId' => 'User',
			'street' => 'Улица',
			'house' => 'Дом',
			'str' => 'Строение',
			'pd' => 'Подъезд',
			'fl' => 'Этаж',
			'kv' => 'Квартира',
			'df' => 'Домофон',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('house',$this->house,true);
		$criteria->compare('str',$this->str,true);
		$criteria->compare('pd',$this->pd,true);
		$criteria->compare('fl',$this->fl,true);
		$criteria->compare('kv',$this->kv,true);
		$criteria->compare('df',$this->df,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAddr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
