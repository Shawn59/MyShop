<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class authorizationForm extends CFormModel
{
	public $login;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('login, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
            array('login, password', 'match', 'pattern' => '/^[A-Za-zs, 0-9]+$/u', 'message' => 'Используйте только символы латинского алфавита и цифры'),
            array('login, password', 'length', 'max'=>20),
			array('password, login', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Запомнить меня',
            'login' => 'Логин',
            'password' => 'Пароль',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 * @param string $attribute the name of the attribute to be validated.
	 * @param array $params additional parameters passed with rule when being executed.
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->login, md5("dsfds+342d" . $this->password));
			$f = $this->_identity->authenticate();
			if(!$this->_identity->authenticate()) {
			    if ($this->_identity->errorCode == UserIdentity::ERROR_USERNAME_INVALID) {
                    $this->addError('login','Некорректный логин');
                } elseif ($this->_identity->errorCode == UserIdentity::ERROR_PASSWORD_INVALID) {
                    $this->addError('password','Некорректный пароль');
                }
            }
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->login, md5("dsfds+342d" . $this->password));
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
