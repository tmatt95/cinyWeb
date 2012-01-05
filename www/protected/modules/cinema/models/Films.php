<?php

/**
 * This is the model class for table "films".
 *
 * The followings are the available columns in table 'films':
 * @property string $id - The unique id of the film
 * @property string $title - The films title
 * @property string $length - The length of the film (in minutes) 
 * @property integer $rating - Links to the ratings table, the rating of the film
 * @property string $story - The plot of the film
 * @property string $screenwriter - The name of the screenwriter/s which created the film
 * @property string $director - The name of the director/s which created the film
 * @property string $link_website - Link to the films official website
 * @property string $link_trailer - Link to the films trailer page
 *
 * The followings are the available model relations:
 * @property GenresToFilms[] $genresToFilms -  All the genres which the film belongs to
 * @property Showings[] $showings - All the films showings
 */
class Films extends CActiveRecord
{
	
	public $ratingLabel;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Films the static model class
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
		return 'films';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rating,length', 'numerical', 'integerOnly'=>true),
			array('title, link_website, link_trailer', 'length', 'max'=>250),
			array('length', 'length', 'max'=>10),
			array('title,length','required'),
			array('story, screenwriter, director,youtube_embed_url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, length, rating, story, screenwriter, director, link_website, link_trailer', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Returns a link to films information page
	 * 
	 * @param int $filmId The id of the film 
	 */
	public static function getFilmLink($filmId){
		return Yii::app()->createAbsoluteUrl(
			'/cinema/films/view',
			array(
				'id'=>$filmId
			)
		);
	}
	
	public static function getFilmUpdateLink($filmId){
		return Yii::app()->createAbsoluteUrl(
			'/cinema/films/update',
			array(
				'id'=>$filmId
			)
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
			'ratings' => array(self::BELONGS_TO, 'Ratings', 'rating'),
			'genresToFilms' => array(self::HAS_MANY, 'GenresToFilms', 'film_id'),
			'showings' => array(self::HAS_MANY, 'Showings', 'film_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'length' => 'Length',
			'rating' => 'Rating',
			'story' => 'Story',
			'screenwriter' => 'Screenwriter',
			'director' => 'Director',
			'link_website' => 'Website',
			'link_trailer' => 'Trailer',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->select = 't.id,
			t.title,
			r.label AS ratingLabel';
		$criteria->join = 'LEFT JOIN ratings as r on t.rating = r.id';
		
		$criteria->compare('title',$this->title,true);
		$criteria->compare('length',$this->length,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('story',$this->story,true);
		$criteria->compare('screenwriter',$this->screenwriter,true);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('link_website',$this->link_website,true);
		$criteria->compare('link_trailer',$this->link_trailer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	// GRID COLUMNS ------------------------------------------------------------
	
	/**
	 * Returns the title column for a film based on the supplied title and id
	 * 
	 * This has been made a static function as I can see the column being called 
	 * from multiple tables (films and showings). 
	 * 
	 * @param sting $linkText The text which will be displayed as the link
	 * @param int $filmId The id of the film to link to
	 * @return string The title column 
	 */
	public static function colTitle($linkText,$filmId){
		$linkOptions = array(
			'data-filmId'=>$filmId,
			'class'=>'filmLink'
		);
		return Chtml::Link($linkText,self::getFilmLink($filmId),$linkOptions);
	}
	
	public static function updateColTitle($linkText,$filmId){
		$linkOptions = array(
			'data-filmId'=>$filmId,
			'class'=>'filmLink'
		);
		return Chtml::Link($linkText,self::getFilmUpdateLink($filmId),$linkOptions);
	}
	
	/**
	 * Returns the lable column for a film
	 * @param sting $label The label text to return
	 */
	public static function colRating($label){
		return $label;
	}
}