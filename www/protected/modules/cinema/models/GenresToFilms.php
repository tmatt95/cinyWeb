<?php

/**
 * This is the model class for table "genres_to_films".
 *
 * The followings are the available columns in table 'genres_to_films':
 * @property string $id
 * @property string $film_id
 * @property string $genre_id
 *
 * The followings are the available model relations:
 * @property Genres $genre
 * @property Films $film
 */
class GenresToFilms extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GenresToFilms the static model class
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
		return 'genres_to_films';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('film_id, genre_id', 'required'),
			array('film_id, genre_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, film_id, genre_id', 'safe', 'on'=>'search'),
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
			'genre' => array(self::BELONGS_TO, 'Genres', 'genre_id'),
			'film' => array(self::BELONGS_TO, 'Films', 'film_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'film_id' => 'Film',
			'genre_id' => 'Genre',
		);
	}

	public function updateFilmGenreInformation($filmId = null){
		// First we delete all the genres from the system which relate to the 
		// selected film
		$this->model()->deleteAllByAttributes(array('film_id'=>$filmId));
		
		if(isset($_POST['filmGenre']))
			$filmGenres  = $_POST['filmGenre'];
		else
			$filmGenres = array();
		
		foreach($filmGenres as $fg=>$selected){
			$newGenre = new GenresToFilms('insert');
			$newGenre->film_id = $filmId;
			$newGenre->genre_id = $fg;
			$newGenre->save();
		}
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
		$criteria->compare('film_id',$this->film_id,true);
		$criteria->compare('genre_id',$this->genre_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}