<h1 class="title-page">Thank you</h1>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div style="height:300px;text-align:center;font-weight:bold;font-size:14px;">
         <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
   <div class="clear"></div>
<?php else: ?>
<?php Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl('site/index')); ?>
<?php endif; ?>
