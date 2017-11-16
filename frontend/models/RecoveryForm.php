<?php

class RecoveryForm extends CFormModel
{
	public $formId = "recovery-form"; 
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('email', 'required'),
			array('email', 'email'),
			array('email', 'exist', 'attributeName' => 'email', 'className' => 'User', 'message' => 'Пользователь с указанным Email-ом не найден.')
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'email' => 'Email',
		);
	}
}
