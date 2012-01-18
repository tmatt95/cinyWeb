<?php
/**
 * BOO... you could categorise that as scary. Genres do the 
 * same for films. There is no set list of genres, which are defined in the
 * database when the application is set up.
 * 
 * @author Matt Turner - tmatt95@gmail.com
 * @version 1.0
 */
class GenresController extends Controller
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
					'create',
					'update'
				),
				'users'=>array('@')
			),
			array('allow',
				'actions'=>array(
					'delete',
					'manageGenres'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array('deny',
				'users'=>array('*')
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' 
	 * page.
	 */
	public function actionCreate($ajax = null)
	{
		$response['status'] = 0;
		$response['view'] = null;
		$model=new Genres;
		$dataProvider=new CActiveDataProvider(
			'Genres',
			array(
				'pagination'=>array('pageSize'=>11)
			)
		);
		
		$this->ajaxScriptControl();

		if(isset($_POST['Genres']))
		{
			$model->attributes=$_POST['Genres'];
			if($model->save()){
				$response['status'] = 1;
			}
		}
		
		if($response['status'] == 1)
			$model=new Genres;
		
		$response['view'] = $this->renderPartial(
			'ManageGenres',
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
	 * If update is successful, the browser will be redirected to the 'view' 
	 * page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel('Genres',$id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Genres']))
		{
			$model->attributes=$_POST['Genres'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' 
	 * page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$id = $_POST['id'];
			$this->loadModel('Genres',$id)->delete();
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionManageGenres()
	{
		$this->ajaxScriptControl();
		
		$model = new Genres;
		$dataProvider=new CActiveDataProvider(
			'Genres',
			array('pagination'=>array('pageSize'=>11))
		);
		
		$this->renderPartial(
			'ManageGenres',
			array(
				'dataProvider'=>$dataProvider,
				'model'=>$model
			),
			false,
			true
		);
	}
}