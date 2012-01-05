<?php
$this->breadcrumbs=array(
	'Genres'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Genres', 'url'=>array('index')),
	array('label'=>'Create Genres', 'url'=>array('create')),
	array('label'=>'Update Genres', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Genres', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Genres', 'url'=>array('admin')),
);
?>

<h1>View Genres #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'label',
	),
)); ?>
