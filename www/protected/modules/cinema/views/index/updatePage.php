<h1><?php echo CHtml::encode($content->title); ?></h1>
<?php echo CHtml::link('Back to Admin Menu',array('/admin/index'),array('class'=>'backToAdminMenuButton')); ?>
<div class="staticContent">
	<?php 
		$this->renderPartial(
			'Partials/Forms/_StaticSection',
			array('content'=>$content)
		); 
	?>
</div>