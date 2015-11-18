<?php if($data['fullScreen']=='map'): ?>
<?php $dataJson = json_decode($data['json_map'],true);?>
<script type="text/javascript" src="http://www.streetdirectory.com/js/map_api/m.php?api=9d8ec051c66464b06807209ae334986c39a3c7ae"></script> 
<script type="text/javascript" src="http://www.propertyguru.com.sg/js/mxn/mxn.js?(streetdirectory)"></script>
<script type="text/javascript">
		$(function () {
				var m = new mxn.Mapstraction('map-div','streetdirectory');
				m.addControls({zoom:'small'});
				var myPoint = new mxn.LatLonPoint(<?php echo $data['y'] ?>,<?php echo $data['x']; ?>);
				m.setCenterAndZoom(myPoint, 16);
				
				<?php if(isset($dataJson[51]) && is_array($dataJson[51]) && count($dataJson[51])>0): foreach ($dataJson[51] as $k=>$v):   ?>
					<?php
					$a = isset($v['a']) ? $v['a'] : '';
					?>
					//near MRT
					m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(<?php echo $v['y'] ?>, <?php echo $v['x'] ?>)) ,{
						label : "<?php echo $v['v'] ?>",
						infoBubble : "<div class='map_test'><div class='map_title_box_inner'><b><?php echo $v['v']; ?></b><br><?php echo $a; ?></div><div style='width:100px;'><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/infobubble1.png' class='map_verz_chi_my' style=''><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/info-close.png' style='position:absolute;right:12px;top:0px;'></div></div>",
						marker : 8,
						iconShadow: "<?php echo Yii::app()->theme->baseUrl; ?>/img/maptool/blank.png",
						iconShadowSize : [10,10],
						icon : "<?php echo Yii::app()->theme->baseUrl; ?>/img/condo_32.png",
						iconSize : [32,70],
						draggable : false,
						hover : true,
					});                                                  

				<?php   endforeach; endif;?>
					
			   <?php if(isset($dataJson[23]) && is_array($dataJson[23]) && count($dataJson[23])>0): foreach ($dataJson[23] as $k=>$v):   ?>
					//near school
						m.addMarkerWithData(new mxn.Marker(new mxn.LatLonPoint(<?php echo $v['y'] ?>, <?php echo $v['x'] ?>)) ,{
							label : "<?php echo $v['v'] ?>",
							infoBubble : "<div class='map_test'><div class='map_title_box_inner'><b><?php echo $v['v']; ?></b><br><?php echo $a; ?> </div><div style='width:100px;'><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/infobubble1.png' class='map_verz_chi_my' style=''><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/info-close.png' style='position:absolute;right:12px;top:0px;'></div></div>",
							marker : 8,
							iconShadow: "<?php echo Yii::app()->theme->baseUrl; ?>/img/maptool/blank.png",
							iconShadowSize : [10,10],
							icon : "<?php echo Yii::app()->theme->baseUrl; ?>/img/condo_32.png",
							iconSize : [32,70],
							draggable : false,
							hover : true,
						});                                                  

			  <?php   endforeach; endif;?>
				
				m.addMarkerWithData(new mxn.Marker(myPoint) ,{
					icon : "<?php echo Yii::app()->theme->baseUrl; ?>/img/condo_32_h.png",
					iconSize : [32,70],
					draggable : false,
					label : "<?php echo $data['title'] ?>",
					infoBubble: "<div class='map_test' style=''><div class='map_title_box_inner'> <b><?php echo $data['title'] ?></b></div><div style='width:100px;'><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/infobubble1.png' class='map_verz_chi_my' style=''><img src='<?php echo Yii::app()->theme->baseUrl; ?>/img/info-close.png' style='position:absolute;right:12px;top:0px;'></div></div>",
					hover : true
				});
		});
</script>


	<body id="listing-map" class="pg_sg">
		<div class="map-wrapper">
				<div class="map-window">
					<div class="map-div" id="map-div"></div>                 
				</div>
		</div>
	</body>       
<?php else: ?>

<div class="row">
	<div class="col-md-9" >
	   <div class="box-3">
			<p class="a-center"><?php echo $data['title']?></p>
			<iframe style="width:100%;min-height: 530px;border:none;" src="<?php echo Yii::app()->createAbsoluteUrl('site/loadmapdetail',array('listing_id'=>$data['model']->id,'size'=>'big_map','type'=>  isset($_GET['type']) ? $_GET['type'] : '')) ?>"></iframe> 
	   </div>
	</div>       
		
	<div class="col-md-3">
		<div class="location-group text-center" style="margin-top: 20px">
			<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'location')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-location.png" alt="location" /></a>
			<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'car')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-car-2.png" alt="car" /></a>
			<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'building')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-hotel.png" alt="building" /></a>
			<a class='select-map' href="<?php echo Yii::app()->createAbsoluteUrl('site/listingdetail', array('slug' => $data['model']->slug,'m' => 'map','type'=>'sign')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ico-sign-post.png" alt="sign post" /></a>
		</div>  
			 <?php
		   		$arrCat = $data['arrCat'];
			   	$dataCat =array();
			   	$dataCar= json_decode($data['json_map'],true);
		   	?>   
			<div class="map-item" >
			   <div class="box-3">
				   <h3 class="title-2">Nearest MRT Stations</h3>
					<ul class="list-2 list-unstyled" style="max-height: 205px;overflow-y: scroll;overflow: auto;">
					<?php 
						   if(isset($dataCar[51]) && is_array($dataCar[51]) && count($dataCar[51])>0){
									foreach ($dataCar[51] as $value)  echo "<li><a href='javascript:;'>".$value['v']."</a></li>";
						   }
					   ?>                  
				   </ul>
			   </div>    
		   </div>   
		   <div class="map-item" >
			   <div class="box-3">
				   <h3 class="title-2">Nearest Schools</h3>
				   <ul class="list-2 list-unstyled" style="max-height: 205px;overflow-y: scroll;overflow: auto;">
					<?php 
						 if(isset($dataCar[23]) && is_array($dataCar[23]) && count($dataCar[23])>0){
									foreach ($dataCar[23] as $value)  echo "<li><a href='javascript:;'>".$value['v']."</a></li>";
						   }
					   ?>                  
				   </ul>
			   </div>    
		   </div>   
	</div>
</div>

<?php endif; ?>
 <style>
/*.map-div {height: 500px;overflow: hidden;position: relative;}*/
/*ANH DUNG Oct 27, 2014 - fix map*/
 .map-div { height: 500px;overflow: hidden;/*position: relative;*/}
 .map_title_box_inner { font-size: 12px; padding:10px 10px 0;}
 .map_test { min-height: 30px; }
 .map_verz_chi_my { position:absolute;bottom: -35px; left: 100px; }
 /*ANH DUNG Oct 27, 2014 - fix map*/

</style>
