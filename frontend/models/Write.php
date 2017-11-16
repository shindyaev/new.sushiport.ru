<?php

class Write extends CFormModel
{

	public $name;
	public $email;
	public $phone;
	public $text;
	public $formId = 'writeus-form';
    
	public function rules()
    {
        return array(
        	array('name, email', 'required'),
        	array('email', 'email'),
        	array('phone, text', 'safe'),
		);
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Имя',
			'email' => 'Email',
			'phone' => 'Телефон',
			'text' => 'Текст сообщения'
		);
	}
	
}
