<?php

class NewUserForm extends CFormModel
{    
	public $email;
        public $password;
        public $confirm;
        public $username;
	public $group;
        //public $verifyCode;
        
        private $_identity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(			
			array('username, email, password, confirm, group', 'required'),			
                        array('username', 'length', 'max'=>20),
                        array('password, confirm', 'length', 'min'=>6),
			array('email', 'email'),
                        array('password', 'compare', 'compareAttribute' => 'confirm'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
                        'email'=>'Email',
                        'password'=>'Пароль',
                        'confirm'=>'Повторите пароль',
                        'username'=>'Логин',         
                        'group'=>'Группа',
			'verifyCode'=>'Код проверки',
		);
	}
        
        public function registration()
        {       
                $foundUser = User::model()->find('username=:Username', array(':Username'=>$this->username));
                
                if ($foundUser) {
                    return false;
                }                
                if (!$this->saveUser()) {
                    return false;
                }                    
            
                if ($this->_identity === null)
                {
                        $this->_identity = new UserIdentity($this->email, $this->password);
                        $this->_identity->authenticate();
                }
                if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
                {                        
                        Yii::app()->user->login($this->_identity, $duration);
                        return true;
                }
                else
                        return false;
        }
        
        function saveUser($id = 0) {
                if ($id > 0) {
                    $user = User::model()->findByPk($id);
                    if ($user === null) {
                        throw new CHttpException(404, 'Пользователь не найден');
                    }
                }
                else {
                    $user = new User();
                }
                if ($userGroup = $user->getUserGroupByName($this->group))
                {                                    
                    $user->email = $this->email;
                    $user->username = $this->username;
                    $user->password = $user->hashPassword($this->password);
                    $user->group_id = $userGroup->id;
                    $user->active = 1;
                    if (!empty($this->group)) {
                        $user->role = $this->group;
                    }
                    $user->email_required = 0;
                    $user->access_token = md5($this->username . rand(0, 999999). $this->password);
                    $user->mn = 0;
                    $user->logins = 0;
                    $user->save();
                    return true;
                }        
                else 
                    return false;
        }
        
        function loadAttributes($id) {
                $user = User::model()->findByPk($id);
                if ($user === null) {
                    throw new CHttpException(404, 'Пользователь не найден');
                }
                $this->email = $user->email;                
                $this->username = $user->username;
                $rhis->group = $user->role;
        }
}
