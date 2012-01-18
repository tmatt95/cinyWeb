<?php
/**
 * This pulls the administration functions from the other modules together into 
 * one location.
 */
class AdminModule extends CWebModule
{
	/**
	 * @todo We currently need to manually include the menus model to stop
	 * the page from breaking. This is not very good and infers that the 
	 * way the menus are built at the moment is not the best. Maybe 
	 * menus should be moved out of the cinema module and made more general?
	 */
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
			'application.modules.cinema.models.StaticSections'
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
