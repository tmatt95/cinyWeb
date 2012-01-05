<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'showings-grid',
		'dataProvider'=>$modelSearch,
		'emptyText'=>'No Showings Found',
		'filter'=>$model,
		'summaryText'=>'{count} showings',
		'columns'=>array(
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
				'value'=>'Films::updateColTitle($data->title,$data->film_id)',
				'type'=>'raw',
				'visible'=>(isset($hideTitle) && $hideTitle  ==true)?false:true
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}{delete}',
				'updateButtonUrl'=>'array("/cinema/showings/update","id"=>$data->id)',
				'deleteButtonUrl'=>'array("/cinema/showings/delete","id"=>$data->id)'
			),
		)
	));
?>
<?php $this->renderPartial('/showings/partials/Dialogs/_showingsDialog'); ?>
<script>
	$(document).ready(function(){
		
		// Delete a showing from the system - NON REVERSABLE
		$("body").delegate("#showings-grid .delete", "click", function() {
			var confirmDelete = confirm('Are you sure you want to delete the selected showing?');
			var deleteUrl = $(this).attr('href');
			
			if(confirmDelete){
				$.ajax({
					url: deleteUrl,
					type:'post',
					success: function(data){
						$.fn.yiiGridView.update('showings-grid');
					}
				});
			}
			return false;
		});
		
		// Update showing information
		$("body").delegate("#showings-grid .update", "click", function() {
			var updateUrl = $(this).attr('href');
			$('#showingsDialog').dialog('open');
			$('#showingsDialog').dialog( "option", "title", 'Update Showing' );
			$('#showingsDialog').dialog(
			"option",
			"buttons", 
				{ 
					"Update": function() { $('#showings-form').submit(); },
					"Cancel": function() { $(this).dialog("close"); } 
				});
			
			$.ajax({
				url: updateUrl,
				dataType:'json',
				success: function(data){
					$('#showingsDialog').html(data.view);
				}
			});
			
			return false;
		});
	});
</script>