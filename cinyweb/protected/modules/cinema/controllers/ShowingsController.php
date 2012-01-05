<?php
/**
 * A film can have many "showings" (dates that the film is shown).
 */
class ShowingsController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow', 
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array(
					'admin',
					'delete',
					'getShowingsAdminPanel'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' 
	 * page.
	 * 
	 * @param int $filmId The id of the film that the showing should be linked 
	 * to
	 */
	public function actionCreate($filmId=null)
	{
		$this->ajaxScriptControl();
		$response['status'] = 0;
		
		// This is needed to stop jquery overwritting itself
		//$this->ajaxScriptControl();
		
		$model=new Showings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Showings']))
		{
			$model->attributes=$_POST['Showings'];
			if($model->save())
				$response['status'] = 1;
		}

		$model->film_id = $filmId;
		
		$response['view'] = $this->renderPartial(
			'createUpdate',
			array(
				'model'=>$model,
			),
			true,
			true
		);
		echo json_encode($response);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->ajaxScriptControl();
		
		$response['status'] = 0;
		$response['view'] = null;
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Showings']))
		{
			$model->attributes=$_POST['Showings'];
			if($model->save())
				$response['status']=1;
		}
		if($response['status']== 0){
			$response['view'] = $this->renderPartial(
				'createUpdate',
				array(
					'model'=>$model,
				),
				true,
				true
			);
		}
		echo json_encode($response);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Showings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Showings('search');
		$model->unsetAttributes();
		if(isset($_GET['Showings']))
			$model->attributes=$_GET['Showings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model=Showings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * This is the showings panel which is loaded when the admin selects it from
	 * the administration panel
	 * 
	 * @todo To think about. The showing grid needs to display all items here
	 * but on the home page should only display items from this point forward
	 * It currently displays all the items. How should this be fixed for the
	 * main menu?
	 */
	public function actionGetShowingsAdminPanel(){
		$this->ajaxScriptControl();
		
		$model=new VwShowings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwShowings']))
			$model->attributes=$_GET['VwShowings'];
		
		$search = $model->search();
		$search->pagination = array('pageSize'=>5);
		
		$showingGrid = $this->renderPartial(
			'partials/grids/showingsAdmin',
			array(
				'model'=>$model,
				'modelSearch'=>$search
			),
			true
		);
		
		$this->renderPartial(
			'getShowingsAdminPanel',
			array(
				'showingGrid'=>$showingGrid
			),
			false,
			true
		);
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='showings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
