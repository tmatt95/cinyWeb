<h1>Films</h1>
<?php 
	$this->renderPartial(
		'/showings/partials/grids/showings',
		array(
			'model'=>$model,
			'modelSearch'=>$search
		),
		false
	);
?>
<?php $this->renderPartial('Partials/Dialogs/FilmInfo'); ?>
<script>
	$(document).ready(function(){	

		$("body").delegate(".filmLink", "click", function() {
			// The id of the selected film
			var filmId = $(this).data('filmid');
			
			$('#filmInfoDialog').dialog('open');
			$( "#filmInfoDialog" ).dialog( "option", "title", $(this).html());
			$( "#filmInfoDialog" ).html('Loading....');
			
			$.ajax({
				url: '<?php echo Yii::app()->createUrl('/cinema/Films/GetFilmInfo') ?>',
				type:'GET',
				data:'filmId='+filmId,
				success: function(data) {
					$( "#filmInfoDialog" ).html(data);
				}
			});
			return false;
		});
	});
</script>