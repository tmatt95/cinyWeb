<?php $this->beginContent('//layouts/main'); ?>
	<div class="rightCol">
		<?php
			if(Users::model()->isAdmin()){
				$this->beginWidget(
					'zii.widgets.CPortlet', 
					array(
						'title'=>'Operations',
					)
				);
				$this->widget(
					'zii.widgets.CMenu',
					array(
						'items'=>$this->menu,
						'htmlOptions'=>array(
							'class'=>'operations'
						),
					)
				);
				$this->endWidget();
			}
		?>
		<div id="newsSection" >
			<h2>Latest News</h2>
		</div>
	</div>
	<div class="main"><?php echo $content; ?></div>
<?php $this->endContent(); ?>