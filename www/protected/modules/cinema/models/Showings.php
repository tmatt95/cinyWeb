<?php
/**
 * This is the model class for table "showings".
 *
 * The followings are the available columns in table 'showings':
 * @property string $id - The unique id of the showing
 * @property string $date_time - The date / time the film begins
 * @property string $three_d - Whether or not the film is in 3D
 * @property string $private - Whether the film is a private booking
 * @property string $film_id - The link to the film the showing relates to
 * @property string $added - The date and time the showing was added
 *
 * The followings are the available model relations:
 * @property Films $film - The film that is showing
 */
class Showings extends CActiveRecord
{
	/**
	 * Used to store the rating text for a film
	 * @var String 
	 */
	public $rating;
	
	/**
	 * Used to store the title of the film
	 * @var String 
	 */
	public $title;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Showings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	/**
	 * The finish time is not stored in the database, instead it is is calculated
	 * based on the start time and duration of the film. 
	 * 
	 * @param int $showingId int The id of the film. You do not need to specify
	 * this if this is populated with row data
	 * 
	 * @param boolean $asDate = Whether the string should be returned as a date/time
	 * By default, only a time will be returned
	 * 
	 * @return string The finishing time of the film
	 */
	public function getFinishTime($showingId = null,$asDate = false){
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'showings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array(
				'film_id,date_time', 
				'required'
			),
			array(
				'three_d, private, film_id',
				'length',
				'max'=>10
			),
			array(
				'date_time, added',
				'safe'
			),
			array(
				'title,date_time, three_d, private, finishes,rating,starts',
				'safe',
				'on'=>'search'
			)
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'film' => array(
				self::BELONGS_TO,
				'Films',
				'film_id'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_time' => 'Date',
			'three_d' => '3D',
			'private' => 'Private',
			'film_id' => 'Film',
			'added' => 'Added',
			'ratingLabel'=>'Rating'
		);
	}
	
	/**
	 * Displays the human readable text for the 3d column
	 * @return string human readable value to be displayed in the 3d coumn
	 */
	public static function colThreeD($value){
		if($value == 1)
			return 'Yes';
		else
			return 'No';
	}
}