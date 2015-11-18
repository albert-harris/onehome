<?php if($banner): $allImg='';?>
<div class="bn-advers-2 banner_middle_fix">
	<?php foreach ($banner as $item): ?>
		<?php
			if($item->link!=""){
				$img = InputHelper::holderImage($item->getImageUrl(263, 220), 263, 220);
				$allImg .= sprintf('<a href="%s" target="_blank">%s</a>', $item->link, $img);
			}else{
				$allImg .= InputHelper::holderImage($banner->getImageUrl(263, 220), 263, 220);
			}
		?>
	<?php endforeach; ?>
	<?php echo $allImg ?>
	<?php
	Yii::app()->clientScript->registerScript('middle-banner', "
		$('.banner_middle_fix').bxSlider({
			mode: 'fade',
			auto: true,
			pager: false,
			controls: false,
			pause: 15000
		}); 
	");
	?>
</div>
<?php endif; ?>
