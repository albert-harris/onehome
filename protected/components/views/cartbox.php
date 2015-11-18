<div class="cart" onclick="window.location.href='<?php echo Yii::app()->createAbsoluteUrl('site/cart');?>'" style="cursor: pointer;">
	<?php if($total_items == 1): ?>
	<strong><?php echo $total_items;?></strong> item
	<?php else: ?>
	<strong><?php echo $total_items;?></strong> items
	<?php endif;?>
</div>