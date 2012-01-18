<?php

	$dateTimeArray = explode(' ',$model->date_time);
					
	if(isset($dateTimeArray[1])){
		$timeValue = $dateTimeArray[1];
		$dateValue = $dateTimeArray[0];
	} else {
		$timeValue = $dateValue = '';
	}

?>
<div class="form">
	<?php 
		$form=$this->beginWidget(
			'CActiveForm',
			array(
				'id'=>'showings-form',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('class'=>'popup-form')
			)
		); 
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'date_time'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'showings-form[date]',
				'id'=>'showingDate',
				'value'=>$dateValue,
				'options'=>array(
					'defaultDate'=>'+0',
					'dateFormat'=>'yy-mm-dd'
				),
			));
		?>
	</div>
	<div class="row">
		<label>Starts</label>
		<?php
			$this->widget(
				'CMaskedTextField',
				array(
					'name' => 'showingTime',
					'mask' => '99:99',
					'value'=> $timeValue,
					'htmlOptions'=>array('placeholder'=>'HH:MM')
				)
			);
		?>
		<?php echo $form->hiddenField($model,'date_time');?>
		<?php echo $form->error($model,'date_time'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'three_d'); ?>
		<?php 
			echo $form->checkbox(
				$model,
				'three_d',
				array(
					'size'=>10,
					'maxlength'=>10
				)
			); 
		?>
		<?php echo $form->error($model,'three_d'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'private'); ?>
		<?php 
			echo $form->checkbox(
				$model,
				'private',
				array(
					'size'=>10,
					'maxlength'=>10
				)
			); 
		?>
		<?php echo $form->error($model,'private'); ?>
	</div>
	<div class="row">
		<?php 
			echo $form->hiddenField(
				$model,
				'film_id',
				array(
					'size'=>10,
					'maxlength'=>10
				)
			); 
		?>
	</div>
<?php $this->endWidget(); ?>
</div>