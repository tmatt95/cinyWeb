<?php
	$this->breadcrumbs=array(
		$model->title
	);

	$this->menu=array(
		array('label'=>'Add New Film', 'url'=>array('create')),
		array('label'=>'Update Film', 'url'=>array('update', 'id'=>$model->id)),
		//array('label'=>'Delete Film', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	);
?>

<h1><?php echo $model->title; ?></h1>
<p>Showing next Section</p>
Film page here!