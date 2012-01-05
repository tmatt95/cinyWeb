<?php
	/**
	 * This is the "showings grid" which can be used to display future/all
	 * showings. These may or may not be for a specific film. It is NOT mean't
	 * to be used in admin sections of the application. If you are wanting to 
	 * use a grid in an Admin section, then use the showings admin grid.
	 * 
	 * @param CActiveRecord $model The instance of the VwShowings table the
	 * grid will use to get its general set up information from
	 * 
	 * @param CActiveDataProvider $modelSearch The grid can render using
	 * different search providers (which must come from the VwShowings model) 
	 * depending on the data that is being displayed (e.g if displaying only 
	 * fulture films, then the future films search would be used instead).
	 */
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'showings-grid',
		'dataProvider'=>$modelSearch,
		'filter'=>$model,
		'summaryText'=>'{count} future showings',
		'columns'=>array(
			array(
				'name'=>'ratingLabel',
				'filter'=>Ratings::getAllRatings(),
				'header' => Showings::model()->getAttributeLabel('ratingLabel')
			),
			array(
				'name'=>'date_time',
				'header' => Showings::model()->getAttributeLabel('date_time')
			),
			array(
				'name'=>'starts',
				'headerHtmlOptions'=>array('style'=>'width:50px;'),
				'header' => Showings::model()->getAttributeLabel('starts'),
			),
			array(
				'name'=>'finishes',
				'headerHtmlOptions'=>array('style'=>'width:50px;'),
				'header' => Showings::model()->getAttributeLabel('ends'),
			),
			array(
				'name'=>'title',
				'value'=>'Films::colTitle($data->title,$data->film_id)',
				'type'=>'raw'
			)
		)
	));
?>