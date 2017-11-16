<?php

class Settings extends CFormModel
{

	public $emailAdmin;
	public $emailDirector;
	public $phoneSmr;
	public $phoneUfa;
	public $orderEmailSmr;
	public $orderEmailUfa;
	public $androidLink;
	public $iphoneLink;
	public $menuLink;
	public $emailBookTable;
	public $restoransText;
	public $formId = 'site-form';
    private $file;
    
    public function init()
    {
    	parent::init();
    	$this->file = YiiBase::getPathOfAlias('common').'/data/settings/settings.txt';
    	
    	if (file_exists($this->file)) {
    		
    		$json = file_get_contents($this->file);
    		$obj = CJSON::decode($json);
    		$this->attributes = $obj;
    	}
    }
    
	public function rules()
    {
        return array(
        	array('emailAdmin', 'email'),
        	array('emailDirector', 'email'),
        	array('restoransText, phoneSmr, phoneUfa, androidLink, iphoneLink, orderEmailSmr, orderEmailUfa, menuLink, emailBookTable', 'safe'),
		);
    }
	
	public function save() {
		$json = CJSON::encode($this);
 		file_put_contents($this->file, $json);
		return true;
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'emailAdmin' => Yii::t('main', 'Email Admin'),
			'emailDirector' => 'Email Директора',
			'phoneSmr' => 'Телефон Самара',
			'phoneUfa' => 'Телефон Уфа',
			'androidLink' => 'Ссылка на приложение Android',
			'iphoneLink' => 'Ссылка на приложение Iphone',
			'orderEmailSmr' => 'Emial для заказов Самара',
			'orderEmailUfa' => 'Emial для заказов Уфа',
			'menuLink' => 'Ссылка на меню',
			'emailBookTable' => 'Email для резервирования столика',
			'restoransText' => 'Текст в ресторанах',
		);
	}
	
}
