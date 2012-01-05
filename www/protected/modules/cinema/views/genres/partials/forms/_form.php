<div class="form">
	<?php 
		$form=$this->beginWidget(
			'CActiveForm',
			array(
				'id'=>'genres-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('class'=>'popup-form')
			)
		); 
	?>
	<div class="line">
		<div class="unit">
			<?php echo $form->labelEx($model,'label',array('style'=>'width:43px;')); ?>
		</div>
		<div class="unit">
			<?php echo $form->textField($model,'label',array('size'=>32,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'label',array('style'=>'margin-left:0px;')); ?>
		</div>
		<div class="unit lastUnit">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save'); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>