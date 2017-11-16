<?php

class BookTable extends CFormModel
{

	public $name;
	public $restoran;
	public $datetime;
	public $count;
	public $formId = 'booktable-form';
    
	public function rules()
    {
        return array(
        	array('name, datetime, count', 'required', 'message' => 'Необходимо заполнить поле.'),
        	array('restoran', 'safe'),
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
			'datetime' => 'Дата посещения',
			'count' => 'Количество гостей',
		);
	}
	
}
