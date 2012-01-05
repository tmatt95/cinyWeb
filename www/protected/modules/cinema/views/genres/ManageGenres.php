<h2>New Genre</h2>
<div id="newGenre">
	<?php 
		echo $this->renderPartial(
			'partials/forms/_form',
			array(
				'model'=>$model
			)
		); 
	?>
</div>
<h2>Current Genres</h2>
<?php 
	$this->widget(
		'zii.widgets.CListView',
		array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'partials/_view',
			'enablePagination'=>true,
			'emptyText'=>'No Genres currently in the system',
			'summaryText'=>''
			
		)
	);
?>