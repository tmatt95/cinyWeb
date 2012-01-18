<?php
/**
 * @author Matt Turner - tmatt95@gmail.com
 * @version 0.1
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 
	 * '//layouts/column2', meaning using a single column layout. See 
	 * 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @var array context menu items. This property will be assigned to 
	 * {@link CMenu::items}.
	 */
	public $menu = array();
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this 
	 * property will be assigned to {@link CBreadcrumbs::links}. Please refer to
	 * {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();
	
	/*
	 * @var boolean There are some sections such as the admin panel which need 
	 * to hide the menu button. Without it hidden, the links would be confusing. 
	 * By setting this to true in your controller ( $this->hideMainMenu ) you 
	 * can disable the main menu. 
	 */
	public $hideMainMenu = false;
	
	/**
	 * The location to redirect the browser to after updating / saving a film 
	 * record
	 * @var array 
	 */
	public $createUpdateRedirect = array('/admin/index');
	
	/**
	 * Calling this function will stop the system from attaching javascript 
	 * files to ajax calls which will break the app in all wierd and wonderful 
	 * ways
	 */
	public function ajaxScriptControl(){
		Yii::app()->clientScript->scriptMap=array(
			'jquery.js'=>false,
			'jquery.yiigridview.js'=>false,
			'jquery.ba-bbq.js'=>false,
			'jquery-ui.min.js'=>false,
			'jquery.maskedinput.js'=>false,
			'jquery.yiilistview.js'=>false
		);
	}
	
	/**
	 * All controllers should use access controls to determine who can use which
	 * actions and so having the code repeated is not good
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl'
		);
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 * 
	 * @todo Ensure that the form name property is supplied wherever it needs 
	 * to be in the controllers
	 */
	protected function performAjaxValidation($model,$formName){
		if(isset($_POST['ajax']) && $_POST['ajax']===$formName)
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * 
	 * @param string the name of the model on which you would like to load the row
	 * @param integer the ID of the model to be loaded
	 * 
	 * @return CActiveRecord of the selected row in the model or CHttp exception
	 * with 404 if the requested model could not be found.
	 * 
	 * @todo Ensure that this load model is implemented throughout the application
	 */
	public function loadModel($model,$id)
	{
		$model=$model::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}