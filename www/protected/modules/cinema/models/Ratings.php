<?php

/**
 * This is the model class for table "ratings".
 *
 * The followings are the available columns in table 'ratings':
 * @property integer $id - the unique id of the rating
 * @property integer $label - the text label of the rating e.g "PG"
 *
 * The followings are the available model relations:
 * @property Films[] $films
 */
class Ratings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ratings the static model class
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
		return 'ratings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array(
				'label',
				'required'
			),
			array(
				'id, label',
				'safe',
				'on'=>'search'
			),
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
			'films' => array(self::HAS_MANY, 'Films', 'rating'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
		);
	}
	
	/**
	 * Returns an array containing all the ratings in the system. 
	 * 
	 * @return array of items, with the key being their id
	 */
	public static function getAllRatings(){
		$array = array();
		$allEntries = Ratings::model()->findAll();
		
		foreach($allEntries as $entry)
			$array[$entry->id] = $entry->label;

		return $array;
	} 

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('label',$this->label);

		return new CActiveDataProvider(
			$this,
			array(
				'criteria'=>$criteria
			)
		);
	}
}