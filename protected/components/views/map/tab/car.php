<?php $dataJson = json_decode($data['json_map'],true);?>

<div class="box-3" style="margin-top:10px;">
	<p class="text-center"><?php echo $data['title']; ?></p>
	
	<div class="location-group" style="margin-bottom: 10px">
		<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'location')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-location.png" alt="location" /></a>
		<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'car')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car-2.png" alt="car" /></a>
		<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'building')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-hotel.png" alt="building" /></a>
		<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'sign')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-sign-post.png" alt="sign post" /></a>
	</div>  
   <iframe scrolling="no" src="http://www.streetdirectory.com/journey/show_page2?country=sg" border="0" id="direction_frame" name="direction_frame" style="background-color:#fff;" frameborder="0" height="500" width="100%"></iframe>
</div>

 <style>
.map-div {height: 500px;overflow: hidden;position: relative;}

</style>