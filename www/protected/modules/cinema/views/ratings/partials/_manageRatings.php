<h2>New Rating</h2>
<?php 
	echo $this->renderPartial('partials/forms/_form', array('model'=>$model)); 
?>
<h2>Current Ratings</h2>
<?php 
	$this->widget(
		'zii.widgets.CListView', 
		array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'partials/_view',
			'emptyText'=>'No Ratings currently in the system',
			'summaryText'=>'',
			'id'=>'ratingsListView'
		)
	); 
?>