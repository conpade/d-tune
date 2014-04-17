<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->with('college')->with('role')->find('t.id = ?', array($this->username));
		if($user === null)
			$this->errorCode = ErrorCode::USER_NOT_EXIST;
		else if(!$user->validatePassword($this->password))
			$this->errorCode = ErrorCode::PASSWORD_INVALID;
		else
		{
			Yii::app()->user->setState('info', $user);
			$this->errorCode = ErrorCode::NONE;
		}
		return $this->errorCode == ErrorCode::NONE;
	}

	public static function equalOfficer()
	{
		return in_array(Yii::app()->user->info->role_id,array('1','2','3'),1);
	}

	public static function equalHR()
	{
		return in_array(Yii::app()->user->info->role_id,array('1','2'),1);
	}

	public static function equalSA()
	{
		return Yii::app()->user->info->role_id==='1';
	}

	public static function isOfficer()
	{
		return Yii::app()->user->info->role_id==='3';
	}

	public static function isHR()
	{
		return Yii::app()->user->info->role_id==='2';
	}
}