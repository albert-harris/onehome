<?php echo $content; ?>
<br />
<br />
You received this message because you are subscribed to the <a href="<?php echo Yii::app()->params['server_name']?>"><?php echo $newsletterName ?></a>. <br />
To unsubscribe from this newsletter, click to <?php echo CHtml::link('unsubscribe', $unsubscribe) ?>. <br />