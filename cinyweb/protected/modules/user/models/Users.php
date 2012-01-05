<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $title_id
 * @property string $administrator
 *
 * The followings are the available model relations:
 * @property Titles $title
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

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
			array('email,password,username,name', 'required'),
			array('title_id', 'numerical', 'integerOnly'=>true),
			array('name, email, password', 'length', 'max'=>250),
			array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, title_id', 'safe', 'on'=>'search'),
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
			'title' => array(self::BELONGS_TO, 'Titles', 'title_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'title_id' => 'Title',
		);
	}
	
	/**
	 * Will check to see if the current user has permission to view the admin 
	 * panel.
	 * 
	 * @return boolean True/ false
	 */
	public function isAdmin(){
		$return = false;
		
		$user = Users::model()->findByPk(Yii::app()->user->id);
		
		if(isset($user) && $user->admin == 1)
			$return = true;
		
		return $return;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('title_id',$this->title_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}