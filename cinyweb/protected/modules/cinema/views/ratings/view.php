<?php
$this->breadcrumbs=array(
	'Ratings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ratings', 'url'=>array('index')),
	array('label'=>'Create Ratings', 'url'=>array('create')),
	array('label'=>'Update Ratings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ratings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ratings', 'url'=>array('admin')),
);
?>

<h1>View Ratings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'label',
	),
)); ?>
