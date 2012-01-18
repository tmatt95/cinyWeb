<?php

class IndexController extends Controller
{
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
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array(
					'create',
					'update'
				),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array(
					'GetNewsAdminPanel',
					'delete'
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
			'model'=>$this->loadModel('News',$id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;
		$this->hideMainMenu = true;
		$this->layout = '//layouts/column1';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('createUpdate',array(
			'model'=>$model,
			'title'=>'Create News Item'
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->hideMainMenu = true;
		$this->layout = '//layouts/column1';
		$model=$this->loadModel('News',$id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('createUpdate',array(
			'model'=>$model,
			'title'=>'Update News Item'
		));
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
			$this->loadModel('News',$id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionGetNewsAdminPanel(){
		$this->ajaxScriptControl();
		
		$model=new News('search');
		$model->unsetAttributes(); 
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->renderPartial(
			'GetNewsAdminPanel',
			array(
				'model'=>$model
			),
			false,
			true
		);
	}
}