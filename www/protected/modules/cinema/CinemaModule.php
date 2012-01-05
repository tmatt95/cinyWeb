<?php
/**
 * This is the heart of the application. It is in this module that all
 * "showings" / film functionality is controlled
 * 
 * @author Matthew Turner
 */
class CinemaModule extends CWebModule
{
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'cinema.models.*',
			'cinema.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
