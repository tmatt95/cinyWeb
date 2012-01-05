<?php
$this->breadcrumbs=array(
	'Ratings',
);

$this->menu=array(
	array('label'=>'Create Ratings', 'url'=>array('create')),
	array('label'=>'Manage Ratings', 'url'=>array('admin')),
);
?>

<h1>Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
