<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'news-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'summaryText'=>'{count} news items',
		'columns'=>array(
			array(
				'name'=>'date_added',
				'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'name'=>'news-grid[date_added]',
					'value'=>$model->date_added
				),true,true,true)
			),
			array(
				'name'=>'title',
				'value'=>'News::colTitle($data->title,$data->id)',
				'type'=>'html'
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}'
			),
		)
	));
?>