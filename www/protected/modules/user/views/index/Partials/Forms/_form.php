<div class="form">
	<?php 
		$form=$this->beginWidget(
			'CActiveForm',
			array(
				'id'=>'users-form',
				'enableAjaxValidation'=>true,
				'htmlOptions'=>array('class'=>'popup-form')
			)
		);
	?>
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username',array('size'=>25,'maxlength'=>256)); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>25,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>250)); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<?php if($model->isNewRecord){ ?>
			<div class="row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password',array('size'=>25,'maxlength'=>250)); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>
		<?php } ?>
		<div class="row">
			<?php echo $form->labelEx($model,'admin'); ?>
			<?php echo $form->checkBox($model,'admin'); ?>
			<?php echo $form->error($model,'admin'); ?>
		</div>
	<?php $this->endWidget(); ?>
</div>