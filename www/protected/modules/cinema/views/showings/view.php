<?php
	$this->breadcrumbs=array(
		'Showings'=>array('index'),
		$model->id,
	);

	$this->menu=array(
		array('label'=>'List Showings', 'url'=>array('index')),
		array('label'=>'Create Showings', 'url'=>array('create')),
		array('label'=>'Update Showings', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Showings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Showings', 'url'=>array('admin')),
	);
?>
<h1>View Showings #<?php echo $model->id; ?></h1>
<?php 
	$this->widget(
		'zii.widgets.CDetailView',
		array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'date_time',
				'three_d',
				'private',
				'film_id',
				'added',
			),
		)
	); 
?>
