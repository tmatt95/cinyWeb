<?php
/**
 * This controller currently carries actions which are too generic to go into
 * any of the others. It could be argued that some of these are too generic to
 * even be in this place... but they are here for now and like it (page related
 * actions).
 * 
 * @author Matt Turner - tmatt95@gmail.com
 * @version 0.1 
 */
class IndexController extends Controller
{
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * 
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array(
				'allow',
				'actions'=>array(
					'index',
					'Page'
				),
				'users'=>array('*')
			),
			array(
				'allow',
				'actions'=>array(
					'updatePage',
					'expression'=>'Users::model()->isAdmin()'
				),
			),
			array(
				'deny',
				'users'=>array('*')
			),
		);
	}
	
	/**
	 * The "home page" of the application. This is where the app goes if no
	 * route is specified.
	 * 
	 * @todo The Films button should be highlighted but is not when on this page.
	 */
	public function actionIndex(){
		$model=new VwShowings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwShowings']))
			$model->attributes=$_GET['VwShowings'];
		
		$search = $model->futureSearch();
		$search->pagination = array('pageSize'=>12);
		$this->render('index',array('model'=>$model,'search'=>$search));
	}
	
	/**
	 * There are lots of pages on this website which are made up of just static
	 * text. This provides a generic methood of viewing them.
	 * 
	 * @param int The id of the static content
	 * @todo This should not be in the showings controller as it is a generic
	 * function 
	 */
	public function actionPage($id){
		$content = StaticSections::model()->findByPk($id);
		$this->pageTitle = 'Wotton Cinema - '. CHtml::encode($content->title);
		$this->render(
			'page',
			array(
				'content'=>$content,
			)
		);
	}
	
	/**
	 * Through this function, the user can update content on a static page
	 * @param type $id 
	 */
	public function actionUpdatePage($id){
		$content = StaticSections::model()->findByPk($id);
		
		$this->layout = '//layouts/column1';
		$this->hideMainMenu = true;
		
		if(isset($_POST['StaticSections'])){
			$content->attributes=$_POST['StaticSections'];
			$content->save();
		}
		$this->pageTitle = 'Wotton Cinema - '. CHtml::encode($content->title);
		$this->render(
			'updatePage',
			array(
				'content'=>$content,
			)
		);
	}
}