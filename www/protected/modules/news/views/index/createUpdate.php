<?php
//	$this->breadcrumbs=array(
//		'News'=>array('index'),
//		'Create',
//	);
//
//	$this->menu=array(
//		array('label'=>'List News', 'url'=>array('index')),
//		array('label'=>'Manage News', 'url'=>array('admin')),
//	);
?>
<h1><?php echo $title; ?></h1>
<?php echo CHtml::link('Back to Admin Menu',array('/admin/index'),array('class'=>'backToAdminMenuButton')); ?>
<?php echo $this->renderPartial('Partials/Forms/_form', array('model'=>$model)); ?>