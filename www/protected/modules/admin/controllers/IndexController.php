<?php
class IndexController extends Controller
{
	/**
	 * Having a main menu at the top of the page can be confusing for the user
	 * when they are navigating around the admin panel. 
	 * 
	 * If you would like to use the menu in a controller action, then override
	 * it with "$this->layout = true" to turn it back on again.
	 * @var boolean 
	 */
	public $hideMainMenu = true;
	
	/**
	 * Having the news box on the administration pages gets in the way of the
	 * content, therefore the column1 style has been chosen which in effect 
	 * turns it off.
	 * 
	 * @var string 
	 */
	public $layout = '//layouts/column1';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl'
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',
				'actions'=>array(
					'index'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array(
				// deny all userss
				'deny',
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * This displays the administration index section. From which the user can 
	 * dive down to administer the various parts of the application.
	 */
	public function actionIndex()
	{
		$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview';
		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('bbq');
		$cs->registerCoreScript('jquery-ui.min.js');
		$cs->registerCoreScript('maskedinput');
		$cs->registerScriptFile($baseScriptUrl.'/jquery.yiigridview.js',CClientScript::POS_END);
		
		$staticSections = new StaticSections();
		$staticMenu = $staticSections->getAllStaticSections();
		
		/**
		 * As there are no yii components on the page, jquery needs to be
		 * manually added otherwise the page wont work
		 * - Please do not remove
		 */
		$this->breadcrumbs=array('Administration');
		$this->render(
			'index',
			array(
				'staticMenu'=>$staticMenu
			)
		);
	}
}