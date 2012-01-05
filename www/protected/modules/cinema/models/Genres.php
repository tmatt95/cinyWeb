<?php

/**
 * This is the model class for table "genres".
 *
 * The followings are the available columns in table 'genres':
 * @property string $id - the unique id of the genre
 * @property string $label - The label which then user sees
 *
 * The followings are the available model relations:
 * @property GenresToFilms[] $genresToFilms
 */
class Genres extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Genres the static model class
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
		return 'genres';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label', 'length', 'max'=>250),
			array('label','required'),
			array('id, label', 'safe', 'on'=>'search'),
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
			'genresToFilms' => array(self::HAS_MANY, 'GenresToFilms', 'genre_id'),
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider(
			$this
		);
	}
}