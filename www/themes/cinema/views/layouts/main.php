<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/oocss/all.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cinema.css"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
	<body>
		<div class="page">
			<div class="head">
				<div id="logoText">
					<?php echo CHtml::encode(Yii::app()->name); ?>
				</div>
			</div>
			<div class="body">
				<?php if($this->hideMainMenu == false){ ?>
					<div id="menuSection">
						<div id="volunteerLink">
							<?php 
								echo CHtml::link(
									'Volunteer with us',
									array(
										'/cinema/index/page',
										'id'=>4
									)
								) 
							?>
						</div>
						<div id="mainmenu">
							<?php 
								$this->widget(
									'zii.widgets.CMenu',
									array(
										'items'=>Menus::getMenuItems()
									)
								);
							?>
						</div>
					</div>
				<?php } ?>
				<?php if(isset($this->breadcrumbs)):?>
					<?php 
//						$this->widget(
//							'zii.widgets.CBreadcrumbs',
//							array(
//								'links'=>$this->breadcrumbs
//							)
//						); 
					?>
				<?php endif?>
				<?php echo $content; ?>
			</div>
			<div class="foot">
				<p>
					<?php 
						echo Chtml::link(
							'Terms and Conditions',
							array(
								'/cinema/index/page',
								'id'=>5
							)
						); 
					?> 
					| 
					<?php if(Yii::app()->user->getIsGuest()){ ?>
						<?php 
							echo Chtml::link(
								'Login',
								Yii::app()->user->loginUrl
							);
						?>
					<?php }else{ ?>
						<?php if(Users::model()->isAdmin() && isset($this->module) && $this->module->name !='admin'){ ?>
							<?php echo Chtml::link('Admin',array('/admin/index/index')) ?> |
						<?php }else{ ?>
							<?php echo Chtml::link('Home',Yii::app()->homeUrl) ?> |
						<?php } ?>
						<?php echo Yii::app()->user->name; ?> (
						<?php 
							echo Chtml::link(
								'Logout',
								array(
									'/user/index/logout'
								)
							) 
						?>
						)
					<?php } ?>
				</p>
				<?php echo Yii::powered(); ?>
			</div>	
		</div>
	</body>
</html>