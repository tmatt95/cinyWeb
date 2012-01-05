<?php
/**
 * This is the model class for table "vw_showings"
 * @param film_id int The id of the film
 * 
 * @author Matt Turner
 * @version 1
 */
class VwShowings extends CActiveRecord
{
	
	//public $rating;
	/**
	 * Returns the static model of the specified AR class.
	 * @return VwShowings the static model class
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
		return 'vw_showings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(
				'title, ratingLabel',
				'length',
				'max'=>250
			),
			array(
				'date_time',
				'length',
				'max'=>139
			),
			array(
				'starts, finishes',
				'length',
				'max'=>8
			),
			array(
				'title, date_time, starts, finishes,ratingLabel,ratingId, id, three_d',
				'safe', 
				'on'=>'search'
			)
		);
	}

	/**
	 * This function searches both the film and showings tables. for all 
	 * showings
	 * 
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->select = 'id,
			ratingLabel,
			film_id,
			ratingId,
			title,
			date_time,
			starts,
			finishes';
		
		// Do not remove. 
		// This is used to limit searches to a specified film
		$criteria->compare('film_id',$this->film_id);
		$criteria->compare('three_d',$this->three_d);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('starts',$this->starts,true);
		$criteria->compare('finishes',$this->finishes,true);
		$criteria->compare('ratingId',$this->ratingLabel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * This function searches both the film and showings tables for all showings
	 * today and into the future.
	 * 
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 * 
	 * @todo Make it search into the future
	 * @todo Date time and date time system is sloppy. Let the application do
	 * formatting!
	 */
	public function futureSearch()
	{
		$criteria=new CDbCriteria;
		$criteria->select = 'id,
			three_d,
			ratingLabel,
			film_id,
			ratingId,
			title,
			date_time,
			starts,
			finishes';
		$criteria->condition = 'date_time_system > NOW()';
		
		// Do not remove. 
		// This is used to limit searches to a specified film
		$criteria->compare('film_id',$this->film_id);
		$criteria->compare('three_d',$this->three_d);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('starts',$this->starts,true);
		$criteria->compare('finishes',$this->finishes,true);
		$criteria->compare('ratingId',$this->ratingLabel,true);

		return new CActiveDataProvider(
			$this,
			array(
				'criteria'=>$criteria,
			)
		);
	}
}