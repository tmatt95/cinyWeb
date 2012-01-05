<?php
	$this->breadcrumbs=array(
		'Genres',
	);
	$this->menu=array(
		array('label'=>'Create Genres', 'url'=>array('create')),
		array('label'=>'Manage Genres', 'url'=>array('admin')),
	);
?>
<h1>Genres</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'partials/_view',
)); ?>
