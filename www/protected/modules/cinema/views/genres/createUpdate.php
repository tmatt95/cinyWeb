<?php
$this->breadcrumbs=array(
	'Genres'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Genres', 'url'=>array('index')),
	array('label'=>'Create Genres', 'url'=>array('create')),
	array('label'=>'View Genres', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Genres', 'url'=>array('admin')),
);
?>

<h1>Update Genres <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>