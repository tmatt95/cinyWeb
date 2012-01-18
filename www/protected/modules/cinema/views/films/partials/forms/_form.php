<script>

	// Refresh the film genre tick boxes
	function refreshFilmGenres(updateListView){
		if(updateListView == true){
			$.fn.yiiListView.update('film-genres');
		}
		
		<?php foreach($checkedItems as $ci){ ?>
				$('#filmGenre_<?php echo $ci->genre_id; ?>').attr('checked','checked');
		<?php } ?>
	}

</script>
<div class="form cinemaform">
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'films-form',
			'enableAjaxValidation'=>true,
		)); 
	?>
		<div class="line">
			<?php echo $form->errorSummary($model); ?>
			<div class="unit size1of2">
				<h2>Basic Info</h2>
				<div class="row">
					<?php echo $form->labelEx($model,'title'); ?>
					<?php 
						echo $form->textField(
							$model,
							'title',
							array(
								'size'=>41,
								'maxlength'=>250
							)
						); 
					?>
					<?php echo $form->error($model,'title'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'rating'); ?>
					<span id="ratingSelect">
						<?php 
							echo $form->dropdownList(
								$model,
								'rating',
								Ratings::model()->getAllRatings()
							); 
						?>
					</span> - <a href="#" id="manageRatings">Manage Ratings</a>
					<?php echo $form->error($model,'rating'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'length'); ?>
					<?php 
						echo $form->textField(
							$model,
							'length',
							array(
								'size'=>10,
								'maxlength'=>10
							)
						); 
					?>
					<?php echo $form->error($model,'length'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'story'); ?>
					<?php 
						echo $form->textArea(
							$model,
							'story',
							array(
								'rows'=>6,
								'cols'=>39
							)
						); 
					?>
					<?php echo $form->error($model,'story'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'screenwriter'); ?>
					<?php 
						echo $form->textArea(
							$model,
							'screenwriter',
							array(
								'rows'=>6,
								'cols'=>39
							)
						);
					?>
					<?php echo $form->error($model,'screenwriter'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'director'); ?>
					<?php 
						echo $form->textArea(
							$model,
							'director',
							array(
								'rows'=>6,
								'cols'=>39
							)
						);
					?>
					<?php echo $form->error($model,'director'); ?>
				</div>
			</div>
			<div class="unit size1of2 lastUnit">
				<div class="line">
					<div class="unit size1of2">
						<h2>Genres</h2>
					</div>
					<div class="unit size1of2 lastUnit adminBoxControlButtons" style="padding-top:17px;">
						<a id="addGenre" href="#">Manage Genres</a>
					</div>
					<div style="clear: both;">
					<?php 
						$this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$genres,
							'itemView'=>'/genres/partials/_filmView',
							'summaryText'=>'',
							'id'=>'film-genres',
							'afterAjaxUpdate'=>'function (id,data) {refreshFilmGenres(false);}'
						));
					?>
					</div>
				</div>
				<h2>Links</h2>
				<div class="row">
					<?php echo $form->labelEx($model,'link_website'); ?>
					<?php 
						echo $form->textField(
							$model,
							'link_website',
							array(
								'size'=>41,
								'maxlength'=>250
							)
						);
					?>
					<?php echo $form->error($model,'link_website'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'link_trailer'); ?>
					<?php 
						echo $form->textField(
							$model,
							'link_trailer',
							array(
								'size'=>41,
								'maxlength'=>250
							)
						);
					?>
					<?php echo $form->error($model,'youtube_embed_url'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'youtube_embed_url'); ?>
					<?php 
						echo $form->textField(
							$model,
							'youtube_embed_url',
							array(
								'size'=>41
							)
						);
					?>
					<?php echo $form->error($model,'youtube_embed_url'); ?>
				</div>
				<div class="line" style="clear:both;">
					<div class="unit size1of2">
						<h2>Showings</h2>
					</div>
					<div class="unit size1of2 lastUnit adminBoxControlButtons" style="padding-top:17px;">
						<?php if($model->isNewRecord == false){ ?>
							<a id="addShowing" href="#">New Showing</a>
						<?php } ?>
					</div>
				</div>
				<?php if($model->isNewRecord == true){ ?>
					<div>
						You can add showing after saving the film.
					</div>
				<?php }else{ ?>
					<?php 
						$this->renderPartial(
							'/showings/partials/grids/_showingsAdmin',
							array(
								'model'=>$showings,
								'modelSearch'=>$showings->search(),
								'hideTitle'=>true
							)
						); 
					?>
				<?php } ?>
			</div>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>
<?php $this->renderPartial('partials/Dialogs/_FilmDialog'); ?>
<script type="text/javascript">
	
	$(document).ready(function(){
		// Displays the add new showing dialog
		$("#addShowing").click(function(event){
			$('#showingsDialog').dialog('open');
			$('#showingsDialog').dialog( "option", "title", 'Add New Showing' );
			$('#showingsDialog').html('Loading...');
			$('#showingsDialog').dialog( "option", "height", 326 );
			$('#showingsDialog').dialog(
			"option",
			"buttons", 
			{ "Add": function() { $("#showings-form").submit(); },
				"Cancel": function() { $(this).dialog("close"); } 
			} 
		);
			
			$.ajax({
				url: "<?php echo Yii::app()->createUrl('/cinema/showings/create') ?>",
				data:"filmId=<?php echo $model->id; ?>",
				type:"get",
				dataType:"json",
				success: function(data){
					$('#showingsDialog').html(data.view);
				}
			});
			
			return false;
		});
		
		// RATINGS -------------------------------------------------------------
		
		// Displays the manage ratings dialog
		$("#manageRatings").click(function(event){
			$('#filmDialog').dialog('open');
			$('#filmDialog').dialog( "option", "title", 'Manage Ratings' );
			$('#filmDialog').html('Loading...');
			$('#filmDialog').dialog(
				"option",
				"buttons", 
				{ "Close": function() { $(this).dialog("close"); } 
				} 
			);
			
			$.ajax({
				url: "<?php echo Yii::app()->createUrl('/cinema/Ratings/ManageRatings'); ?>",
				success: function(data){
					$('#filmDialog').html(data);
				}
			});
			return false;
		});
		
		$("body").delegate("#ratings-form", "submit", function() {
			var formUrl = "<?php echo Yii::app()->createUrl('/cinema/ratings/create') ?>";
			var formData = $("#ratings-form").serialize();
			
			$.ajax({
				url: formUrl,
				type:'post',
				dataType:'json',
				data: formData,
				success: function(data){
					$("#filmDialog").html(data.view);
					updateRatings();
				}
			});
			return false;
		});
		
		
		// Delete a genre and all the information related to it from the
		// system
		$("body").delegate(".ratings-options a", "click", function() {
			var confirmation = confirm('Are you sure you want to delete the selected genre');
			var id = $(this).data('itemid');
			
			if(confirmation==true){
				$.ajax({
					url: "<?php echo Yii::app()->createUrl('cinema/ratings/delete'); ?>",
					data:"id="+id,
					type:'post',
					success: function(){
						$.fn.yiiListView.update('ratingsListView');
						updateRatings();
					}
				});
			}
			return false;
		});
		
		// Refreshes the contents of the 
		function updateRatings(){
			var selectedId = $('#Films_rating').val();
			
			$.ajax({
				url: "<?php echo Yii::app()->createUrl('/cinema/Ratings/getRatingsSelect'); ?>",
				data:'selectedId='+selectedId,
				type:'get',
				success: function(data){
					$('#ratingSelect').html(data);
				}
			});
		}
		
		// Genres --------------------------------------------------------------
		$("body").delegate("#genres-form", "submit", function() {
			var formUrl = "<?php echo Yii::app()->createUrl('/cinema/genres/create') ?>";
			var formData = $("#genres-form").serialize();
			
			$.ajax({
				url: formUrl,
				type:'post',
				dataType:'json',
				data: formData,
				success: function(data){
					$("#filmDialog").html(data.view);
					$.fn.yiiListView.update('film-genres');
					refreshFilmGenres(false);
				}
			});
			return false;
		});
		
		// Delete a genre and all the information related to it from the
		// system
		$("body").delegate(".genre-options a", "click", function() {
			var confirmation = confirm('Are you sure you want to delete the selected genre');
			var id = $(this).data('itemid');
			
			if(confirmation==true){
				$.ajax({
					url: "<?php echo Yii::app()->createUrl('cinema/genres/delete'); ?>",
					data:"id="+id,
					type:'post',
					success: function(){
						$.fn.yiiListView.update('yw0');
						$.fn.yiiListView.update('film-genres');
					}
				});
			}
			return false;
		});
		
		// Displays the manage genres dialog box
		$("#addGenre").click(function(event){
			$('#filmDialog').dialog('open');
			$('#filmDialog').dialog( "option", "title", 'Manage Genres' );
			$('#filmDialog').html('Loading...');
			$('#filmDialog').dialog( "option", "height", 575 );
			$('#filmDialog').dialog(
				"option",
				"buttons", 
				{ 
					"Close": function() { $(this).dialog("close");} 
				} 
			);
			
			$.ajax({
				url: "<?php echo Yii::app()->createUrl('/cinema/Genres/ManageGenres') ?>",
				success: function(data){
					$('#filmDialog').html(data);
				}
			});
			return false;
		});
		
		refreshFilmGenres(false);
	});
</script>