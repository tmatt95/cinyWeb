<?php $this->renderPartial('partials/forms/_form', array('model'=>$model)); ?>
<script type="text/javascript">
	$(document).ready(function(){
		
		// This is used to enable the form to work through AJAX. It also
		// gives us greater control over what to do depending on how the creation
		// goes.
		$("#showings-form").submit(function(event){
			<?php if($model->isNewRecord){ ?>
				var formUrl = "<?php echo Yii::app()->createUrl('/cinema/showings/create') ?>";
			<?php } else{ ?>
				var formUrl = "<?php echo Yii::app()->createUrl('/cinema/showings/update',array('id'=>$model->id)) ?>";
			<?php } ?>
				
			// Updates the date time field with the start time specified in the 
			// start time text box
			var date = $('#showingDate').val();
			var time = $('#showingTime').val();
			$('#Showings_date_time').val(date + ' ' + time);
			
			// Gets the data from the showing form
			var formData = $("#showings-form").serialize();
			
			$.ajax({
				url: formUrl,
				type:'post',
				dataType:'json',
				data: formData,
				success: function(data){
					if(data.status ==1){
						$("#showingsDialog").dialog('close');
						$.fn.yiiGridView.update('showings-grid');
					}else{
						$("#showingsDialog").html(data.view);
					}
				}
			});
			return false;
		});
	});
</script>