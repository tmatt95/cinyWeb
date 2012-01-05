<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'films-grid',
	'dataProvider'=>$modelSearch,
	'filter'=>$model,
	'summaryText'=>'{count} films',
	'columns'=>array(
		array(
			'name'=>'rating',
			'value'=>'Films::colRating($data->ratingLabel)',
			'filter'=>Ratings::getAllRatings()
		),
		array(
			'name'=>'title',
			'value'=>'Films::updateColTitle($data->title,$data->id)',
			'type'=>'html'
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}'
		),
	),
)); ?>