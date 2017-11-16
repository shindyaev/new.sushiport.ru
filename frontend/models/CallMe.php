<?php

class CallMe extends CFormModel
{

	public $name;
	public $phone;
	public $formId = 'callme-form';
    
	public function rules()
    {
        return array(
        	array('name, phone', 'required'),
		);
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Имя',
			'phone' => 'Телефон',
		);
	}
	
}
