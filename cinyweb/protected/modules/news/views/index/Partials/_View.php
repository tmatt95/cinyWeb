<a href="<?php echo Yii::app()->createUrl('/news/index/view',array('id'=>$data->id)); ?>" class="newsItem-main">
    <h2><?php echo CHtml::encode($data->title); ?></h2>
    <p><?php echo CHtml::encode($data->excerpt); ?></p>
</a> 