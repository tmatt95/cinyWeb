<?php
$this->breadcrumbs=array(
	'Ratings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ratings', 'url'=>array('index')),
	array('label'=>'Create Ratings', 'url'=>array('create')),
	array('label'=>'View Ratings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ratings', 'url'=>array('admin')),
);
?>

<h1>Update Ratings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>