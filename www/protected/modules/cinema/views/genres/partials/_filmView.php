<div class="genre-item"><?php echo CHtml::checkbox('filmGenre['.$data->id.']'); ?> 
	<?php echo CHtml::label($data->label,'filmGenre_'.$data->id); ?>
</div>