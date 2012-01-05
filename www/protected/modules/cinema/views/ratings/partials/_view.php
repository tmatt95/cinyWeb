<div class="ratings-row">
	<?php echo CHtml::encode($data->label); ?>
	<span class="ratings-options"> - <?php echo CHtml::link('Delete','#',array('data-itemid'=>$data->id)) ?></span>
</div>