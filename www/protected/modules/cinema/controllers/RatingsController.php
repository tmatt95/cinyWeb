<?php

class RatingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array(
					'index',
					'view'
				),
				'users'=>array('*')
			),
			array('allow',
				'actions'=>array(
					'create',
					'update'
				),
				'users'=>array('@')
			),
			array('allow',
				'actions'=>array(
					'admin',
					'delete',
					'ManageRatings',
					'GetRatingsSelect'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array('deny',
				'users'=>array('*'),
			)
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
	 * 
	 */
	public function actionManageRatings(){
		$this->ajaxScriptControl();
		$dataProvider=new CActiveDataProvider('Ratings');
		$dataProvider->pagination = false;
		
		$model=new Ratings;
		
		if(isset($_POST['Ratings']))
		{
			$model->attributes=$_POST['Ratings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->renderPartial(
			'manageRatings',
			array(
				'dataProvider'=>$dataProvider,
				'model'=>$model
			),
			false,
			true
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($ajax = null)
	{
		$this->ajaxScriptControl();
		$response['status'] = 0;
		$response['view'] = null;
		$model=new Ratings;
		$dataProvider=new CActiveDataProvider('Ratings',array('pagination'=>array('pageSize'=>11)));

		if(isset($_POST['Ratings']))
		{
			$model->attributes=$_POST['Ratings'];
			if($model->save())
				$response['status'] = 1;
		}
		
		$response['view'] = $this->renderPartial(
			'manageRatings',
			array(
				'dataProvider'=>$dataProvider,
				'model'=>$model
			),
			true,
			true
		);
		if(isset($ajax))
			echo $response['view'];
		else
			echo json_encode($response);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ratings']))
		{
			$model->attributes=$_POST['Ratings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		$id = $_POST['id'];
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionGetRatingsSelect($selectedId = null){
		$ratings = Ratings::model()->getAllRatings();
		
		if(!array_key_exists($selectedId, $ratings))
			$selectedId = null;
				
		echo CHtml::dropDownList('Films[rating]',$selectedId,Ratings::model()->getAllRatings());
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ratings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ratings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ratings']))
			$model->attributes=$_GET['Ratings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Ratings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ratings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
