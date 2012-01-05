<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base 
 * class.
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
}