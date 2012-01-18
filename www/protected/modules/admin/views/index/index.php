<h1>Administration</h1>
<div id="staticSections">
	<span style="background: none repeat scroll 0% 0% silver; margin: 0px; text-align: right; padding: 9px; font-weight: bold;">Static Sections</span>
	<?php foreach($staticMenu as $id=>$title){ ?>
		<span><?php echo CHtml::link($title,array('/cinema/index/updatePage/','id'=>$id)); ?></span>
	<?php }?>
</div>
<div class="line">
	<div id="showings" class="unit size1of2 notLoaded adminBox" data-action="<?php echo yii::app()->createAbsoluteurl('/cinema/showings/getShowingsAdminPanel')?>">
		Showings
	</div>
	<div id="users" class="unit size1of2 lastUnit notLoaded adminBox" data-action="<?php echo yii::app()->createAbsoluteurl('/user/index/getUsersAdminPanel')?>">
		Users
	</div>
</div>
<div class="line">
	<div id="films" class="unit size1of2 notLoaded adminBox" data-action="<?php echo yii::app()->createAbsoluteurl('/cinema/films/getfilmsAdminPanel')?>">
		Films
	</div>
	<div id="news" class="unit size1of2 lastUnit notLoaded adminBox" data-action="<?php echo yii::app()->createAbsoluteurl('/news/index/getNewsAdminPanel')?>">
		News
	</div>
</div>
<?php $this->renderPartial('Partials/Dialogs/Admin'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".adminBox").click(function() {
			// The id of the view to put the ajaxed data into if successful
			var adminView = $(this).attr('id');
			
			// Stops the panels from being loaded over and over again
			if($(this).hasClass('loaded') == false){
				// The location to ajax the view section from
				var panelUrl = $(this).data('action');

				$(this).removeClass('notLoaded').addClass('loading');

				$.ajax({
					url:panelUrl,
					dataType:"html",
					type:"get",
					success: function(data){
						$('#'+adminView).html(data);
						$('#'+adminView).removeClass('loading').addClass('loaded');
					}
				});
			}
		});		
	});
</script>