<?php 
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	public function authenticate()
	{
		$record=User::model()->findByAttributes(array('email'=>$this->username));
		if($record===null || $record->active == 0)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($record->password!==crypt($this->password,$record->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$record->id;
			$this->setState('name', $record->name);
			$this->setState('email', $record->email);
			$this->setState('phone', $record->phone);
			$this->setState('allowSailPlay', $record->allowSailPlay);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}
