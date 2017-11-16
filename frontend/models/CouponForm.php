<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CouponForm extends CFormModel
{
	public $formId = "coupon-form";
	public $coupon;

	public function behaviors(){
		return array(
			'sailplayBehavior' => array(
				'class' => 'SailplayBehavior',
			),
		);
	}


	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('coupon', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'coupon'=>'Введите промо-код для подарка',
		);
	}


}

