<?php
/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $id Unique id of menu item
 * @property string $name This is what the user will see on the screen
 * @property string $link The yii link to the controller, minus its variables
 * @property integer $menu_order The order of the menu items should be displayed in
 * @property integer $static_id The id of the static content the link should
 * link to. This can be left blank if not linking to static content.
 */
class Menus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menus the static model class
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
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link, variables, order', 'required'),
			array('order', 'numerical', 'integerOnly'=>true),
			array('name, variables', 'length', 'max'=>200),
			array('link', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, link, variables, order', 'safe', 'on'=>'search'),
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
			'link' => 'Link',
			'variables' => 'Variables',
			'menu_order' => 'Order',
		);
	}
	
	/**
	 * Returns an array of all the menu items and their associated links
	 * @todo The Film link does not highlight when the page is selected
	 */
	public static function getMenuItems(){
		$menuItems = array();
		$condition = array('order'=>'menu_order ASC');
		$items = Menus::model()->findAll($condition);

		foreach($items as $i){
			/**
			*the link should be created differently
			* depending on how the items in it are stored
			*/
			if($i->link =='home')
				$link = Yii::app()->createAbsoluteUrl('cinema/index');
			else if($i->link !='' && $i->static_id !=0 )
				$link = array(trim($i->link),'id'=>$i->static_id);
			else if($i->link !='' && $i->static_id ==0)
				$link = array(trim($i->link));
			else 
				$link = '';

			$menuItems[] = array(
				'label'=>$i->name,
				'url'=>$link
			);
		}
		return $menuItems;
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('variables',$this->variables,true);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider(
			$this,
			array(
				'criteria'=>$criteria,
			)
		);
	}
}