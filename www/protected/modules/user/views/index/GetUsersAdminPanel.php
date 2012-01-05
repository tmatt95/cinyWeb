<div class="line">
	<div class="unit size1of2">
		<h2>Users</h2>
	</div>
	<div class="unit size1of2 lastUnit adminBoxControlButtons">
		<a id="addUser" href="#">Add User</a>
	</div>
</div>
<?php
	$this->renderPartial(
		'Partials/Grids/_users',
		array(
			'model'=>$model,
			'search'=>$search
		)
	);
?>
<script>
	$(document).ready(function() {
		
		// Add a new user to the application
		$("#addUser").click(function() {
			$('#adminDialog').dialog('open');
			$('#adminDialog').dialog( "option", "title", 'Add User' );
			$('#adminDialog').html("Loading...");
			$('#adminDialog').dialog( "option", "width", 454 );
			$('#adminDialog').dialog( "option", "buttons", { "Add User": function() { $("#users-form").submit(); },"cancel": function() { $(this).dialog("close"); }  } );
			$('#adminDialog').data("userType","Add");
			
			$.ajax({
			  url:'<?php echo Yii::app()->createUrl('/user/index/create'); ?>',
			  dataType:'json',
			  success: function(data) {
				$('#adminDialog').html(data.view);
			  }
			});
			
			return false;
		});
		
		$("body").delegate("#users-grid .update", "click", function() {
			var userEditUrl = $(this).attr('href');
			
			$('#adminDialog').dialog('open');
			$('#adminDialog').dialog( "option", "title", 'Update User' );
			$('#adminDialog').html("Loading...");
			$('#adminDialog').dialog( "option", "width", 454 );
			$('#adminDialog').dialog( "option", "buttons", { "Update User": function() { $("#users-form").submit(); },"cancel": function() { $(this).dialog("close"); }  } );
			$('#adminDialog').data("userType","Update");
			
			$.ajax({
			  url:userEditUrl,
			  dataType:'json',
			  success: function(data) {
					var type = $('#adminDialog').data("userType");
					$('#adminDialog').html(data.view);
					$('#adminDialog').dialog( "option", "title", type +' ' +$("#Users_name").val());
			  }
			});
		
			return false;
		});
		
		$("body").delegate("#Users_name", "keyup", function() {
			var type = $('#adminDialog').data("userType");
			$('#adminDialog').dialog( "option", "title", type +' ' +$(this).val());
		});
		
		$("body").delegate("#users-form", "submit", function() {
			var formData = $("#users-form").serialize();
			var goTo = $("#users-form").attr('action');
			
			$.ajax({
			  url:goTo,
			  data:formData,
			  type:'POST',
			  dataType:'json',
			  success: function(data) {
				if(data.status == 1){
					$('#adminDialog').dialog('close');
					$.fn.yiiGridView.update('users-grid');
				}else{
					$('#adminDialog').html(data.view);
				}
			  }
			});
			return false;
		});
	});
</script>