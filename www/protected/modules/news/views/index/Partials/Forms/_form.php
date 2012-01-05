<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'news-form',
		'enableAjaxValidation'=>false,
	)); ?>
		<?php echo $form->errorSummary($model); ?>
		<div class="row">
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'excerpt'); ?>
			<?php echo $form->textArea($model,'excerpt',array('rows'=>6, 'cols'=>50,'style'=>'width:100%;')); ?>
			<?php echo $form->error($model,'excerpt'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'content'); ?>
			<?php 
				$this->widget(
					'ext.ckeditor.CKEditorWidget',
					array(
						"model"=>$model,                
						"attribute"=>'content',
						"defaultValue"=>$model->content,
						"config"=>array
						(
							"toolbar"=>"cinemaToolbar",
						)
					)
				); 
			?>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>