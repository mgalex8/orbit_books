<?php

class MessageForm extends CFormModel
{    
	public $email;
        public $password;
        public $confirm;
        public $username;
	public $city;		
        
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(			
			array('username, email, city', 'required'),			
                        array('username', 'length', 'max'=>20),
                        array('password, confirm', 'length', 'min'=>6),
			array('email', 'email'),
                        array('password', 'compare', 'compareAttribute' => 'confirm'),			
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
                        'username'=>'Ваше имя',
                        'password'=>'Новый пароль',
                        'confirm'=>'Повторите пароль',                        
                        'city'=>'Город',			
		);
	}
        
        public function getFromDatabase()
        {
                $userId = Yii::app()->user->GetId();                
                if ($user = User::model()->findByPk($userId))
                {
                    $this->username = $user->username;
                    $this->email = $user->email;
                    $this->city = $user->city;
                }
        }
        
        public function saveInDatabase()
        {       
                $userId = Yii::app()->user->GetId();            
                $user = User::model()->findByPk($userId);
                
                if ($userGroup = $user->getUserGroupByName('supplier'))
                {
                    $user->email = $this->email;
                    $user->username = $this->username;
                    if (!empty($this->password)) {                 
                        $user->password = $user->hashPassword($this->password);
                    }                    
                    $user->active = 1;
                    
                    Yii::app()->user->setState('username', $this->username);
                    
                    return $user->save();
                }
                else
                {
                    return false;
                }            
        }
}
