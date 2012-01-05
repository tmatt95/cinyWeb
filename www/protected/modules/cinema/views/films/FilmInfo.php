<?php if($film->youtube_embed_url){ ?>
	<iframe width="420" height="300" frameborder="0" src="<?php echo $film->youtube_embed_url; ?>" allowfullscreen=""></iframe>
<?php } ?>
<h2>Info</h2>
<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$film,
		'attributes'=>array(
			array(
				'name'=>'rating',
				'value'=>$film->ratings->label
			),
			array(
				'name'=>'length',
				'value'=> $film->length.' mins'
			),
			'story',
			'director',
			'screenwriter',
			array(
				'name'=>'link_website',
				'type'=>'html',
				'value'=>CHtml::link($film->link_website,$film->link_website)
			)
		),
	));
?>
<h2>Future Showings</h2>
<?php 
	$this->renderPartial(
		'/showings/partials/grids/futureFilmshowings',
		array(
			'model'=>$model,
			'modelSearch'=>$search
		)
	)
?>