<?php
/**
 * A film can have many "showings" (dates that the film is shown on).
 * 
 * @author Matthew Turner - tmatt95@gmail.com
 * @version 0.1
 */
class ShowingsController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@')
			),
			array('allow',
				'actions'=>array(
					'delete',
					'getShowingsAdminPanel'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array('deny',
				'users'=>array('*')
			),
		);
	}

	/**
	 * Add a new showing to the system and or display the showing creation form. 
	 * 
	 * @param int $filmId The id of the film that the showing should be linked 
	 * to. This is optional and is not required when posting the filled in form
	 * back to the server as it will then be included in a POST variable. It is
	 * madatory when displaying the create form however!
	 * 
	 * @return string containing the create form (with and without errors and 
	 * the view). This is JSON encoded in the following format:
	 * 
	 * .status => Whether or not the create action succeded (1 on success, 0 on
	 * failiure).
	 * 
	 * .view => The create showings form. 
	 */
	public function actionCreate($filmId=null)
	{
		// Performs AJAX validation
		$this->performAjaxValidation($model);
		
		// This is needed to stop jquery overwritting itself
		$this->ajaxScriptControl();
		
		$model=new Showings;
		$response['status'] = 0;
		
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
	 * Updates information on a showing/displays the update showing form
	 * allowing the user to make the update.
	 * 
	 * @param integer $id of the showing being updated
	 * 
	 * @return string containing the create form (with and without errors and 
	 * the view). This is JSON encoded in the following format:
	 * 
	 * .status => Whether or not the create action succeded (1 on success, 0 on
	 * failiure).
	 * 
	 * .view => The create showings form. 
	 */
	public function actionUpdate($id)
	{
		$this->ajaxScriptControl();
		
		$response['status'] = 0;
		$response['view'] = null;
		$model=$this->loadModel('Showings',$id);
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
	 * Deletes a showing from the system.
	 * 
	 * @param integer $id unique id of the showing which you would like to 
	 * delete.
	 * 
	 * @todo Look at what the delete showing function can return.
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){
			$this->loadModel('Showings',$id)->delete();
		}
		else{
			throw new CHttpException(
				400,
				'Invalid request. Please do not repeat this request again.'
			);
		}
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
			'partials/grids/_showingsAdmin',
			array(
				'model'=>$model,
				'modelSearch'=>$search
			),
			true
		);
		
		$this->renderPartial(
			'partials/_showingsAdminPanel',
			array(
				'showingGrid'=>$showingGrid
			),
			false,
			true
		);
	}
}
