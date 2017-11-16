<?php

class AboutText extends CFormModel
{

	public $text;
	public $formId = 'aboutText-form';
    private $file;
    
    public function init()
    {
    	parent::init();
    	$this->file = YiiBase::getPathOfAlias('common').'/data/about/text.txt';
    	
    	if (file_exists($this->file)) {
    		$json = file_get_contents($this->file);
    		$obj = CJSON::decode($json);
    		$this->attributes = $obj;
    	}
    }
    
	public function rules()
    {
        return array(
        	array('text', 'safe'),
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
			'text' => 'Текст',
		);
	}
	
}
