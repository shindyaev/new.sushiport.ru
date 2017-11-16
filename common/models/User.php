<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property integer $active
 * @property integer $allowSailPlay
 */
class User extends EActiveRecord
{
	
	public $confirmPassword;
	
	private $_sqlSoult = 'md5(CONCAT(CONCAT("BORN", email, "TO"), md5(CONCAT(email, "FLY"))))';
	
	public function getActivateSoult($email)
	{
		return md5("BORN".$email."TO".md5($email."FLY"));
	}
	
	public function getSqlSoult()
	{
		return $this->_sqlSoult;
	}

	public function getSoult($password)
	{
		return md5("RIDE".$password."OR".md5($password."DIE"));
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, phone', 'required'),
			array('active, mailerAction, mailerNews, mailerNewMenu, sex, firstOrder, allowSailPlay', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>64),
			array('name, fname, phone', 'length', 'max'=>32),
			array('email', 'email'),
			array('email', 'unique', 'className' => 'User', 'attributeName' => 'email', 'caseSensitive' => true),
			array('phone', 'unique', 'className' => 'User', 'attributeName' => 'phone', 'caseSensitive' => true, 'message' => 'Такой телефон уже используется.'),
			array('confirmPassword', 'compare', 'compareAttribute'=>'password', 'message' => Yii::t('main','Введенные пароли не совпадают'),),
			array('password', 'compare', 'compareAttribute'=>'confirmPassword', 'message' => Yii::t('main','Введенные пароли не совпадают'),),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, active', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'password' => 'Пароль',
			'phone' => 'Телефон',
			'active' => 'Active',
			'allowSailPlay' => 'Регистрация в системе лояльности SailPlay',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('firstOrder',$this->firstOrder);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
