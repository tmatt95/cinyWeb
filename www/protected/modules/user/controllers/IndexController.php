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
			array(
				'allow',
				'actions'=>array(
					'Login'
				),
				'users'=>array('*'),
			),
			array(
				'allow',
				'actions'=>array(
					'create',
					'update',
					'Logout'
				),
				'users'=>array('@'),
			),
			array(
				'allow',
				'actions'=>array(
					'GetUsersAdminPanel',
					'delete'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array(
				'deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$response = array();  
		$response['status'] = 0;
		$response['view'] = null;
		$model=new Users;
		
		$this->ajaxScriptControl();

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$response['status'] = 1;
		}
		
		if($response['status'] == 0){
			$response['view'] = $this->renderPartial(
				'createUpdate',
				array(
					'model'=>$model,
				),
				true
			);
		}
		echo json_encode($response);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$response = array();
		$response['view'] = null;
		$response['status'] = 0;
		
		$this->ajaxScriptControl();
		
		$model=$this->loadModel('Users',$id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$response['status'] = 1;
		}

		if($response['status'] == 0){
			$response['view'] = $this->renderPartial(
				'createUpdate',
				array(
					'model'=>$model,
				),
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
			$this->loadModel('Users',$id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Returns the admin panel users section
	 */
	public function actionGetUsersAdminPanel(){
		$this->ajaxScriptControl();
		
		$model=new Users('search');
		$model->unsetAttributes(); 
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];
		
		$search = $model->search();
		$search->pagination = array('pageSize'=>7);
		
		$this->renderPartial(
			'GetUsersAdminPanel',
			array(
				'model'=>$model,
				'search'=>$search
			),
			false,
			true
		);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}