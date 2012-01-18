<?php
/**
 * Films can be assigned a rating which can then be used by film goers to decide
 * whether or not to watch the film (18 and PG).
 * 
 * @author Matt Turner - tmatt95@gmail.com
 * @version 0.1
 */
class RatingsController extends Controller
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
					'delete',
					'manageRatings',
					'getRatingsSelect',
					'create',
					'update'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array('deny',
				'users'=>array('*'),
			)
		);
	}

	/**
	 * Conatins the manage rating section which is used to add / delete ratings
	 * from the system.
	 * 
	 * The actual creation/deletion is carried out in other actions in this
	 * controller. 
	 */
	public function actionManageRatings(){
		$this->ajaxScriptControl();
		$dataProvider=new CActiveDataProvider('Ratings');
		$dataProvider->pagination = false;
		
		$model=new Ratings;
		
		if(isset($_POST['Ratings']))
		{
			$model->attributes=$_POST['Ratings'];
			$model->save();
		}
		
		$this->renderPartial(
			'partials/_manageRatings',
			array(
				'dataProvider'=>$dataProvider,
				'model'=>$model
			),
			false,
			true
		);
	}

	/**
	 * Adds a new rating to the system/shows the creation form, through which 
	 * the new rating is added. 
	 */
	public function actionCreate($ajax = null)
	{
		$this->ajaxScriptControl();
		$response['status'] = 0;
		$response['view'] = null;
		$model=new Ratings;
		$dataProvider=new CActiveDataProvider(
			'Ratings',
			array(
				'pagination'=>array('pageSize'=>11)
			)
		);

		if(isset($_POST['Ratings'])){
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
	 * Updates a rating.
	 * 
	 * @param integer $id the ID of the model to be updated
	 * @todo Showings cannot be currently updated.
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel('Ratings',$id);

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
	 * Deletes an individual rating from the system.
	 * @param integer $id of the rating to be deleted
	 */
	public function actionDelete()
	{
		$id = $_POST['id'];
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel('Ratings',$id)->delete();
		}
		else {
			throw new CHttpException(
				400,
				'Invalid request. Please do not repeat this request again.'
			);
		}
	}
	
	/**
	 * There are times when we want to update just the ratings drop down list 
	 * dynamically after the page has loaded (such as after adding/deleting a 
	 * rating from the system). This action will do just that, returning just 
	 * the dropdown list with the selected item, selected.
	 * 
	 * @param integer $selectedId id of the selected rating which will be set as
	 * selected when returned to the browser.
	 */
	public function actionGetRatingsSelect($selectedId = null){
		// Gets an array of all the ratings in the system
		$ratings = Ratings::model()->getAllRatings();
		
		// If the selected id no longer exists (the rating could have been
		// deleted) then sets it to null. With it set to this the top rating 
		// will be chosen.
		if(!array_key_exists($selectedId, $ratings))
			$selectedId = null;
		
		// @todo supply the name of the rating field as a get parameter. This 
		// would mean that the rating field can be used in more than just the 
		// film form.
		echo CHtml::dropDownList(
			'Films[rating]',
			$selectedId,
			Ratings::model()->getAllRatings()
		);
	}
}