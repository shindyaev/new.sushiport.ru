<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class WriteUsForm extends CFormModel
{
	public $email;
	public $name;
	public $text;
	public $verifyCode;

	public $formId = 'writeus-form';
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('text', 'required'),
			array('name, email', 'safe'),
			array('email', 'email'),
			array('verifyCode', 'captcha' /*, 'allowEmpty'=>!CCaptcha::checkRequirements()*/),
		);	
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Ваше имя',
            'email' => 'E-mail',
            'text' => 'Сообщение',
            'verifyCode'=>'Код для проверки',
		);
	}
	
}
