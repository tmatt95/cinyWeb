<div class="genre-row">
	<?php echo CHtml::encode($data->label); ?>
	<span class="genre-options"> - <?php echo CHtml::link('Delete','#',array('data-itemid'=>$data->id)) ?></span>
</div>