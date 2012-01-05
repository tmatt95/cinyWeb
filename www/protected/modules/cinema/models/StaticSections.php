<?php

/**
 * This is the model class for table "static_section".
 *
 * The followings are the available columns in table 'static_section':
 * @property int $id The unique id of the static section
 * @property string $title The title to be displayed at the top of the static
 * sections page
 * @property string $content The content for the static section
 */
class StaticSections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StaticSection the static model class
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
		return 'static_sections';
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
				'title',
				'length',
				'max'=>250
			),
			array(
				'content',
				'safe'
			),
			array(
				'id, title, content',
				'safe', 
				'on'=>'search'
			)
		);
	}
	
	/**
	 * Returns an array of all the static sections 
	 */
	public function getAllStaticSections(){
		$Sections = array();
		$res = $this->model()->findAll();
		
		foreach($res as $r)
			$Sections[$r->id] = $r->title;
		
		return $Sections;
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
			'menu_entry' => 'Menu Entry',
			'menu_order' => 'Menu Order'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('menu_entry',$this->menu_entry,true);
		$criteria->compare('menu_order',$this->menu_order);

		return new CActiveDataProvider(
			$this, 
			array(
				'criteria'=>$criteria
			)
		);
	}
}