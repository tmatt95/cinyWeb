<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property int $id the unique id of the news item.
 * @property string $title of the news article
 * @property string $content Full content of the article
 * @property datetime $date_published The date/time the article was created/
 * published (as articles currently get published as soon as they are created)
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the name of the news table
	 */
	public function tableName(){return 'news';}

   /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,excerpt', 'required'),
            array('title', 'length', 'max'=>250),
            array('content, date_published', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, content, date_added, excerpt', 'safe', 'on'=>'search'),
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
            'content' => 'Content',
            'date_added' => 'Date',
            'excerpt' => 'Excerpt',
        );
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models 
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	// GRID COLUMNS ------------------------------------------------------------
	
	/**
	 * The title of a news item
	 * @param string $name
	 * @param integer $id
	 * @return string the title column contents for a news item 
	 */
	public static function colTitle($name,$id){
		return CHtml::link($name,array('/news/index/update','id'=>$id));
	}
}