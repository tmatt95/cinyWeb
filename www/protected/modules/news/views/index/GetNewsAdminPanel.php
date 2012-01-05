<div class="line">
	<div class="unit size1of2">
		<h2>News</h2>
	</div>
	<div class="unit size1of2 lastUnit adminBoxControlButtons">
		<a href="#" id="addNews">
			<?php echo CHtml::link('Add News',array('/news/index/create')); ?>
		</a>
	</div>
</div>
<?php $this->renderPartial('Partials/Grids/_newsAdmin',array('model'=>$model));?>