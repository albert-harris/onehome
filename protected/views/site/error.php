<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<?php if($code=='400'): ?>
<h2>Page Not Found</h2>
<?php else: ?>
<h2>Error <?php echo $code; ?></h2>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>
<?php endif; ?>