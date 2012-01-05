<?php

class FilmsController extends Controller
{
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
					'index',
					'view',
					'GetFilmInfo'
				),
				'users'=>array('*')
			),
			array(
				'allow', 
				'actions'=>array(
					'create',
					'update'
				),
				'users'=>array('@')
			),
			array(
				'allow',
				'actions'=>array(
					'delete',
					'getfilmsAdminPanel'
				),
				'expression'=>'Users::model()->isAdmin()'
			),
			array(
				'deny',
				'users'=>array('*')
			)
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render(
			'view',
			array(
				'model'=>$this->loadModel($id)
			)
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' 
	 * page.
	 */
	public function actionCreate()
	{
		$genreToFilms = new GenresToFilms;
		$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/listview';
		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('bbq');
		$cs->registerCoreScript('maskedinput');
		$cs->registerScriptFile($baseScriptUrl.'/jquery.yiilistview.js',CClientScript::POS_END);
		
		$this->layout = '//layouts/column1';
		$this->hideMainMenu = true;
		$model=new Films;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Films']))
		{
			$model->attributes=$_POST['Films'];
			if($model->save()){
				// Update the saved genre to film information
				$genreToFilms->model()->updateFilmGenreInformation($model->id);
				
				$this->redirect(array('/cinema/films/update','id'=>$model->id));
			}
		}
		
		// Gets all the genres
		$genres =new CActiveDataProvider('Genres');
		$genres->pagination = false;
		
		// Checked items can be posted
		if(isset($_POST['filmGenre'])){
			foreach ($_POST['filmGenre'] as $id=>$checked)
				$checkedItemIds[] = $id;
			
			$checkedItems = $genreToFilms->model()->findAllByAttributes(array('genre_id'=>$checkedItemIds));
		}else
			$checkedItems = array();
		
		
		// Renders the film form 
		$form = $this->renderPartial(
			'/films/partials/forms/_form',
			array(
				'model'=>$model,
				'genres'=>$genres,
				'checkedItems'=>$checkedItems
			),
			true
		);
		
		// Renders the breadcrumbs
		$this->breadcrumbs=array(
			'Admin'=>array('/admin/index'),
			'Add film',
		);

		$this->render('createUpdate',array(
			'title'=> 'Add Film',
			'model'=>$model,
			'form'=>$form,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 * 
	 * @todo Showings edit/delete buttons do not work!
	 */
	public function actionUpdate($id)
	{
		$this->layout = '//layouts/column1';
		$this->hideMainMenu = true;
		
		$genreToFilms = new GenresToFilms;
		$model=$this->loadModel($id);
		$this->performAjaxValidation($model);
		
		// Used to load all the scripts whiche either needed now or by the items
		// which will be ajaxed in
		$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/listview';
		$cs=Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('bbq');
		$cs->registerCoreScript('maskedinput');
		$cs->registerScriptFile($baseScriptUrl.'/jquery.yiilistview.js',CClientScript::POS_END);
		
		if(isset($_POST['Films'])){
			// Update the saved genre to film information
			$genreToFilms->model()->updateFilmGenreInformation($id);
			
			$model->attributes=$_POST['Films'];
			if($model->save()){
				$this->redirect(array('/cinema/films/update','id'=>$id));
			}
		}
		
		// Finds all the showings
		$showings= new VwShowings('search');
		$showings->unsetAttributes();
		if(isset($_GET['VwShowings']))
			$showings->attributes=$_GET['VwShowings'];
		$showings->film_id = $id;
		
		// Gets all the genres
		$genres =new CActiveDataProvider('Genres');
		$genres->pagination = false;
		
		// Finds all the genres which are attached to the selected film to
		// populate as being ticked
		$criteria = array(
			'condition'=>'film_id ='.$id
		);
		$checkedItems = $genreToFilms->model()->findAll($criteria);
		
		// Renders the film form 
		$form = $this->renderPartial(
			'/films/partials/forms/_form',
			array(
				'model'=>$model,
				'showings'=>$showings,
				'genres'=>$genres,
				'checkedItems'=>$checkedItems
			),
			true
		);
		
		// Gets all the genres
		
		//  Sets the breadcrumb for this page
		$this->breadcrumbs=array(
			'Films'=>array('index'),
			$model->title=>array('view','id'=>$model->id),
			'Update',
		);
		
		$this->render(
			'createUpdate',
			array(
				'model'=>$model,
				'title'=>$model->title,
				'form'=>$form
			)
		);
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
			
		} else {
			throw new CHttpException(
				400,
				'Invalid request. Please do not repeat this request again.'
			);
		}
	}

	/**
	 * Lists all models.
	 * 
	 * @todo Films should be listed in the future and not all films from the 
	 * year dot.
	 */
	public function actionIndex()
	{
		$cs=Yii::app()->getClientScript();
		$dataProvider=new CActiveDataProvider('Films');
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Returns a small information view on a selected film, including stats 
	 * and dates during which it will be shown in the future.
	 * @param int $filmId The id of the film which is being shown. 
	 * 
	 * @todo BUG second click does not work when clicking on the film
	 */
	public function actionGetFilmInfo($filmId){
		$model=new VwShowings('search');
		$this->ajaxScriptControl();
		
		$film = Films::model()->findByPk($filmId);
		
		$model->unsetAttributes();
		if(isset($_GET['VwShowings']))
			$model->attributes=$_GET['VwShowings'];
		$model->film_id = $filmId;
		
		$search = $model->futureSearch();
		$search->pagination = array('pageSize'=>5);
		
		$this->renderPartial(
			'FilmInfo',
			array(
				'film'=>$film,
				'model'=>$model,
				'search'=>$search
			),
			false,
			true
		);
		
	}
	
	/**
	 * Displays the admin panel section for films
	 */
	public function actionGetfilmsAdminPanel(){
		$this->ajaxScriptControl();
		
		// Loads the Film Grid
		$model=new Films('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Films']))
			$model->attributes=$_GET['Films'];
		
		$search = $model->search();
		$search->pagination = array('pageSize'=>5);
		
		$filmGrid = $this->renderPartial(
			'partials/grids/films',
			array(
				'model'=>$model,
				'modelSearch'=>$search
			),
			true
		);
		
		$this->renderPartial(
			'GetfilmsAdminPanel',
			array(
				'model'=>$model,
				'filmGrid'=>$filmGrid
			),
			false,
			true
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Films::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='films-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}