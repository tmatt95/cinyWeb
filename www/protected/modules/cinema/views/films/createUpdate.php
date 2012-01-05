<?php 
	echo CHtml::link(
		'Back to Admin Menu',
		array(
			'/admin/index'
		),
		array(
			'class'=>'backToAdminMenuButton',
		)
	); 
?>
<?php echo $form;?>