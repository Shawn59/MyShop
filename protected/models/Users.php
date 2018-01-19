<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $role_id
 * @property string $login
 * @property string $password
 * @property string $FIO
 *
 * The followings are the available model relations:
 * @property Roles $role
 */
class Users extends CActiveRecord
{
    public $verifyCode;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, login, password, verifyCode', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('login, password', 'length', 'max'=>20),
			array('FIO', 'length', 'max'=>250),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements() , 'on' => 'registerCaptcha'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('login, role_id, password, FIO', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	public function beforeSave() {
	    $this->password = md5("dsfds+342d" . $this->password);
	    return parent::beforeSave();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => 'Роль',
			'login' => 'Логин',
			'password' => 'Пароль',
			'FIO' => 'ФИО',
            'verifyCode' => 'Проверочный код',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('FIO',$this->FIO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
