<div class="form">
	<?php 
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'static-section',
			'enableAjaxValidation'=>true,
		)); 
	?>
	<?php 
		$this->widget(
			'ext.ckeditor.CKEditorWidget',
			array(
				"model"=>$content,                
				"attribute"=>'content',
				"defaultValue"=>$content->content,
				"config"=>array
				(
					"toolbar"=>"cinemaToolbar"
				)			
			)
		); 
	?>
	<?php $this->endWidget(); ?>
</div>